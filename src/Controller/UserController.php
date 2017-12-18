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

    public function createUserAction(Request $request, Application $app) {

        if (!$request->request->has('user_firstname')) {
            $message = 'Firstname must be defined';
            return $app->json(['status' => 'error', 'message' => $message], 400);
        }

        if (!$request->request->has('user_lastname')) {
            $message = 'Lastname must be defined';
            return $app->json(['status' => 'error', 'message' => $message], 400);
        }

        if (!$request->request->has('user_username')) {
            $message = 'Username must be defined';
            return $app->json(['status' => 'error', 'message' => $message], 400);
        }

        if (!$request->request->has('user_email')) {
            $message = 'Email must be defined';
            return $app->json(['status' => 'error', 'message' => $message], 400);
        }

        if (!$request->request->has('user_telephone')) {
            $message = 'Telephone must be defined';
            return $app->json(['status' => 'error', 'message' => $message], 400);
        }

        if (!$request->request->has('user_number')) {
            $message = 'House_number must be defined';
            return $app->json(['status' => 'error', 'message' => $message], 400);
        }

        if (!$request->request->has('user_street')) {
            $message = 'Street must be defined';
            return $app->json(['status' => 'error', 'message' => $message], 400);
        }

        if (!$request->request->has('user_city')) {
            $message = 'City must be defined';
            return $app->json(['status' => 'error', 'message' => $message], 400);
        }

        if (!$request->request->has('user_zip')) {
            $message = 'Zip must be defined';
            return $app->json(['status' => 'error', 'message' => $message], 400);
        }

        if (!$request->request->has('user_country')) {
            $message = 'Country must be defined';
            return $app->json(['status' => 'error', 'message' => $message], 400);
        }

        if (!$request->request->has('user_password')) {
            $message = 'Password must be defined';
            return $app->json(['status' => 'error', 'message' => $message], 400);
        }

        $username = $request->request->get('user_username');
        $password = $request->request->get('user_password');
        $role = $request->request->get('user_role');
        // $firstname = $_POST['user_firstname'];
        $firstname = $request->request->get('user_firstname');
        // $lastname = $_POST['user_lastname'];
        $lastname = $request->request->get('user_lastname');
        $email = $request->request->get('user_email');
        $telephone = $request->request->get('user_telephone');
        $username = $request->request->get('user_name');
        $number = $request->request->get('user_number');
        $street = $request->request->get('user_street');
        $city = $request->request->get('user_city');
        $zip = $request->request->get('user_zip');
        $country = $request->request->get('user_country');

        $roleInstance = $app['orm.em']->getRepository(\Models\Role::class)->findOneByLabel($role);
        if (!$role) {
            throw new NotFoundHttpException('Role ' . $role . ' not found');
        }

        $user = new UserModel();
        $user->setFirstname($firstname)
                ->setLastname($lastname)
                ->setEmail($email)
                ->setTelephone($telephone)
                ->setNumber($number)
                ->setStreet($street)
                ->setCity($city)
                ->setZip($zip)
                ->setCountry($country)
                ->setUsername($username)
                ->setPassword($password)
                ->setRoles([$roleInstance]);

        $entityManager = $app['orm.em'];
        $entityManager->persist($user);
        $entityManager->flush();

        return $app->json($user->toArray());
    }

    public function deleteAction(Request $request, Application $app, $id) {
        $manager = $app['orm.em'];
        $repository = $manager->getRepository(UserModel::class);
        $user = $repository->find($id);

        if (!$user) {
            $message = sprintf('User %d not found', $id);
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

        $userForm->handleRequest($request);
        if ($userForm->isSubmitted() && $userForm->isValid()) {
            $entityManager = $app['orm.em'];
            $roleRepository = $entityManager->getRepository(Role::class);
            $userRole = $roleRepository->findOneByLabel('ROLE_USER');

            $user->addRole($userRole);

            $entityManager->persist($user);
            $entityManager->flush();

            return $app->redirect($app['url_generator']->generate('login'));
        }

        return $app['twig']->render(
                        'User/RegistrationTemplate.html.twig', [
                    'form' => $userForm->createView()
                        ]
        );
    }

}
