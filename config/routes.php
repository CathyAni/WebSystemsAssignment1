<?php

declare(strict_types=1);

use Mezzio\Application;
use Mezzio\MiddlewareFactory;
use Psr\Container\ContainerInterface;
use Women\Handler\CreateEventHandler;
use Women\Handler\CreateStoryHandler;
use Women\Handler\ProfileHandler;
use Women\Handler\ShowEventFormHandler;
use Women\Handler\ShowProfileFormHandler;
use Women\Handler\ShowStoryFormHandler;

/**
 * FastRoute route configuration
 *
 * @see https://github.com/nikic/FastRoute
 *
 * Setup routes with a single request method:
 *
 * $app->get('/', App\Handler\HomePageHandler::class, 'home');
 * $app->post('/album', App\Handler\AlbumCreateHandler::class, 'album.create');
 * $app->put('/album/{id:\d+}', App\Handler\AlbumUpdateHandler::class, 'album.put');
 * $app->patch('/album/{id:\d+}', App\Handler\AlbumUpdateHandler::class, 'album.patch');
 * $app->delete('/album/{id:\d+}', App\Handler\AlbumDeleteHandler::class, 'album.delete');
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
 *     Mezzio\Router\Route::HTTP_METHOD_ANY,
 *     'contact'
 * );
 */

return static function (Application $app, MiddlewareFactory $factory, ContainerInterface $container): void {
    $app->get('/', App\Handler\HomePageHandler::class, 'home');
    $app->get('/api/ping', App\Handler\PingHandler::class, 'api.ping');

    $app->route("/women/event-form", [ShowEventFormHandler::class], ["GET"], "women.show.event.form");
    $app->route("/women/create-event", [CreateEventHandler::class], ["POST"], "women.create.event");

    $app->route("/women/create-profile", [ProfileHandler::class], ["POST"]);
    $app->route("/women/show-profile-form", [ShowProfileFormHandler::class], ["GET"]);

    $app->route("/women/create-story", [CreateStoryHandler::class], ["POST"]);
    $app->route("/women/show-story-form", [ShowStoryFormHandler::class], ["GET"]);
};
