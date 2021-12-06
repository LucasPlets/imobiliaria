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
        if  (isset($set['registro']) && !empty($set['registro'])){
            return $this->tableGateway->update($set,['registro' => $set['registro']]); //comando para atualizar a tabela
        }
        $this->tableGateway->insert($set); //comando para inserir a tabela no BD
    }

    public function listar()
    {
        return $this->tableGateway->select();
    }

    public function buscar(int $registro): Imoveis
    {
        $imoveis = $this->tableGateway->select(['registro' => $registro]);
        if($imoveis->count() != 0){
            return $imoveis->current(); 
        }
        return new Imoveis([]);
    }

    public function apagar(int $registro)
    {

        $this->tableGateway->delete(['registro' => $registro]);

    }

}