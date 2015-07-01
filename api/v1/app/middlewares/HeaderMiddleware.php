<?php
namespace App\Middleware;

class HeaderMiddleware extends \Slim\Middleware
{
    public function call()
    {
        //A resposta sera sempre em json utf8
        $this->app->response->headers->set('Content-Type','application/json;charset=utf-8');

        //CORS
        $this->app->response->headers->set('Access-Control-Allow-Origin','*');
        $this->app->response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE');
        $this->app->response->headers->set('Access-Control-Allow-Headers', 'Content-Type, X-Requested-With, X-authentication, X-client');

        $this->next->call();
    }
}

?>
