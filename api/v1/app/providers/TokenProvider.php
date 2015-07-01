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
            throw new \Exception("Problemas na autenticação.", 401);
        }

        $usuario = $this->entityManager
        ->getRepository("App\Model\Usuario")
        ->findOneBy(array('email' => $email));

        if(!isset($usuario)) {
            throw new \Exception("Problemas na autenticação.", 401);
        }

        if(password_verify($password, $usuario->getSenha())) {
            return $this->gerarToken($usuario);
        }
         throw new \Exception("Problemas na autenticação.", 401);
    }

    public function verificarToken() {
        //Codifico os headers em json, pois sem isso não consigo acessar o header "Authorization"
        $headersJson = json_encode(apache_request_headers());

        //Decodifico os headers para objeto
        $headers = json_decode($headersJson);

        //Cason nao encontre a propriedade "Authorization não continua
        if(!isset($headers->Authorization)) {
            throw new \Exception("Token não informado.", 401);
        }

        //Retiro a palavra Bearer do header
        $token = str_replace(array("Bearer", " "), "", $headers->Authorization);

        //Verifico o token
        $decoded = \JWT::decode($token, self::KEY, array('HS256'));
        return $this->tokenResponse($token, $decoded->exp);

    }
    private function gerarToken($usuario){
        $dataToken = time();
        $token = array(
            "iss" => $usuario->getEmail(),
            "iat" => $dataToken,
            "exp" => $dataToken + 10800,
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
