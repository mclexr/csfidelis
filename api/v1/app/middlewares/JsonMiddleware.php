<?php
namespace App\Middleware;

class JsonMiddleware extends \Slim\Middleware
{
    public function call()
    {
        $this->app->response->headers->set('Content-Type','application/json;charset=utf-8');
        //echo("{\"headers\":" . json_encode(apache_request_headers(), JSON_PRETTY_PRINT) . "}");
        $this->next->call();
    }
}

?>
