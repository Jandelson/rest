<?php

/**
 * ApiTeste
 * PHP Version 7
 * @author    Jandelson Oliveira <jandelson_oliveira@yahoo.com.br>
 * @version   Release: 1.0.0
 * @todo
 */

require __DIR__ . '/../vendor/autoload.php';

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;
use Api\Login;
use Api\Dados;

// Instantiate app
$login = new Login();
$dados = new Dados();
$app = AppFactory::create();
//$app->setBasePath("/rest");
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, true, true);


/**
 * Autenticação
 */
$auth = function (Request $request, RequestHandler $handler) use ($login) {
    $response = $handler->handle($request);
    $usuario = $request->getUri()->getUserInfo();
    list($usuario, $senha) = explode(':', $usuario);
    if ($login->validaLogin($usuario, $senha)) {
        return $response;
    } else {
        /**
         * Inicializa responsta
         */
        $mensagem = ['return' => 'Login inválido!'];
        $response = new $response();
        $response = $response->withStatus(403);
        $response->getBody()->write(json_encode($mensagem));
        return $response->withHeader('Content-Type', 'application/json');
    }
};

$app->get('/', function (Request $request, Response $response) use ($dados) {
    $response->getBody()->write($dados->getHome());
    return $response;
});

$app->group('/rest/api', function (RouteCollectorProxy $group) use ($dados) {
    /**
     * Produto
     */
    $group->any(
        '/produto/[{id}]',
        function (Request $request, Response $response, array $args) use ($dados) {
            $dados = $dados->retornaDadosProduto($args);
            $response->getBody()->write(json_encode($dados));
            return $response->withHeader('Content-Type', 'application/json');
        }
    );
    /**
     * Clientes
     */
    $group->any(
        '/cliente/[{id}/{datacadastro}]',
        function (Request $request, Response $response, array $args) use ($dados) {
            $dados = $dados->retornaDadosCliente($args);
            $response->getBody()->write(json_encode($dados));
            return $response->withHeader('Content-Type', 'application/json');
        }
    );
})->add($auth);

$app->run();
