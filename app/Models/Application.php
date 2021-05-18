<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Application
 * @mixin Builder
 */
class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'cv_text',
        'cover_letter',
        'job_ad_id',
        'user_id'
    ];
}
