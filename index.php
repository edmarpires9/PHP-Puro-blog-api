<?php
require __DIR__ . "/Config/config.php";
//Pega os atributos REQUEST_URI da variável global $_SERVER
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
//Quebra a variável do tipo String $uri e retorna varias substrings através do separador passado como parâmetro para o metodo explode();
$uri = explode('/', $uri);
/*isset() verifica se a $uri está diferente de null
$uri != 'api' verifica se o valor da variável é diferente de 'api'
*/
if (((isset($uri[1]) && $uri[1] != 'api')) || ((isset($uri[2]) && $uri[2] != 'v1'))) {
    header("HTTP/1.1 404 Not Found");
    exit();
} else if ((isset($uri[3]) && $uri[3] != 'user') || (!isset($uri[4]))) {
    header("HTTP/1.1 404 Not Found");
    exit();
}

//Inclusão da Classe UserController.php
require ROOT_PATH . "/Controller/API/UserController.php";

//Criado um objeto $user / nova instância da classe UserController
$user = new UserController();

//Concatena a string $uri[4] com a palavra Action e armazena essa string na variável methodName ou seja armazena o nome do metodo a ser chamado no objeto $user da classe UserController
$methodName = $uri[4] . 'Action';

$user->{$methodName}();