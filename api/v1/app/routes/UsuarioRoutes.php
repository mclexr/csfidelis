<?php
use App\Controller\UsuarioController;
$usuarioController = new UsuarioController();

$app->get('/usuarios', function() use($usuarioController){
    $usuarioController->getUsuarios();
});

$app->get('/usuarios/:id', function($id) use($usuarioController){
    $usuarioController->getUsuario($id);
})->conditions(array('id' => '[0-9]+'));

$app->post('/usuarios', function() use($usuarioController){
    $usuarioController->addUsuario();
});

$app->put('/usuarios/:id', function($id) use($usuarioController){
    $usuarioController->updateUsuario($id);
})->conditions(array('id' => '[0-9]+'));

$app->delete('/usuarios/:id', function($id) use($usuarioController){
    $usuarioController->removeUsuario($id);
})->conditions(array('id' => '[0-9]+'));

$app->post('/recoverPassword', function($id) use($usuarioController){
    $usuarioController->recoverPassword($id);
})->conditions(array('id' => '[0-9]+'));


?>
