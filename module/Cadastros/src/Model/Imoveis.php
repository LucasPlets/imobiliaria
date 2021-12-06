<?php

namespace Cadastros\Model;

use Application\Model\ModelInterface;

class Imoveis 
{

    public int $registro;
    public string $tipo;
    public int $tamanho;
    public float $valor;

    public function __construct(array $data)
    {
       $this->exchangeArray($data);
    }

    public function exchangeArray(array $data)
    {
        $this->registro = (int) ($data['registro'] ?? 0);
        $this->tipo = ($data['tipo'] ?? '');
        $this->tamanho = ($data['tamanho'] ?? 0);
        $this->valor = ($data['valor'] ?? 0);

    }

    public function toArray()
    {
        $attributes =  get_object_vars($this); //pega os dados e cria um Array 
        if($attributes['registro'] == 0){
            unset($attributes['registro']);
        }
        return $attributes;
    }
}
