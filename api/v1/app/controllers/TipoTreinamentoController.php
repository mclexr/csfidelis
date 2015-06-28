<?php
namespace App\Controller;

	use App\Provider\DoctrineProvider;
	use App\Model\TipoTreinamento;

class TipoTreinamentoController {

	private $entityManager;
	private $app;

	public function __construct() {
        $this->entityManager = DoctrineProvider::getEntityManager();
        $this->app = \Slim\Slim::getInstance();
    }

    public function getTiposTreinamento() {
    	$funcionarios = $this->entityManager
		->getRepository("App\Model\TipoTreinamento")
		->findAll();

        $this->app->response->setBody("{\"tipostreinamento\":" . json_encode($funcionarios,JSON_PRETTY_PRINT) . "}");
        $this->app->response->setStatus(200);
    }

    function getTipoTreinamento($id) {
        $tipotreinamento = $this->entityManager->find("App\Model\TipoTreinamento", $id);
        $this->app->response->setBody("{\"tipotreinamento\":" . json_encode($tipotreinamento,JSON_PRETTY_PRINT) . "}");
        $this->app->response->setStatus(200);
}


function addTipoTreinamento() {
	$request = $this->app->request();
	$tipotreinamentoRequest = json_decode($request->getBody());

	$tipotreinamento = new TipoTreinamento();
    $tipotreinamento->setDescricao($tipotreinamentoRequest->descricao);

	$this->entityManager->persist($tipotreinamento);
	$this->entityManager->flush();

    $this->app->response->setBody("{\"tipotreinamento\":" . json_encode($tipotreinamento,JSON_PRETTY_PRINT) . "}");
    $this->app->response->setStatus(201);
}


function updateTipoTreinamento($id) {
	$request = $this->app->request();
	$tipotreinamentoRequest = json_decode($request->getBody());

	$tipotreinamento = $this->entityManager->find("App\Model\TipoTreinamento", $id);

    if(isset($tipotreinamentoRequest->descricao)){
        $tipotreinamento->setDescricao($tipotreinamentoRequest->descricao);
    }

	$this->entityManager->merge($tipotreinamento);
	$this->entityManager->flush();

    $this->app->response->setBody("{\"tipotreinamento\":" . json_encode($tipotreinamento,JSON_PRETTY_PRINT) . "}");
    $this->app->response->setStatus(200);
}

function removeTipoTreinamento($id) {
    $tipotreinamento = $this->entityManager->find("App\Model\TipoTreinamento", $id);
    $this->entityManager->remove($tipotreinamento);
	$this->entityManager->flush();
    $this->app->response->setStatus(204);

}
}
?>
