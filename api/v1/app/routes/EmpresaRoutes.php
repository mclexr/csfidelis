<?php
use App\Controller\EmpresaController;
$empresaController = new EmpresaController();

$app->get('/empresas', function() use($empresaController){
    $empresaController->getEmpresas();
});

$app->get('/empresas/:id',function($id) use($empresaController){
    $empresaController->getEmpresa($id);
})->conditions(array('id' => '[0-9]+'));

$app->get('/empresas/:id/funcionarios', function($id) use($empresaController){
    $empresaController->getFuncionariosPorEmpresa($id);
})->conditions(array('id' => '[0-9]+'));

$app->post('/empresas', function() use($empresaController){
    $empresaController->addEmpresa();
});

$app->put('/empresas/:id', function($id) use($empresaController){
    $empresaController->updateEmpresa($id);
})->conditions(array('id' => '[0-9]+'));


$app->delete('/empresas/:id', function($id) use($empresaController){
    $empresaController->removeEmpresa($id);
})->conditions(array('id' => '[0-9]+'));

?>
