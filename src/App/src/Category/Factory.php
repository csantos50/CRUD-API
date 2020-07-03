<?php

namespace App\Category;

use Interop\Container\ContainerInterface;
use Jajo\JSONDB;

class Factory
{

    public function __invoke(ContainerInterface $container, $requestedName)
    {
        $config = $container->get('config');

        $tableGateway = new JSONDB($config['db_json']);

        return new $requestedName($tableGateway);
    }

}
