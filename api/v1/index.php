<?php
require_once "vendor/autoload.php";
error_reporting(E_ALL);
ini_set('display_errors', '1');
use Namshi\JOSE\SimpleJWS;
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
$key = "testeMaster";

$header = new \Psecio\Jwt\Header($key);
$jwt = new \Psecio\Jwt\Jwt($header);

$jwt
    ->issuer('http://example.org')
    ->audience('http://example.com')
    ->issuedAt(1356999524)
    ->notBefore(1357000000)
    ->expireTime(time()+3600)
    ->jwtId('id123456')
    ->type('https://example.com/register');

$result = $jwt->encode();
echo 'ENCODED: '.$result."\n\n";
echo 'DECODED: '.var_export($jwt->decode($result), true);


}
?>
