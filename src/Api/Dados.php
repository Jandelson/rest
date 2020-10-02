<?php

/**
 * Dados
 * PHP Version 7
 * @author    Jandelson Oliveira <jandelson_oliveira@yahoo.com.br>
 * @version   Release: 1.0.0
 * @todo
 */

namespace Api;

class Dados
{
    /*
    * Apresentação da API
    */
    public function getHome()
    {
        $mensagem = 'Bem vindo a Api! para usar o metodos da api, realizar a chamada usando /rest/api/{nome_do_metodo} - ';
        $mensagem .= 'Exemplo: http://localhost/rest/api/produtos/1';

        return $mensagem;
    }
    public function retornaDadosProduto(array $args)
    {
        $produto =  [
            1 => 'Produto 1',
            2 => 'Produto 2',
            3 => 'Produto 3', 
            4 => 'Produto 4', 
            5 => 'Produto 5', 
        ];

        if($args['id'] > 0) {
            return $produto[$args['id']];
        }

        return $produto;
    }

    public function retornaDadosCliente(array $args)
    {
        $cliente =  [
            1 => [
                'nome' => 'Cliente 1',
                'datacadastro' => '2020-01-01'
            ],
            2 => [
                'nome' => 'Cliente 2',
                'datacadastro' => '2020-02-01'
            ],
            3 => [
                'nome' => 'Cliente 3',
                'datacadastro' => '2020-03-01'
            ]
        ];

        if ($args['id']) {
            return $cliente[$args['id']];
        }

        if ($args['datacadastro']) {
            return $cliente[$args['id']][$args['datacadastro']];
        }

        return $cliente;
    }
}
