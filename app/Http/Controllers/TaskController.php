<?php

namespace App\Http\Controllers;

use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function index()
    {
        $lists = User::withTrashed()->where('age', '>=', '22')->where(['name' => 'lisi'])->get();
        dump($lists);
    }
}
