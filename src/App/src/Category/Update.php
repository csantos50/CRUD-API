<?php

namespace App\Category;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

class Update implements MiddlewareInterface
{

    private $tableGatewa;

    public function __construct($tableGatewa)
    {
        $this->tableGatewa = $tableGatewa;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $id = $request->getAttribute('id',-1);
        $data =$request->getParsedBody();

        if($id < 0){
             return new JsonResponse($id, 404);
        }
        $date = new \DateTime();
        $now = $date->format("Y-m-d H:i:s");

        $data['modified'] = $now;
        unset($data['created']);

        $content = $this->tableGatewa->select('*')
                ->from('category.json')
                ->where(['id' => $id])
                ->get();
        if (count($content) == 0) {
            return new JsonResponse($content, 404);
        }
        $response = $this->tableGatewa->update($data)->from('category.json')->where(['id' => $id])->trigger();

        $result=$this->tableGatewa->select('*')
                ->from('category.json')
                ->where(['id' => $id])
                ->get();
        return new JsonResponse($result);
    }

}
