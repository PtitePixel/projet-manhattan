<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Controller;

use Symfony\Component\HttpFoundation\Request;
use Silex\Application;
use Models\UserModel;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Form\UserForm;
use Models\Role;


/**
 * Description of UserController
 *
 * @author Etudiant
 */
class UserController {

    public function getAllAction(Request $request, Application $app) {
        $repository = $app['orm.em']->getRepository(\Models\UserModel::class);

        $result = [];
        foreach ($repository->findAll() as $user) {
            $result[] = $user->toArray();
        }

        return $app->json($result);
    }

//genere la form du User
    public function createUserAction(Request $request, Application $app) {
 
        $user = new UserModel();

        $formFactory = $app['form.factory'];
        $userForm = $formFactory->create(UserForm::class, $user, ['standalone' => true]);

        $userForm->handleRequest($request);
        if ($userForm->isSubmitted() && $userForm->isValid()) {
            $entityManager = $app['orm.em'];
            
            $role = $app['orm.em']->getRepository(Role::class)->findOneByLabel('ROLE_USER');
            $user->addRole($role);

            $entityManager->persist($user);
            $entityManager->flush();

            return $app->redirect($app['url_generator']->generate('login'));
        }

        return $app['twig']->render(
                        'signin.html.twig', [
                    'form' => $userForm->createView()
                        ]
        );
    }
       // c'est a partir d'ici que j'ai des problemes MG
    
    public function deleteAction(Request $request, Application $app, $Id) {
        $manager = $app['orm.em'];
        $repository = $manager->getRepository(ArticleModel::class);
        $user = $repository->find($Id);

        if (!$Id) {
            $message = sprintf('User %d not found', $Id);
            return $app->json(['status' => 'error', 'message' => $message], 404);
        }

        $manager->remove($user);
        $manager->flush();

        return $app->json(['status' => 'done']);
    }

    public function registerAction(Request $request, Application $app) {
        $user = new UserModel();

        $formFactory = $app['form.factory'];
        $userForm = $formFactory->create(UserForm::class, $user, ['standalone' => true]);
//attention a modifier ok
        return $app['twig']->render(
                        'signin.html.twig', [
                    'form' => $userForm->createView()
                        ]
        );
    }

}
