<?php

    session_start();

    /*
    | ///////////////////////////////////////////////
    |   Vibe PHP Framework 1.0.0.0
    | ///////////////////////////////////////////////
    | 
    |   Vibe PHP is a light-weight web development
    |   framework developed to ease the hard work
    |   of web development by providing tools and
    |   ready to use functionalities to accelerate
    |   development and improve efficiency.
    |
    |   Written by James Levi Crisostomo
    |   © 2019
    |
    */




    /*
    | ///////////////////////////////////////////////
    |   Autoload Service
    | ///////////////////////////////////////////////
    |
    |   Automatically loaded PHP class files without
    |   the need of include or require functions. 
    |
    */

    require 'src/System/Service/Autoload/autoload.php';





    /*
    | /////////////////////////////////////////////// 
    |   Application Service Controller
    | ///////////////////////////////////////////////
    |
    |   Almost everything that makes web development
    |   fun using Vibe happens here. 
    |
    */

    use System\Application\ApplicationService as App;
    
    App::init();