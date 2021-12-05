<?php

namespace Cadastros\Controller;

use Cadastros\Model\Imoveis;
use Cadastros\Model\ImoveisTable;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class ImoveisController extends AbstractActionController
{

    private ImoveisTable $imoveisTable;

    public function __construct(ImoveisTable $imoveisTable)
    {
        $this->imoveisTable = $imoveisTable;
    }

    public function indexAction()
    {
        $imoveis = $this->imoveisTable->listar();
        return new ViewModel([
            'imoveis' => $imoveis
        ]);
    }

    public function editarAction()
    {
        return new ViewModel();
    }
    
    public function  gravarAction()
    {
        $imoveis = new Imoveis($_POST); //cria a instancia e pega os dados
        $this->imoveisTable->gravar($imoveis);


        return $this->redirect()->toRoute('cadastros',[
            'controller' => 'imoveis',
            'action'     => 'index'
        ]);
    }
    


}