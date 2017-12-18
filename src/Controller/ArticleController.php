<?php

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
class ArticleController {

    public function getAllAction(Request $request, Application $app) {
        $repository = $app['orm.em']->getRepository(\Models\ArticleModel::class);

        $result = [];
        foreach ($repository->findAll() as $user) {
            $result[] = $user->toArray();
        }

        return $app->json($result);
    }
//genere la form de lârticle
    public function createArticleAction(Request $request, Application $app) {
 
        $article = new ArticleModel();

        $formFactory = $app['form.factory'];
        $articleForm = $formFactory->create(ArticleForm::class, $article, ['standalone' => true]);

        $articleForm->handleRequest($request);
        if ($articleForm->isSubmitted() && $articleForm->isValid()) {
            $entityManager = $app['orm.em'];

            $entityManager->persist($article);
            $entityManager->flush();

            return $app->redirect($app['url_generator']->generate('login'));
        }

        return $app['twig']->render(
                        'article.html.twig', [
                    'form' => $articleForm->createView()
                        ]
        );
    }
// c'est a partir d'ici que j'ai des problemes MG
    
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
