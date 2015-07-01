<?php
namespace App\Middleware;

    use App\Provider\TokenProvider;

class TokenMiddleware extends \Slim\Middleware
{

    public function call()
    {
        $publicRoutes = array("/auth",
                              "/recoverPassword");

        $route = $this->app->request()->getPathInfo();

        if(in_array($route, $publicRoutes)) {
            $this->next->call();
        } else {
            try {
                $tokenProvider = new TokenProvider();
                $tokenProvider->verificarToken();
                $this->next->call();
            } catch(\Exception $e) {
                $this->app->response->setStatus(401);
                $this->app->applyHook('errorHandler', $e);
            }
        }
    }
}
?>
