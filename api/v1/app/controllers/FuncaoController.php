<?php
namespace App\Controller;

	use App\Provider\DoctrineProvider;
	use App\Model\Funcao;

class FuncaoController {

	private $entityManager;
	private $app;

	public function __construct() {
        $this->entityManager = DoctrineProvider::getEntityManager();
        $this->app = \Slim\Slim::getInstance();
    }

    public function getFuncoes() {
    	$funcionarios = $this->entityManager
		->getRepository("App\Model\Funcao")
		->findAll();

        $this->app->response->setBody("{\"funcoes\":" . json_encode($funcionarios,JSON_PRETTY_PRINT) . "}");
        $this->app->response->setStatus(200);
    }

    function getFuncao($id) {
        $funcao = $this->entityManager->find("App\Model\Funcao", $id);
        $this->app->response->setBody("{\"funcao\":" . json_encode($funcao,JSON_PRETTY_PRINT) . "}");
        $this->app->response->setStatus(200);
}


function addFuncao() {
	$request = $this->app->request();
	$funcaoRequest = json_decode($request->getBody());

	$funcao = new Funcao();
    $funcao->setDescricao($funcaoRequest->descricao);

	$this->entityManager->persist($funcao);
	$this->entityManager->flush();

    $this->app->response->setBody("{\"funcao\":" . json_encode($funcao,JSON_PRETTY_PRINT) . "}");
    $this->app->response->setStatus(201);
}


function updateFuncao($id) {
	$request = $this->app->request();
	$funcaoRequest = json_decode($request->getBody());

	$funcao = $this->entityManager->find("App\Model\Funcao", $id);

    if(isset($funcaoRequest->descricao)){
        $funcao->setDescricao($funcaoRequest->descricao);
    }

	$this->entityManager->merge($funcao);
	$this->entityManager->flush();

    $this->app->response->setBody("{\"funcao\":" . json_encode($funcao,JSON_PRETTY_PRINT) . "}");
    $this->app->response->setStatus(200);
}

function removeFuncao($id) {
    $funcao = $this->entityManager->find("App\Model\Funcao", $id);
    $this->entityManager->remove($funcao);
	$this->entityManager->flush();
    $this->app->response->setStatus(204);

}
}
?>
