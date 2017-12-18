<?php


namespace Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Models\UserModel;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints as Assert;
use Controller\UserController;

/**
 * @Entity()
 * @Table(name="user")
 */
class LoginForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
                'username',
                TextType::class,
                [
                    'constraints' => [
                        new Assert\NotBlank(),
                        new Assert\Regex([
                            'pattern' => '/^[A-Za-z0-9_-]$/'
                        ])
                    ]
                ]
            )->add(
                'password',
                TextType::class,
                [
                    'type' => PasswordType::class,
                    'required' => true,
                    [
                        'constraints' => [
                            new Assert\NotBlank()
                        ]
                    ]
                ]
            )->add(
                'number',
                TextType::class,
                [
                    'constraints' => [
                        new Assert\NotBlank(),
                    ]
                ] 
            )->add(
                'street',
                TextType::class,
                [
                    'constraints' => [
                        new Assert\NotBlank(),
                    ]
                ]  
            )->add(
                'zip',
                TextType::class,
                [
                    'constraints' => [
                        new Assert\NotBlank(),
                    ]
                ]  
            )->add(
                'city',
                TextType::class,
                [
                    'constraints' => [
                        new Assert\NotBlank(),
                    ]
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
                ]
            );
        
        if ($options['standalone']) {
            $builder->add('submit', SubmitType::class);
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('data_class', UserModel::class);
        $resolver->setDefault('standalone', false);
        
        $resolver->addAllowedTypes('standalone', 'bool');
    }
}
    
    
       