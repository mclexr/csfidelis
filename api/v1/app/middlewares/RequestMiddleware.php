<?php
namespace App\Middleware;

class RequestMiddleware extends \Slim\Middleware
{
    public function call()
    {
        $this->next->call();
        //Caso POST ou PUT verifica se ha dados. Caso nada seja submetido nao continua.
        try {
            if($this->app->request()->isPost() || $this->app->request()->isPut()) {
                if(null === $this->app->request()->getBody() || $this->app->request()->getBody() === ""){
                    throw new \Exception("Não há dados para submeter.", 400);
                }
            }
        } catch(\Exception $e) {
            $this->app->applyHook('errorHandler', $e);
        }
    }
}

?>
