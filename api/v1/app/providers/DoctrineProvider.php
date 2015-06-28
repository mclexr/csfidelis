<?php
namespace App\Provider;

    use Doctrine\ORM\Tools\Setup;
    use Doctrine\ORM\EntityManager;

class DoctrineProvider {

    private static $entityManager;

    private static function createEntityManager() {

    //onde irão ficar as entidades do projeto? Defina o caminho aqui
    $entidades = array(
        'Usuario' => 'app/models/Usuario.php',
        'Empresa' => 'app/models/Empresa.php',
        'Funcao' => 'app/models/Funcao.php',
        'Funcionario' => 'app/models/Funcionario.php',
        'Treinamento' => 'app/models/Treinamento.php',
        'TipoTreinamento' => 'app/models/TipoTreinamento.php',
        'FuncionarioTreinamento' => 'app/models/FuncionarioTreinamento.php',
    );

    $isDevMode = true;
    // configurações de conexão. Coloque aqui os seus dados
    $baseParams = array(
        'driver' => 'pdo_mysql',
        'user' => 'root',
        'password' => 'root',
        'dbname' => 'csfidelis',
    );

        //setando as configurações definidas anteriormente
        $config = Setup::createAnnotationMetadataConfiguration($entidades, $isDevMode);

        //Retorna uma instância do EntityManager
        return EntityManager::create($baseParams, $config);
    }

    public static function getEntityManager() {
        if(!isset(self::$entityManager)) {
            self::$entityManager = self::createEntityManager();
        }
        return self::$entityManager;
    }

}

