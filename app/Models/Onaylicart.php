<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Onaylicart extends Model {

    protected $table = 'carts';

    use HasFactory;

    public function allAmount() {
        return '1';
    }
}
