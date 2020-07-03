<?php

namespace App\Category;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

class GetAll implements MiddlewareInterface
{

    private $tableGatewa;

    public function __construct($tableGatewa)
    {
        $this->tableGatewa = $tableGatewa;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {

        $name = $request->getAttribute('name', NULL);

        if ($name != NULL) {
            $content = $this->tableGatewa->select('*')
                            ->from('category.json')
                            ->where(['name' => $name])->get();
        } else {
            $content = $this->tableGatewa->select('*')
                    ->from('category.json')
                    ->get();
        }

        return new JsonResponse($content);
    }

}
