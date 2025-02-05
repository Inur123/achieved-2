<?php

// app/Models/Transaction.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'product_id', 'name', 'email', 'phone_number', 'status','price','snap_token'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approvedTransaction()
    {
        return $this->hasOne(ApprovedTransaction::class);
    }

    public function productTransactions()
    {
        return $this->hasMany(ProductTransaction::class);
    }

}
