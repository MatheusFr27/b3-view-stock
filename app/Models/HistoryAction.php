<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryAction extends Model
{
    use HasFactory;

    protected $table = 'history_actions';

    protected $fillable = [
        'id',
        'action_id',
        'isin',
        'balance_quantity',
        'trade_average_price',
        'price_factor',
        'balance_value',
        'date'
    ];
}
