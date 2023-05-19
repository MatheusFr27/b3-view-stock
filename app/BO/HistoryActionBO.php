<?php

namespace App\BO;

use App\Models\HistoryAction;

class HistoryActionBO
{

    /**
     * Salva o dado no banco de dados.
     *
     * @param array $data
     *
     * @author Matheus Eduardo França <matheusefranca1727@gmail.com>
     */
    public function store($data)
    {
        $historyAction = HistoryAction::create($data);

        return $historyAction;
    }

    /**
     * Retorna todos os dados que tenham o action_id igual ao informado no parametro.
     *
     * @param int $action_id
     *
     * @author Matheus Eduardo França <matheusefranca1727@gmail.com>
     */
    public function findByActionId(int $action_id)
    {
        $results = HistoryAction::where('action_id', $action_id)->get();

        return $results;
    }
}
