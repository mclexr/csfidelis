<?php
use App\Controller\FuncionarioController;
$funcionarioController = new FuncionarioController();

$app->get('/funcionarios', function() use($funcionarioController){
    $funcionarioController->getFuncionarios();
});

$app->get('/funcionarios/:id',function($id) use($funcionarioController){
    $funcionarioController->getFuncionario($id);
})->conditions(array('id' => '[0-9]+'));

$app->get('/funcionarios/:id/treinamentos', function($id) use($funcionarioController){
    $funcionarioController->getTreinamentosPorFuncionario($id);
})->conditions(array('id' => '[0-9]+'));

$app->post('/funcionarios', function() use($funcionarioController){
    $funcionarioController->addFuncionario();
});

$app->put('/funcionarios/:id', function($id) use($funcionarioController){
    $funcionarioController->updateFuncionario($id);
})->conditions(array('id' => '[0-9]+'));

$app->delete('/funcionarios/:id', function($id) use($funcionarioController){
    $funcionarioController->removeFuncionario($id);
})->conditions(array('id' => '[0-9]+'));

?>
