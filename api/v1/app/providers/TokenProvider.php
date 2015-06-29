<?php
namespace App\Provider;

    use App\Provider\DoctrineProvider;
	use App\Model\Usuario;

class TokenProvider {

    private $entityManager;
	private $app;

	public function __construct() {
        $this->entityManager = DoctrineProvider::getEntityManager();

    }

    public function verifyUser($email, $password) {
        $usuario = $this->entityManager
        ->getRepository("App\Model\Usuario")
        ->findOneBy(array('email' => $email));

        if(password_verify($password, $usuario->getSenha())) {
            return generateToken($usuario);
        }
         throw new \Exception("Problemas na autenticação.");
    }

    private function generateToken($usuario){
        $key = "Familia#Amigos@Master!";
        $dataToken = time();
        $token = array(
            "iss" => $usuario->getEmail(),
            "iat" => $dataToken,
            "exp" => $dataToken + 7200,
            "aud" => "http://csfidelis.com.br/api/v1/auth",
        );

        return JWT::encode($token, $key);
    }
}
?>
