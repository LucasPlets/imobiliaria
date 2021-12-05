<?php

namespace Cadastros\Controller;

use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class ImoveisController extends AbstractActionController
{

    private AdapterInterface $dbAdapter;

    public function __construct(AdapterInterface $dbAdapter )
    {
        $this->dbAdapter = $dbAdapter;
    }

    public function indexAction()
    {
        return new ViewModel();
    }

    public function editarAction()
    {
        return new ViewModel();
    }
    
    public function  gravarAction()
    {
        return $this->redirect()->toRoute('cadastros',[
            'controller' => 'imoveis',
            'action'     => 'index'
        ]);
    }
    


}