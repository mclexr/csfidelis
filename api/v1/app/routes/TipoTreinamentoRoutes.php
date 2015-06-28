<?php
use App\Controller\TipoTreinamentoController;
$tipoTreinamentoController = new TipoTreinamentoController();

$app->get('/tipostreinamento', function() use($tipoTreinamentoController){
    $tipoTreinamentoController->getTiposTreinamento();
});

$app->get('/tipostreinamento/:id', function($id) use($tipoTreinamentoController){
    $tipoTreinamentoController->getTipoTreinamento($id);
})->conditions(array('id' => '[0-9]+'));

$app->post('/tipostreinamento', function() use($tipoTreinamentoController){
    $tipoTreinamentoController->addTipoTreinamento();
});

$app->put('/tipostreinamento/:id', function($id) use($tipoTreinamentoController){
    $tipoTreinamentoController->updateTipoTreinamento($id);
})->conditions(array('id' => '[0-9]+'));

$app->delete('/tipostreinamento/:id', function($id) use($tipoTreinamentoController){
    $tipoTreinamentoController->removeTipoTreinamento($id);
})->conditions(array('id' => '[0-9]+'));

?>
