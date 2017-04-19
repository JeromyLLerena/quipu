<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';

    public function labels()
    {
        return $this->belongsToMany(Label::class, 'transactions_labels', 'transaction_id', 'label_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }

    public function getIsIncrementAttribute()
    {
        return $this->category->transaction_type_id == config('constants.transaction_types.entry');
    }

    public function getAmountWithSymbolAttribute()
    {
        return $this->account->currency->symbol . ' ' . number_format($this->amount, config('constants.decimal_digits'));
    }

    public function getRegisterTimeWithoutSecondsAttribute()
    {
        return date_create($this->register_date . ' ' . $this->register_time)->format('H:i');
    }
}
