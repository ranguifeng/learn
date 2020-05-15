<?php

namespace App\Http\Controllers;

use Faker\Factory;
use Monolog\Handler\BrowserConsoleHandler;

class DuskCaseController extends Controller
{
    public function faker()
    {
        $faker = Factory::create();
        $now = time();
        $postcode = $faker->companyEmail;

        dump($postcode);
    }
}