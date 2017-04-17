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
}
