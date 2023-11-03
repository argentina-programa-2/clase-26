<?php
class API
{
    private $auth;

    public function __construct($auth)
    {
        $this->auth = $auth;
    }

    public function login($username, $password)
    {
        $token = $this->auth->authenticateUser($username, $password);

        if ($token) {
            return json_encode(array("token" => $token));
        } else {
            return json_encode(["error" => "Credenciales inválidas"]);
        }
    }
}
