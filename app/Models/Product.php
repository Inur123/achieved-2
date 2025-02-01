<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'image','status'];

    public function getFormattedPriceAttribute() {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }
}
