<?php

namespace App\Category;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

class Delete implements MiddlewareInterface
{

    private $tableGatewa;

    public function __construct($tableGatewa)
    {
        $this->tableGatewa = $tableGatewa;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {

        $id = $request->getAttribute('id');

        $content = $this->tableGatewa->select('*')
                ->from('category.json')
                ->where(['id' => $id])
                ->get();
        if (count($content) == 0) {
            return new JsonResponse($content, 404);
        }
        $content = $this->tableGatewa->delete()->from('category.json')->where(['id' => $id])->trigger();
        return new JsonResponse(["message"=>"Category deleted"]);
    }

}
