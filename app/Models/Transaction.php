<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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
        return date('h:i a', strtotime($this->register_time));
    }

    public function setRegisterTimeAttribute($value)
    {
        $this->attributes['register_time'] = date("H:i:s", strtotime(str_replace(' ', '',$value)));
    }

    public function setRegisterDateAttribute($value)
    {
        $this->attributes['register_date'] = Carbon::createFromFormat('d/m/Y', $value)->toDateString();
    }

    public function getRegisterDateAttribute($value)
    {
        return date('d/m/Y', strtotime($value));
    }
}
