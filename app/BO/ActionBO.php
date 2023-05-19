<?php

namespace App\BO;

use App\Exports\B3Export;
use App\Imports\B3Import;
use App\Imports\B3ModelImport;
use App\Models\Action;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

class ActionBO
{

    private $http;
    private $days;

    public function __construct()
    {
        $this->http = new Client();
    }

    /**
     * Retorna todos os dados do banco.
     *
     * @author Matheus Eduardo França <matheusefranca1727@gmail.com>
     */
    public function initialize()
    {
        return Action::all();
    }

    /**
     * Inicializa o processo de atualização das ações no banco.
     *
     * @param int $numberOfDays - Numero de dias a serem contabilizados;
     *
     * @author Matheus Eduardo França <matheusefranca1727@gmail.com>
     */
    public function updateActions(int $numberOfDays = 1)
    {
        DB::beginTransaction();

        try {
            $this->setDays($numberOfDays)->getLendingOpenPositionB3()->processCSV();

            DB::commit();

            return true;
        } catch (Throwable $e) {
            DB::rollBack();

            Log::error("Action-BO-updateActions-Error", ['Message' => $e->getMessage(), 'File' => $e->getFile(), 'Line' => $e->getLine()]);

            return false;
        }
    }

    /**
     * Captura o token para os arquivos referentes ao dia processado.
     *
     * @author Matheus Eduardo França <matheusefranca1727@gmail.com>
     */
    private function getLendingOpenPositionB3()
    {

        foreach ($this->days as $day) {
            $uri = 'https://arquivos.b3.com.br/api/download/requestname?fileName=LendingOpenPositionFile&date=' . $day . '&recaptchaToken';

            $request = new Request('GET', $uri);

            $promise = $this->http->sendAsync($request)->then(function ($response) {
                $body = json_decode($response->getBody());

                $this->downloadCSV($body->token);
                print_r('Arquivo Encontrado. -- ');
            }, function ($error) {
                print_r('Sem Arquivo. -- ');
            });

            $promise->wait();
        }

        return $this;
    }

    /**
     * Define uma sequencia de dias anteriores ao atual
     *
     * @param int $numberOfDays - Numero de dias a serem contabilizados;
     *
     * @author Matheus Eduardo França <matheusefranca1727@gmail.com>
     */
    private function setDays(int $numberOfDays = 1)
    {
        $days = [];

        while ($numberOfDays > 0) {
            $date = Carbon::now()->subDays($numberOfDays)->format('Y-m-d');

            array_push($days, $date);

            $numberOfDays--;
        }

        $this->days = $days;

        return $this;
    }

    /**
     * Realiza a requisição para captura do arquivo na requisição e salva o mesmo no storage.
     *
     * @param string $token
     *
     * @author Matheus Eduardo França <matheusefranca1727@gmail.com>
     */
    private function downloadCSV(string $token)
    {
        $uri = 'https://arquivos.b3.com.br/api/download?token=' . $token;

        $request = new Request('GET', $uri);

        $promise = $this->http->sendAsync($request)->then(function ($response) {
            $body = $response->getBody();
            $path = 'public/lendingOpenPositionCSV/test-' . uniqid() . '.csv';

            Storage::put($path, $body);
        }, function ($error) {
            print_r('Houve um erro ao capturar o arquivo. -- ');
        });

        $promise->wait();

        return $this;
    }

    /**
     * Pega todos os arquivos contido na pasta 'lendingOpenPositionCSV' e processa todos salvando no banco de dados.
     *
     * @author Matheus Eduardo França <matheusefranca1727@gmail.com>
     */
    private function processCSV()
    {
        $files = Storage::allFiles('public/lendingOpenPositionCSV');

        foreach ($files as $file) {
            Excel::import(new B3Import, $file);

            Storage::delete($file);
        }

        return $this;
    }

    /**
     * Retorna o primeiro dado que for compativel com o informado, senão cria um novo dado no banco.
     *
     * @param Array $data
     *
     * @author Matheus Eduardo França <matheusefranca1727@gmail.com>
     */
    public function firstOrCreate(array $data)
    {
        return Action::firstOrCreate($data);
    }
}
