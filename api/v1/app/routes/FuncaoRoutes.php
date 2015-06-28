<?php
use App\Controller\FuncaoController;
$funcaoController = new FuncaoController();

$app->get('/funcoes', function() use($funcaoController){
    $funcaoController->getFuncoes();
});

$app->get('/funcoes/:id', function($id) use($funcaoController){
    $funcaoController->getFuncao($id);
})->conditions(array('id' => '[0-9]+'));

$app->post('/funcoes', function() use($funcaoController){
    $funcaoController->addFuncao();
});

$app->put('/funcoes/:id', function($id) use($funcaoController){
    $funcaoController->updateFuncao($id);
})->conditions(array('id' => '[0-9]+'));

$app->delete('/funcoes/:id', function($id) use($funcaoController){
    $funcaoController->removeFuncao($id);
})->conditions(array('id' => '[0-9]+'));

?>
