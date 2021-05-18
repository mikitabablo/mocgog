<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Cart
 *
 * @mixin Builder
 */
class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id'];
}
