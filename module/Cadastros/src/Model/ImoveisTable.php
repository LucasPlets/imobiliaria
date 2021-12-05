<?php
namespace Cadastros\Model;

use Laminas\Db\TableGateway\TableGatewayInterface;

class ImoveisTable 
{
    private TableGatewayInterface $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function gravar (Imoveis $imoveis)
    {
        $set = $imoveis->toArray();  //seleciona de qual classe será enviado os atributos
        $this->tableGateway->insert($set); //comando para inserir a tabela no BD
    }

    public function listar()
    {
        return $this->tableGateway->select();
    }

}