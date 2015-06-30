<?php
require_once "vendor/autoload.php";
use App\Model\Usuario;

$app = new \Slim\Slim();
$app->add(new App\Middleware\JsonMiddleware());
$app->config('debug', false);

require_once "app/routes/TokenRoutes.php";
require_once "app/routes/UsuarioRoutes.php";
require_once "app/routes/EmpresaRoutes.php";
require_once "app/routes/FuncaoRoutes.php";
require_once "app/routes/FuncionarioRoutes.php";
require_once "app/routes/TreinamentoRoutes.php";
require_once "app/routes/TipoTreinamentoRoutes.php";

$app->notFound(function() use($app) {
    $error = array("code" => "404", "message" => "Nada encontrado.");
    echo("{\"error\":" . json_encode($error, JSON_PRETTY_PRINT) . "}");
});

$app->error(function (\Exception $e) use ($app) {
    $app->response->headers->set('Content-Type','application/json');
    $error = array(
        "code" => $e->getCode(),
        "message" => $e->getMessage()
    );
    $app->response->setBody("{\"error\":" . json_encode($error, JSON_PRETTY_PRINT) . "}");
});


$app->run();
?>
