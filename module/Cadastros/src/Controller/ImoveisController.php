<?php

namespace Cadastros\Controller;

use Cadastros\Model\Imoveis;
use Cadastros\Model\ImoveisTable;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Session\Container;
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
        if ($this->flashMessenger()->hasMessages()){
            $sessionContainer = new Container();
            $imoveis = $sessionContainer->imoveis;
        } else {
            $registro = (int) $this->params('registro');
            $imoveis = $this->imoveisTable->buscar($registro);
        }
        
        $messages = $this->flashMessenger()->getMessages();
        $this->flashMessenger()->clearMessages();
        
        return new ViewModel([
            'imoveis' => $imoveis,
            'messages' => implode(',',$messages)
        ]);
    }
    
    public function  gravarAction()
    {
        $imoveis = new Imoveis($_POST);//cria a instancia e pega os dados 
        if (!$imoveis->valido()){
            $this->flashMessenger()->addMessage('Dados inválidos');
            $sessionContainer = new Container();
            $sessionContainer->corretor = $imoveis;
            return $this->redirect()->toRoute('cadastrosImoveis',[
                'controller' => 'imoveis',
                'action'     => 'editar'
            ]);
        }
        
        $this->imoveisTable->gravar($imoveis);
        
        return $this->redirect()->toRoute('cadastrosImoveis',[
            'controller' => 'imoveis',
            'action'     => 'index'
        ]);
    }
    
    public function apagarAction()
    {
        $registro = (int) $this->params('registro');
        $this->imoveisTable->apagar($registro);
        return $this->redirect()->toRoute('cadastrosImoveis',[
            'controller' => 'imoveis',
            'action'     => 'index'
        ]);
    }


}