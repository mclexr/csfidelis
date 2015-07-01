<?php
namespace App\Controller;

	use App\Model\Usuario;
    use App\Provider\TokenProvider;

class TokenController {

	private $app;
    private $tokenProvider;

	public function __construct() {
        $this->tokenProvider = new TokenProvider();
        $this->app = \Slim\Slim::getInstance();
    }

    public function getToken() {
        $request = $this->app->request();
        $usuarioRequest = json_decode($request->getBody());

        if(!isset($usuarioRequest->email) || !isset($usuarioRequest->password)) {
            throw new \Exception("Email e/ou senha não informados.", 401);
        }

        $token = $this->tokenProvider->getToken($usuarioRequest->email, $usuarioRequest->password);

        $this->app->response->setBody($token);
        $this->app->response->setStatus(200);
    }

    public function verificarToken() {
        $token = $this->tokenProvider->verificarToken();

        $this->app->response->setBody($token);
        $this->app->response->setStatus(200);
    }
}
?>
