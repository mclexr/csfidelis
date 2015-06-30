<?php
namespace App\Provider;

    use App\Provider\DoctrineProvider;
    use App\Model\Usuario;

class TokenProvider {

    const KEY = "Familia#Amigos@Master!";
    private $entityManager;

	public function __construct() {
        $this->entityManager = DoctrineProvider::getEntityManager();
    }

    public function getToken($email, $password) {
        if(!isset($email) || !isset($password)) {
            throw new \Exception("Problemas na autenticação.");
        }

        $usuario = $this->entityManager
        ->getRepository("App\Model\Usuario")
        ->findOneBy(array('email' => $email));

        if(!isset($usuario)) {
            throw new \Exception("Problemas na autenticação.");
        }

        if(password_verify($password, $usuario->getSenha())) {
            return $this->gerarToken($usuario);
        }
         throw new \Exception("Problemas na autenticação.");
    }

    public function verificarToken() {
        $header = apache_request_headers()["Authorization"];
        $token = str_replace(array("Bearer", " "), "", $header);

        if(!isset($token)) {
            throw new \Exception("Token não informado.");
        }


        $decoded = \JWT::decode($token, self::KEY, array('HS256'));
        return $this->tokenResponse($token, $decoded->exp);

    }
    private function gerarToken($usuario){
        $dataToken = time();
        $token = array(
            "iss" => $usuario->getEmail(),
            "iat" => $dataToken,
            "exp" => $dataToken + 100,
            "aud" => "http://csfidelis.com.br/api/v1/auth/verify",
        );
        $tokenCode = \JWT::encode($token, self::KEY);

        return $this->tokenResponse($tokenCode, $token["exp"]);
    }

    private function tokenResponse($tokenCode, $expiration) {
         $tokenResponse = array(
                "token_type" => "bearer",
                "access_token" => $tokenCode,
                "expiration" => $expiration
            );
        return "{\"token\":" . json_encode($tokenResponse, JSON_PRETTY_PRINT) . "}";
    }


}
?>
