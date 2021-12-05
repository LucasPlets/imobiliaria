<?php
namespace Cadastros\Controller;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;

class ImoveisControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null){
       $dbAdapter = $container->get('DbAdapter');
       return new ImoveisController ($dbAdapter);
    }
}
