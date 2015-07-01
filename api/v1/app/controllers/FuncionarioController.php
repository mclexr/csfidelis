<?php
namespace App\Controller;

	use App\Provider\DoctrineProvider;
	use App\Model\Funcionario;

class FuncionarioController {

	private $entityManager;
	private $app;

	public function __construct() {
        $this->entityManager = DoctrineProvider::getEntityManager();
        $this->app = \Slim\Slim::getInstance();
    }

    public function getFuncionarios() {
    	$funcionarios = $this->entityManager
		->getRepository("App\Model\Funcionario")
		->findAll();

        $this->app->response->setBody("{\"funcionarios\":" . json_encode($funcionarios,JSON_PRETTY_PRINT) . "}");
        $this->app->response->setStatus(200);
    }

    function getFuncionario($id) {
        $funcionario = $this->entityManager->find("App\Model\Funcionario", $id);
        $this->app->response->setBody("{\"funcionario\":" . json_encode($funcionario,JSON_PRETTY_PRINT) . "}");
        $this->app->response->setStatus(200);
}


function addFuncionario() {
	$request = $this->app->request();
	$funcionarioRequest = json_decode($request->getBody());

    $funcionario = new Funcionario();
	$funcionario->setNome($funcionarioRequest->nome);
	$funcionario->setIdentificacao($funcionarioRequest->identificacao);

    $empresa = $this->entityManager->find("App\Model\Empresa", $funcionarioRequest->empresa->id);
    $funcionario->setEmpresa($empresa);

    $funcao = $this->entityManager->find("App\Model\Funcao", $funcionarioRequest->funcao->id);
    $funcionario->setFuncao($funcao);

    $funcionario->setDataAdmissao(new \DateTime($funcionarioRequest->dataAdmissao));

	$this->entityManager->persist($funcionario);
	$this->entityManager->flush();

    $this->app->response->setBody("{\"funcionario\":" . json_encode($funcionario,JSON_PRETTY_PRINT) . "}");
    $this->app->response->setStatus(201);
}


function updateFuncionario($id) {
	$request = $this->app->request();
	$funcionarioRequest = json_decode($request->getBody());

	$funcionario = $this->entityManager->find("App\Model\Funcionario", $id);

    if(isset($funcionarioRequest->nome)) {
        $funcionario->setNome($funcionarioRequest->nome);
    }

    if(isset($funcionarioRequest->identificacao)) {
	   $funcionario->setIdentificacao($funcionarioRequest->identificacao);
    }
    if(isset($funcionarioRequest->empresa->id)) {
        $empresa = $this->entityManager->find("App\Model\Empresa", $funcionarioRequest->empresa->id);
        $funcionario->setEmpresa($empresa);
    }

    if(isset($funcionarioRequest->funcao->id)) {
        $funcao = $this->entityManager->find("App\Model\Funcao", $funcionarioRequest->funcao->id);
        $funcionario->setFuncao($funcao);
    }

    if(isset($funcionarioRequest->dataAdmissao)) {
	   $funcionario->setDataAdmissao(new \DateTime($funcionarioRequest->dataAdmissao));
    }

    $this->entityManager->merge($funcionario);
	$this->entityManager->flush();

    $this->app->response->setBody("{\"funcionario\":" . json_encode($funcionario,JSON_PRETTY_PRINT) . "}");
    $this->app->response->setStatus(200);
}

function getTreinamentosPorFuncionario($idFuncionario) {

	$query = $this->entityManager->createQuery("
        SELECT treinamento
        FROM App\Model\Treinamento treinamento
        WHERE treinamento.id IN (
            SELECT 	t.id
            FROM App\Model\FuncionarioTreinamento ft
            JOIN ft.treinamento t
            JOIN ft.funcionario f
            WHERE f.id = ?1)
");
	$query->setParameter(1, $idFuncionario);

	$treinamentos = $query->getResult();

    $this->app->response->setBody("{\"treinamentos\":" . json_encode($treinamentos,JSON_PRETTY_PRINT) . "}");
    $this->app->response->setStatus(200);
}

function removeFuncionario($id) {
    $funcionario = $this->entityManager->find("App\Model\Funcionario", $id);
    $this->entityManager->remove($funcionario);
	$this->entityManager->flush();
    $this->app->response->setStatus(204);

}
}
?>
