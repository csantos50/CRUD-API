<?php

namespace App\Category;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

class Create implements MiddlewareInterface
{

    private $tableGatewa;

    public function __construct($tableGatewa)
    {
        $this->tableGatewa = $tableGatewa;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $data =$request->getParsedBody();


        $data['id'] =  count( $this->tableGatewa->select('id')
                ->from('category.json')
                ->get()) + 1;

        $date = new \DateTime();
        $now = $date->format("Y-m-d H:i:s");

        $data['created'] = $now;
        $data['modified'] = $now;

        $content=$this->tableGatewa->insert('category.json', $data);
        
        return new JsonResponse($data);
  
    }

}
