<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ApplicationStep
 * @mixin Builder
 */
class ApplicationStep extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id',
        'step_number',
        'rating',
    ];
}
