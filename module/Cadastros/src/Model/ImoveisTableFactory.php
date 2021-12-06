<?php
namespace Cadastros\Model;

use Interop\Container\ContainerInterface;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\ServiceManager\Factory\FactoryInterface;

class ImoveisTableFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $adapter = $container->get('DbAdapter');
        $resultSetPrototype = new ResultSet();
        $resultSetPrototype->setArrayObjectPrototype(new Imoveis([]));
        $tableGateway = new TableGateway('imoveis', $adapter,null,$resultSetPrototype);
        $imoveisTable = new ImoveisTable($tableGateway);
        return $imoveisTable;
    }
}