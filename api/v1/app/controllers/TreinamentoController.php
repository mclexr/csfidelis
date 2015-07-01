<?php
namespace App\Controller;

	use App\Provider\DoctrineProvider;
	use App\Model\Treinamento;
	use App\Model\FuncionarioTreinamento;

class TreinamentoController {

	private $entityManager;
	private $app;

	public function __construct() {
        $this->entityManager = DoctrineProvider::getEntityManager();
        $this->app = \Slim\Slim::getInstance();
    }


function getTreinamento($id) {
	$treinamento = $this->entityManager->find("App\Model\Treinamento", $id);
    $this->app->response->setBody("{\"treinamento\":" . json_encode($treinamento,JSON_PRETTY_PRINT) . "}");
    $this->app->response->setStatus(200);
}

function getTreinamentos() {
	$treinamentos = $this->entityManager->getRepository("App\Model\Treinamento")->findAll();
    $this->app->response->setBody("{\"treinamentos\":" . json_encode($treinamentos,JSON_PRETTY_PRINT) . "}");
    $this->app->response->setStatus(200);
}

function addTreinamento() {
	$request = $this->app->request();
	$treinamentoRequest = json_decode($request->getBody());

	$treinamento = new Treinamento();

    $empresa = $this->entityManager->find("App\Model\Empresa", $treinamentoRequest->empresa->id);
    $treinamento->setEmpresa($empresa);

	$tipoTreinamento = $this->entityManager->find("App\Model\TipoTreinamento", $treinamentoRequest->tipoTreinamento->id);
	$treinamento->setTipoTreinamento($tipoTreinamento);

	$treinamento->setData(new \DateTime($treinamentoRequest->data));

	$this->entityManager->persist($treinamento);
	$this->entityManager->flush();

	$this->app->response->setBody("{\"treinamento\":" . json_encode($treinamento,JSON_PRETTY_PRINT) . "}");
    $this->app->response->setStatus(200);
}

function getFuncionariosPorTreinamento($idTreinamento) {
	$query = $this->entityManager->createQuery("
	   SELECT funcionario
       FROM App\Model\Funcionario funcionario
       WHERE funcionario.id IN (
            SELECT 	f.id
            FROM App\Model\FuncionarioTreinamento ft
            JOIN ft.funcionario f
            JOIN ft.treinamento t
            WHERE t.id = ?1)
	");
	$query->setParameter(1, $idTreinamento);

	$funcionarios = $query->getResult();

	$this->app->response->setBody("{\"funcionarios\":" . json_encode($funcionarios,JSON_PRETTY_PRINT) . "}");
    $this->app->response->setStatus(200);
}

function addFuncionario($id) {
    $request = $this->app->request();
	$funcionarioRequest = json_decode($request->getBody());

    $treinamento = $this->entityManager->find("App\Model\Treinamento", $id);
    $funcionario = $this->entityManager->find("App\Model\Funcionario", $funcionarioRequest->id);

    $funcionarioTreinamento = new FuncionarioTreinamento();
    $funcionarioTreinamento->setFuncionario($funcionario);
    $funcionarioTreinamento->setTreinamento($treinamento);

    $this->entityManager->persist($funcionarioTreinamento);
	$this->entityManager->flush();

	$this->app->response->setBody("{\"funcionarioTreinamento\":" . json_encode($funcionarioTreinamento,JSON_PRETTY_PRINT) . "}");
    $this->app->response->setStatus(200);

}


function updateTreinamento($id) {
	$request = $this->app->request();
	$treinamentoRequest = json_decode($request->getBody());

	$treinamento = $this->entityManager->find("App\Model\Treinamento", $id);

    if(isset($treinamentoRequest->empresa->id)) {
        $empresa = $this->entityManager->find("App\Model\Empresa", $treinamentoRequest->empresa->id);
	   $treinamento->setEmpresa($empresa);
    }

    if(isset($treinamentoRequest->tipoTreinamento->id)) {
        $tipoTreinamento = $this->entityManager->find("App\Model\TipoTreinamento", $treinamentoRequest->tipoTreinamento->id);
        $treinamento->setTipoTreinamento($tipoTreinamento);
    }

    if(isset($treinamentoRequest->data)){
        $treinamento->setData(new \ DateTime($treinamentoRequest->data));
    }

	$this->entityManager->merge($treinamento);
	$this->entityManager->flush();

	$this->app->response->setBody("{\"treinamento\":" . json_encode($treinamento,JSON_PRETTY_PRINT) . "}");
    $this->app->response->setStatus(200);
}

function removeTreinamento($id){
    $treinamento = $this->entityManager->find("App\Model\Treinamento", $id);
    $this->entityManager->remove($treinamento);
	$this->entityManager->flush();
    $this->app->response->setStatus(204);
}


}
