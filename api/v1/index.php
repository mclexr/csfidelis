<?php
require_once "vendor/autoload.php";
error_reporting(E_ALL);
ini_set('display_errors', '1');

use App\Model\Usuario;

$app = new \Slim\Slim();
$app->response()->header('Content-Type', 'application/json;charset=utf-8');

$app->get('/', function () use($app) {

    testeJwt();
    //$app->notFound();
});

$app->notFound(function() use($app) {
    $error = array("code" => "404", "message" => "Nada encontrado.");
    echo("{\"error\":" . json_encode($error, JSON_PRETTY_PRINT) . "}");
});

$app->error(function (\Exception $e) use ($app) {
    $error = array("code" => $e->getCode(), "message" => $e->getMessage());
    echo("{\"error\":" . json_encode($error, JSON_PRETTY_PRINT) . "}");
});

require_once "app/routes/UsuarioRoutes.php";
require_once "app/routes/EmpresaRoutes.php";
require_once "app/routes/FuncaoRoutes.php";
require_once "app/routes/FuncionarioRoutes.php";
require_once "app/routes/TreinamentoRoutes.php";
require_once "app/routes/TipoTreinamentoRoutes.php";

$app->run();



function testeJwt() {
$key = "Familia#Amigos@Master!";
$dataToken = time();
try {
$token = array(
    "iss" => "mclexr@gmail.com",
    "aud" => "http://csfidelis/auth",
    "iat" => $dataToken,
    "exp" => $dataToken + 7200
);

$jwt = JWT::encode($token, $key);
$decoded = JWT::decode($jwt, $key, array('HS256'));


echo 'ENCODED: '.$jwt."\n";
echo 'DECODED: '.json_encode($decoded, JSON_PRETTY_PRINT);
echo "\n";
echo 'Criado em: '. date('d/m/Y H:i:s', $token["iat"]);
echo "\n";
echo 'Expira em: '. date('d/m/Y H:i:s', $token["exp"]);
} catch(\ExpiredException $e) {
    $error = array("code" => $e->getCode(), "message" => $e->getMessage());
    echo("{\"error\":" . json_encode($error, JSON_PRETTY_PRINT) . "}");
}
}
?>
