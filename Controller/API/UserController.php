<?php
class UserController extends BaseController
{
    public function listAction()
    {
        $erroDescription = '';
        $erroHeader = "";
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $stringParamsArray = $this->getStringParams();

        if (strtoupper($requestMethod) == 'GET') {
            try {
                $userModel = new UserModel();
                $intLimit = 10;

                if (isset($stringParamsArray['limit']) && $stringParamsArray['limit']) {
                    $intLimit = $stringParamsArray;
                }

                $usersArray = $userModel->getUsers($intLimit);
                $responseData = json_encode($usersArray);
            } catch (Error $e) {
                $erroDescription = $e->getMessage() . "Algo deu errado. $erroDescription";
                $errorHeader = 'HTTP/1.1. 500 Internal Server Error. $erroHeader';
            }
        } else {
            $erroDescription = "Metodo não suportado! $erroDescription";
            $erroHeader = 'HTTP/1.1  422 Unprocessable Entity';
        }

        if (!$erroDescription) {
            $this->sendOutput($responseData, array('Content-Type: application/json', 'HTTP/1.1 200 OK'));
        } else {
            $this->sendOutput(json_encode(array('error' => $erroDescription)), array('Content-Type: application/json', $erroHeader));
        }
    }
}
