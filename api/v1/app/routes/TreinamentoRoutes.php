<?php
use App\Controller\TreinamentoController;
$treinamentoController = new TreinamentoController();

$app->get('/treinamentos', function() use($treinamentoController){
    $treinamentoController->getTreinamentos();
});

$app->get('/treinamentos/:id',function($id) use($treinamentoController){
    $treinamentoController->getTreinamento($id);
})->conditions(array('id' => '[0-9]+'));

$app->get('/treinamentos/:id/funcionarios', function($id) use($treinamentoController){
    $treinamentoController->getFuncionariosPorTreinamento($id);
})->conditions(array('id' => '[0-9]+'));

$app->post('/treinamentos', function() use($treinamentoController){
    $treinamentoController->addTreinamento();
});

$app->put('/treinamentos/:id', function($id) use($treinamentoController){
    $treinamentoController->updateTreinamento($id);
})->conditions(array('id' => '[0-9]+'));


$app->delete('/treinamentos/:id', function($id) use($treinamentoController){
    $treinamentoController->removeTreinamento($id);
})->conditions(array('id' => '[0-9]+'));


$app->post('/treinamentos/:id/funcionarios', function($id) use($treinamentoController){
    $treinamentoController->addFuncionario($id);
})->conditions(array('id' => '[0-9]+'));


?>
