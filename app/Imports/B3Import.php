<?php

namespace App\Imports;

use App\BO\ActionBO;
use App\BO\HistoryActionBO;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class B3Import implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        $actionBO = new ActionBO();
        $historyActionBO = new HistoryActionBO();

        foreach ($collection as $i => $item) {
            if (
                $item[0] != 'RptDt'
                && $item[1] != 'TckrSymb'
                && $item[2] != 'ISIN'
                && $item[4] != 'BalQty'
                && $item[5] != 'TradAvrgPric'
                && $item[6] != 'PricFctr'
                && $item[7] != 'BalVal'
            ) {
                $dataAction = ['name' => $item[1]];
                $action = $actionBO->firstOrCreate($dataAction);

                $data = [
                    'action_id' => $action->id,
                    'date' => $item[0],
                    'isin' => $item[2],
                    'balance_quantity' => intval($item[4]),
                    'trade_average_price' => floatval($item[5]),
                    'price_factor' => intval($item[6]),
                    'balance_value' => floatval($item[7]),
                ];

                $historyActionBO->store($data);
            }
        }
    }
}
