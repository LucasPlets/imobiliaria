<?php

namespace Cadastros\Model;

use Application\Model\ModelInterface;
use Laminas\Filter\FilterChain;
use Laminas\I18n\Filter\Alpha;
use Laminas\Filter\StringToUpper;
use Laminas\Validator\ValidatorChain;
use Laminas\Validator\StringLength;
use Laminas\I18n\Validator\Alpha as AlphaValidator;

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
        $tipo = ($data['tipo'] ?? '');
        $this->tamanho =($data['tamanho'] ?? 0);
        $this->valor =($data['valor'] ?? 0);
        $filterChain = new FilterChain();
        $filterChain->attach(new Alpha(true))
        ->attach(new StringToUpper());
        $this->tipo = $filterChain->filter($tipo);
        
    
    }

    public function toArray()
    {
        $attributes =  get_object_vars($this); //pega os dados e cria um Array 
        if($attributes['registro'] == 0){
            unset($attributes['registro']);
        }
        return $attributes;
    }

    public function valido(): bool
    {
        $validatorChain = new ValidatorChain();
        $validatorChain->attach(new StringLength(['min' => 3 , 'max' => 20]))
        ->attach(new AlphaValidator());
        return $validatorChain->isValid($this->tipo);
    } 
}
