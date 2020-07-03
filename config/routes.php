<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Zend\Expressive\Application;
use Zend\Expressive\MiddlewareFactory;

/**
 * Setup routes with a single request method:
 *
 * $app->get('/', App\Handler\HomePageHandler::class, 'home');
 * $app->post('/album', App\Handler\AlbumCreateHandler::class, 'album.create');
 * $app->put('/album/:id', App\Handler\AlbumUpdateHandler::class, 'album.put');
 * $app->patch('/album/:id', App\Handler\AlbumUpdateHandler::class, 'album.patch');
 * $app->delete('/album/:id', App\Handler\AlbumDeleteHandler::class, 'album.delete');
 *
 * Or with multiple request methods:
 *
 * $app->route('/contact', App\Handler\ContactHandler::class, ['GET', 'POST', ...], 'contact');
 *
 * Or handling all request methods:
 *
 * $app->route('/contact', App\Handler\ContactHandler::class)->setName('contact');
 *
 * or:
 *
 * $app->route(
 *     '/contact',
 *     App\Handler\ContactHandler::class,
 *     Zend\Expressive\Router\Route::HTTP_METHOD_ANY,
 *     'contact'
 * );
 */
return function (Application $app, MiddlewareFactory $factory, ContainerInterface $container) : void {
    $app->get('/', App\Handler\HomePageHandler::class, 'home');
    $app->get('/api/ping', App\Handler\PingHandler::class, 'api.ping');
    $app->get('/v1/category/get-all/{name}', App\Category\GetAll::class, 'category.get.all.name');
    $app->get('/v1/category/get-all', App\Category\GetAll::class, 'category.all.get');
    $app->get('/v1/category/get/{id}', App\Category\Get::class, 'category.get');
    $app->post('/v1/category/create', App\Category\Create::class, 'category.post');
    $app->post('/v1/category/delete/{id}', App\Category\Delete::class, 'category.delete');
    $app->post('/v1/category/update/{id}', App\Category\Update::class, 'category.put');
//    $app->delete('/v1/category/{id}', App\Category\Delete::class, 'category.delete');
//    $app->put('/v1/category/{id}', App\Category\Update::class, 'category.put');
};
