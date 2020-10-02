<?php

/**
 * Login
 * PHP Version 7
 * @author    Jandelson Oliveira <jandelson_oliveira@yahoo.com.br>
 * @version   Release: 1.0.0
 * @todo
 */

namespace Api;

class Login
{
    private $usuario;
    private $senha;
    private $usuarioTeste = [
        'usuario' => 'ADMIN',
        'senha' => '12345'
    ];

    public function validaLogin($usuario, $senha)
    {
        $this->usuario = $usuario;
        $this->senha = $senha;

        if (
            strtoupper($this->usuario) == $this->usuarioTeste['usuario']
            and strtoupper($this->senha) == $this->usuarioTeste['senha']
        ) {
            return true;
        }
    }
}
