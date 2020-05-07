<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    protected $connection = 'management';
    protected $table = 't_music';
}