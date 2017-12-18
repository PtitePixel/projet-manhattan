<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Controller\UserController;

//Request::setTrustedProxies(array('127.0.0.1'));

$app->get('/', function () use ($app) {
    return $app['twig']->render('index.html.twig', array());
})
->bind('homepage')
;

// PAGE RECHERCHE
$app->get('/search', function () use ($app) {
    return $app['twig']->render('search.html.twig', array());
})
->bind('search')
;

//PAGE INSCRIPTION
$app->get('/signin', function () use ($app) {
    return $app['twig']->render('signin.html.twig', array());
})
->bind('signin')
;

//PAGE CONNEXION
$app->get('/login', function () use ($app) {
    return $app['twig']->render('login.html.twig', array());
})
->bind('login')
;

//DECONNEXION
$app->get('/logout', function () use ($app) {
    return $app['twig']->render('logout.html.twig', array());
})
->bind('logout')
;


// PAGE COMPTE
$app->get('/user', function () use ($app) {
    return $app['twig']->render('user.html.twig', array());
})
->bind('user')
;

//PAGE ANNONCE
$app->get('/article', function () use ($app) {
    return $app['twig']->render('article.html.twig', array());
})
->bind('article')
;

//PAGE MENTION LEGALES
$app->get('/mentionslegales', function () use ($app) {
    return $app['twig']->render('mentions.html.twig', array());
})
->bind('mentions')
;

//PAGE CONTACT
$app->get('/contact', function () use ($app) {
    return $app['twig']->render('contact.html.twig', array());
})
->bind('contact')
;



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

