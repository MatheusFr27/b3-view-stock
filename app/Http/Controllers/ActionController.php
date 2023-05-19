<?php

namespace App\Http\Controllers;

use App\BO\ActionBO;
use App\Helper\Helper;
use Illuminate\Http\Request;

class ActionController extends Controller
{
    /**
     * Retorna todos os dados do banco.
     *
     * @author Matheus Eduardo França <matheusefranca1727@gmail.com>
     */
    public function initialize()
    {
        $message = 'Dados retornados com sucesso.';
        $status = 200;
        $data = (new ActionBO)->initialize();

        if (!isset($data)) {
            $message = 'Houve um erro ao retornar os dados.';
            $status = 500;
        }

        return Helper::responseJson($data, $message, $status);
    }
}
