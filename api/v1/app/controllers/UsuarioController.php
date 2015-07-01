<?php
namespace App\Controller;

	use App\Provider\DoctrineProvider;
	use App\Model\Usuario;
    use App\Helper\Utils;

class UsuarioController {

	private $entityManager;
	private $app;

	public function __construct() {
        $this->entityManager = DoctrineProvider::getEntityManager();
        $this->app = \Slim\Slim::getInstance();
    }

    public function getUsuarios() {
    	$funcionarios = $this->entityManager
		->getRepository("App\Model\Usuario")
		->findAll();

        $this->app->response->setBody("{\"usuarios\":" . json_encode($funcionarios,JSON_PRETTY_PRINT) . "}");
        $this->app->response->setStatus(200);
    }

    function getUsuario($id) {
        $usuario = $this->entityManager->find("App\Model\Usuario", $id);
        $this->app->response->setBody("{\"usuario\":" . json_encode($usuario,JSON_PRETTY_PRINT) . "}");
        $this->app->response->setStatus(200);
}


    function addUsuario() {
        $request = $this->app->request();
        $usuarioRequest = json_decode($request->getBody());

        $usuario = new Usuario();
        $usuario->setNome($usuarioRequest->nome);
        $usuario->setEmail($usuarioRequest->email);

        $senha = password_hash($usuarioRequest->senha, PASSWORD_DEFAULT);
        $usuario->setSenha($senha);

        if (!isset($usuarioRequest->criado)) {
            $usuario->setCriado(new \DateTime());
        } else {
            $usuario->setCriado(new \DateTime($usuarioRequest->criado));
        }

        $this->entityManager->persist($usuario);
        $this->entityManager->flush();

        $this->app->response->setBody("{\"usuario\":" . json_encode($usuario,JSON_PRETTY_PRINT) . "}");
        $this->app->response->setStatus(201);
    }


    function updateUsuario($id) {
        $request = $this->app->request();
        $usuarioRequest = json_decode($request->getBody());

        $usuario = $this->entityManager->find("App\Model\Usuario", $id);

        if(!isset($usuarioRequest->senhaAtual)) {
            throw new \Exception("Parametro 'senhaAtual' não informado.");
        }

        if(!password_verify($usuarioRequest->senhaAtual, $usuario->getSenha())) {
            throw new \Exception("Senha atual incorreta.");
        }

        if(isset($usuarioRequest->nome)){
            $usuario->setNome($usuarioRequest->nome);
        }

        if(isset($usuarioRequest->email)){
           $usuario->setEmail($usuarioRequest->email);
        }

        if (isset($usuarioRequest->senha)) {
            $usuario->setSenha(password_hash($usuarioRequest->senha, PASSWORD_DEFAULT));
        }

        $this->entityManager->merge($usuario);
        $this->entityManager->flush();

        $this->app->response->setBody("{\"usuario\":" . json_encode($usuario,JSON_PRETTY_PRINT) . "}");
        $this->app->response->setStatus(200);
    }

    function removeUsuario($id) {
        $request = $this->app->request();
        $usuarioRequest = json_decode($request->getBody());

        if(!isset($usuarioRequest->senhaAtual)) {
            throw new \Exception("Parametro 'senhaAtual' do usuário a ser deletado deve ser informado.");
        }

        $usuario = $this->entityManager->find("App\Model\Usuario", $id);
        $this->entityManager->remove($usuario);
        $this->entityManager->flush();
        $this->app->response->setStatus(204);

    }

    function recoverPassword($id) {
        $request = $this->app->request();
        $usuarioRequest = json_decode($request->getBody());

        if(!isset($usuarioRequest->email)){
            throw new \Exception("Email não informado.", 401);
        }

        $usuario = $this->entityManager->find("App\Model\Usuario", $id);

        if(!isset($usuario)){
            throw new \Exception("Usuário não encontrado.");
        }

        if($usuarioRequest->email !== $usuario->getEmail()) {
            throw new \Exception("Email informado inválido.", 401);
        }

        $novaSenha = Utils::getRandomWord(10);

        //$usuario->setSenha(password_hash($novaSenha, PASSWORD_DEFAULT));
        //$this->entityManager->merge($usuario);
        //$this->entityManager->flush();
        $route = $this->app->request()->getPathInfo();
        echo "Rota: ".$route."\n";

        $this->app->response->setBody("{\"usuario\":" . json_encode($usuario,JSON_PRETTY_PRINT) . "}");
        $this->app->response->setStatus(200);

    }
}
?>
