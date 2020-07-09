<?php
/**
 * Created by PhpStorm
 * User: rangf
 * Date: 2020/7/8 14:54
 */

namespace App\Http\Controllers;


use Carbon\Carbon;

class UsersController extends HomeController
{
    public function index()
    {
        $date = Carbon::yesterday()->toDateString();
        dd($date);
    }
}