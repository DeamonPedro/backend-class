<?php

use Illuminate\Http\Request;

//Exemplo de api com lumen para o ultimo trabalho de web

$router->get('/contacts', function () {
    return app('db')->table('contacts')->get();
});
