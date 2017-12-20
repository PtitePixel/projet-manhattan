<?php

namespace Controller;

use Symfony\Component\HttpFoundation\Request;
use Silex\Application;
use Models\ArticleModel;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Form\ArticleForm;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;



/**
 * Description of UserController
 *
 * @author Etudiant
 */
class ArticleController {

    public function getAllAction(Request $request, Application $app) {
        $repository = $app['orm.em']->getRepository(\Models\ArticleModel::class);

        $result = [];
        foreach ($repository->findAll() as $article) {
            $result[] = $article->toArray();
        }

        return $app->json($result);
    }
//genere la form de l'article
    public function createArticleAction(Request $request, Application $app) {
 
        $article = new ArticleModel();
        
        $formFactory = $app['form.factory'];
        $articleForm = $formFactory->create(ArticleForm::class, $article, ['standalone' => true]);

        $articleForm->handleRequest($request);
        if ($articleForm->isSubmitted() && $articleForm->isValid()) {
            $entityManager = $app['orm.em'];
//Image upload****************************************
            $file = $article->getArtPicture();

            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            // Move the file to the directory where brochures are stored
            $file->move(
                $app['upload.path'],
                $fileName
            );
             // Update the 'brochure' property to store the PDF file name
            // instead of its contents
            $article->setArtpicture($fileName);
//***************************************************
            $entityManager->persist($article);
            $entityManager->flush();

            return $app->redirect($app['url_generator']->generate('homepage')); //redirect pas just a voir avec pixel MG
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
                    'form' => $articleForm->createView()
                        ]
        );
    }

}