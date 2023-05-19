<?php

namespace App\Http\Controllers;

use App\BO\HistoryActionBO;
use App\Helper\Helper;
use Illuminate\Http\Request;

class HistoryActionController extends Controller
{
    /**
     * Retorna todos os dados que tenham o action_id igual ao informado no parametro.
     *
     * @param int $action_id
     *
     * @author Matheus Eduardo França <matheusefranca1727@gmail.com>
     */
    public function findByActionId(int $action_id)
    {
        $message = 'Dados retornados com sucesso.';
        $status = 200;
        $data = (new HistoryActionBO)->findByActionId($action_id);

        if (!isset($data)) {
            $message = 'Houve um erro ao retornar os dados.';
            $status = 500;
        }

        return Helper::responseJson($data, $message, $status);
    }
}
