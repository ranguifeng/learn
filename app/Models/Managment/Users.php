<?php
/**
 * Created by PhpStorm
 * User: rangf
 * Date: 2020/7/8 14:53
 */

namespace App\Models\Managment;


use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $connection = 'management';
    protected $table = 't_users';
    protected $primaryKey = 'id';
    protected $fillable = [];
    protected $dates = ['created_at', 'updated_at'];
}