<?php

    /*
    | ///////////////////////////////////////////////
    |   Application Service Configuration
    | ///////////////////////////////////////////////
    |
    |   Configuration Reference:
    |
    |   #app.name          @String
    |   #app.version       @String
    |   #release           @String[production, debug]
    |   #mode              @String[up, down, maintenance]
    |   #console           @Boolean
    |   #locale            @string[en, ...]
    |   #minify            @Boolean
    |   #cache             @Boolean
    |
    |   *Note
    |   Do not forget to update release status
    |   to "production" before deploying your web 
    |   application.
    |
    */

    return [

        'app.name'            => '',

        'app.version'         => '',

        'release'             => 'debug',

        'mode'                => 'up',

        'console'             => true,

        'locale'              => 'en',

        'minify'              => true,

        'cache'               => true,

    ];