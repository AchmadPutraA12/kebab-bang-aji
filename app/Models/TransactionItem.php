<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class TransactionItem extends Model
{
    use HasFactory, Notifiable;

    public $guarded = ['id'];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
