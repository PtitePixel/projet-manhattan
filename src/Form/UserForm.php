<?php


namespace Form;

/**
 * Description of UserForm
 *
 * @author MG
 */

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Models\UserModel;
use Controller\UserController;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Description of UserForm
 *
 * @author Etudiant
 */
class UserForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
                'firstname',
                TextType::class,
                [
                    'constraints' => [
                        new Assert\NotBlank()
                    ],
                    'label' => 'Prenom' 
                ]
            )->add(
                'lastname',
                TextType::class,
                [
                    'constraints' => [
                        new Assert\NotBlank()
                    ],
                    'label' => 'Nom' 
                ]
            )->add(
                'email',
                TextType::class,
                [
                    'constraints' => [
                        new Assert\NotBlank(),
                        new Assert\Regex([
                            'pattern' => '/^[a-zA-Z0-9.!#$%&’*+\=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/'
                        ])
                    ],
                    'label' => 'Mail' 
                ]
            )->add(
                'telephone',
                TextType::class,
                [
                    'constraints' => [
                        new Assert\NotBlank(),
                    ],
                     'label' => 'Telephone' 
                ]
            )->add(
                'username',
                TextType::class,
                [
                    'constraints' => [
                        new Assert\NotBlank(),
                       
                    ],
                    'label' => 'Pseudo' 
                ]
            )->add(
                'password',
                RepeatedType::class,
                [
                    'type' => PasswordType::class,
                    'required' => true,
                    'first_options' => [
                        'label' => 'Mot de Passe' 
                    ],
                    'second_options' => [
                        'label' => 'Retaper Mot de passe'
                    ],
                    'constraints' => [
                        new Assert\NotBlank()
                    ]
                ]
            )->add(
                'number',
                TextType::class,
                [
                    'constraints' => [
                        new Assert\NotBlank(),
                    ],
                     'label' => 'Numero' 
                ] 
            )->add(
                'street',
                TextType::class,
                [
                    'constraints' => [
                        new Assert\NotBlank(),
                    ],
                  'label' => 'Rue'    
                ]  
            )->add(
                'zip',
                TextType::class,
                [
                    'constraints' => [
                        new Assert\NotBlank(),
                    ],
                    'label' => 'Code Postal'  
                ]  
            )->add(
                'city',
                TextType::class,
                [
                    'constraints' => [
                        new Assert\NotBlank(),
                    ],
                    
                     'label' => 'Ville' 
                ]   
            )->add(
                'country', 
                ChoiceType::class, 
                [
                    'choices' => [
                        'Germany' => 'Deutschland',
                        'Begium' => 'Belgique',
                        'France' => 'France' ,
                        'Luxembourg' => 'Luxembourg',
                    ],
                    'placeholder' => 'Choisissez votre pays',
                    'label' => 'Pays' 
                ]
            );
        
        if ($options['standalone']) {
            $builder->add('submit', SubmitType::class,
             [
                    
                    'label' => "S'inscrire"
             ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('data_class', UserModel::class);
        $resolver->setDefault('standalone', false);
        
        $resolver->addAllowedTypes('standalone', 'bool');
    }
}
    
    
       