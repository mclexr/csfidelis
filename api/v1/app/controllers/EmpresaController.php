<?php
namespace App\Controller;

	use App\Provider\DoctrineProvider;
	use App\Model\Empresa;

class EmpresaController {

	private $entityManager;
	private $app;

	public function __construct() {
        $this->entityManager = DoctrineProvider::getEntityManager();
        $this->app = \Slim\Slim::getInstance();
    }


function getEmpresa($id) {
	$empresa = $this->entityManager->find("App\Model\Empresa", $id);
    $this->app->response->setBody("{\"empresa\":" . json_encode($empresa,JSON_PRETTY_PRINT) . "}");
    $this->app->response->setStatus(200);
}

function getEmpresas() {
	$empresas = $this->entityManager->getRepository("App\Model\Empresa")->findAll();
    $this->app->response->setBody("{\"empresas\":" . json_encode($empresas,JSON_PRETTY_PRINT) . "}");
    $this->app->response->setStatus(200);
}

function addEmpresa() {
	$request = $this->app->request();
	$empresaRequest = json_decode($request->getBody());

	$empresa = new Empresa();
	$empresa->setNome($empresaRequest->nome);
	$empresa->setCnpj($empresaRequest->cnpj);
	$empresa->setEndereco($empresaRequest->endereco);

	$this->entityManager->persist($empresa);
	$this->entityManager->flush();

	$this->app->response->setBody("{\"empresa\":" . json_encode($empresa,JSON_PRETTY_PRINT) . "}");
    $this->app->response->setStatus(200);
}

function getFuncionariosPorEmpresa($id) {
	$funcionarios = $this->entityManager
        ->getRepository("App\Model\Funcionario")
        ->findBy(array('empresa' => $id));

    $this->app->response->setBody("{\"funcionarios\":" . json_encode($funcionarios,JSON_PRETTY_PRINT) . "}");
    $this->app->response->setStatus(200);

}


function updateEmpresa($id) {
	$request = $this->app->request();
	$empresaRequest = json_decode($request->getBody());

	$empresa = $this->entityManager->find("App\Model\Empresa", $id);

    if(isset($empresaRequest->nome)) {
	   $empresa->setNome($empresaRequest->nome);
    }

	if(isset($empresaRequest->cnpj)) {
        $empresa->setCnpj($empresaRequest->cnpj);
    }

    if(isset($empresaRequest->endereco)) {
	   $empresa->setEndereco($empresaRequest->endereco);
    }

	$this->entityManager->merge($empresa);
	$this->entityManager->flush();

	$this->app->response->setBody("{\"empresa\":" . json_encode($empresa,JSON_PRETTY_PRINT) . "}");
    $this->app->response->setStatus(200);
}

function removeEmpresa($id){
    $empresa = $this->entityManager->find("App\Model\Empresa", $id);
    $this->entityManager->remove($empresa);
	$this->entityManager->flush();
    $this->app->response->setStatus(204);
}


}
