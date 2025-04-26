<?php
//Definir o diretorio de atuação
define("ROOT_PATH", __DIR__ . "/../");
//Definir o caminho do arquivo JSON que armazena os dados.
define("DATABASE_FILE", ROOT_PATH . "database.json");

require_once ROOT_PATH . "/Controller/Api/BaseController.php";

require_once ROOT_PATH . "/Model/UserModel.php";
require_once ROOT_PATH . "/Model/Database.php";
