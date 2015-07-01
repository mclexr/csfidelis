<?php
use App\Controller\TokenController;
$tokenController = new TokenController();

$app->map('/auth', function() use($tokenController){
    $tokenController->getToken();
})->via('GET', 'POST');

$app->get('/auth/verify', function() use($tokenController){
   $tokenController->verificarToken();
});

?>
