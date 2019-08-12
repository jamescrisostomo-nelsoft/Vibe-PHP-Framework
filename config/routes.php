<?php

use System\Service\Routes\Route;

    /*
    | ///////////////////////////////////////////////
    |   Route Table
    | ///////////////////////////////////////////////
    |
    |   Declare your website's routes here.
    |
    */
    

Route::get('/', App\Modules\Controllers\HomeController::class);