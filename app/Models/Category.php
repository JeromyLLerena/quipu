<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    public function type()
    {
        return $this->belongsTo(TransactionType::class, 'transaction_type_id');
    }
}
