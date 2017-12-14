<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Controller\UserController;

//Request::setTrustedProxies(array('127.0.0.1'));

$app->match('/', 'Controller\UserController::registerAction')->bind('register');

$app->get('/admin/users', sprintf('%s::getAllAction', UserController::class))->bind('get_all_users');
$app->post('/admin/user', sprintf('%s::createUserAction', UserController::class))->bind('create_user');
$app->delete('/admin/user/{id}', sprintf('%s::deleteAction', UserController::class))->bind('delete_user');

$app->get('/admin', function () use ($app) {
    
    $user = null;
    $token = $app['security.token_storage']->getToken();  // Get current authentication token 
    
    if ($token !== null) {
        $user = $token->getUser();                        // Get user from token
    }
    
    // user is instance of Symfony\Component\Security\Core\User\UserInterface
    
    return $app['twig']->render('index.html.twig', array('user' => $user));
})
->bind('homepage')
;

$app->get('/login', function(Request $request) use ($app){
    return $app['twig']->render('login.html.twig', 
        [
            'error' => $app['security.last_error']($request),
            'last_username' => $app['session']->get('_security.last_username')
        ]
    );
})->bind('login');

$app->error(function (\Exception $e, Request $request, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    // 404.html, or 40x.html, or 4xx.html, or error.html
    $templates = array(
        'errors/'.$code.'.html.twig',
        'errors/'.substr($code, 0, 2).'x.html.twig',
        'errors/'.substr($code, 0, 1).'xx.html.twig',
        'errors/default.html.twig',
    );

    return new Response($app['twig']->resolveTemplate($templates)->render(array('code' => $code)), $code);
});
