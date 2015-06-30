<?php
use App\Controller\AuthController;
$authController = new AuthController();

$app->post('/auth', function() use($authController){

    $authController->getToken();
});

$app->get('/auth/verify', function() use($authController){
    $authController->verificarToken();
});

?>
