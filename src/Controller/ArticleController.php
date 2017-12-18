<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Controller;

use Symfony\Component\HttpFoundation\Request;
use Silex\Application;
use Models\ArticleModel;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Form\ArticleForm;


/**
 * Description of UserController
 *
 * @author Etudiant
 */
class AirticleController {

    public function getAllAction(Request $request, Application $app) {
        $repository = $app['orm.em']->getRepository(\Models\ArticleModel::class);

        $result = [];
        foreach ($repository->findAll() as $user) {
            $result[] = $user->toArray();
        }

        return $app->json($result);
    }

    public function createArticleAction(Request $request, Application $app) {
 
        if (!$request->request->has('art_title')) {
            $message = 'Insérer votre titre de votre Article!';
            return $app->json(['status' => 'error', 'message' => $message], 400);
        }

        if (!$request->request->has('art_price')) {
            $message = 'Insérer votre prix!';
            return $app->json(['status' => 'error', 'message' => $message], 400);
        }

        if (!$request->request->has('art_description')) {
            $message = 'Insérer votre description!';
            return $app->json(['status' => 'error', 'message' => $message], 400);
        }

        $artTitle = $request->request->get('art_title');
        $artPrice = $request->request->get('art_price');
        $artDescription = $request->request->get('art_description');
        $artsold = $request->request->get('art_sold');
        

        $roleInstance = $app['orm.em']->getRepository(\Models\ArticleModel::class)->findOneByLabel($role);
        if (!$role) {
            throw new NotFoundHttpException('Role ' . $role . ' not found');
        }

        $article= new UserModel();
        $article->setArtTitle($artTitle)
                ->setArtPrice($artPrice)
                ->setArtDescription($artDescription)
                ->setArtSold($artSold);

        $entityManager = $app['orm.em'];
        $entityManager->persist($user);
        $entityManager->flush();

        return $app->json($user->toArray());
    }
// c'est a partir d'ici que j'ai des problemes mg
    
    public function deleteAction(Request $request, Application $app, $artId) {
        $manager = $app['orm.em'];
        $repository = $manager->getRepository(ArticleModel::class);
        $article = $repository->find($artId);

        if (!$artId) {
            $message = sprintf('User %d not found', $artId);
            return $app->json(['status' => 'error', 'message' => $message], 404);
        }

        $manager->remove($user);
        $manager->flush();

        return $app->json(['status' => 'done']);
    }

    public function registerAction(Request $request, Application $app) {
        $article = new ArticleModel();

        $formFactory = $app['form.factory'];
        $articleForm = $formFactory->create(ArticleForm::class, $article, ['standalone' => true]);

        return $app['twig']->render(
                        'Article/ArticleSubmitTemplate.html.twig', [
                    'form' => $userForm->createView()
                        ]
        );
    }

}
