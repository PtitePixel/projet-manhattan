<?php


namespace Form;

/**
 * @Entity()
 * @Table(name="article")
 */

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints as Assert;
use Models\ArticleModel;
use Controller\ArticleController;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

//image upload**********************************************
use Symfony\Component\Form\Extension\Core\Type\FileType;
//***********************************************************


/**
 * Description of UserForm
 *
 * @author Etudiant
 */
class ArticleForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
                'artTitle',
                TextType::class,
                [
                    'constraints' => [
                        new Assert\NotBlank()
                    ],
                    'label' => 'Titre'
                 ]   
                  
            )->add(
                'artPrice',
                NumberType::class,

                [
                    'constraints' => [
                        new Assert\NotBlank()
                    ],
                    'label' => 'Prix'
                ]
            )->add(
                'artDescription',
                TextareaType::class,
                [
                    'constraints' => [
                        new Assert\NotBlank(),
                    ],
                    'label' => 'Description'
                ]
            //image upload***************************************
            )->add(
                'artPicture', 
                FileType::class, 
                [
                    'label' => 'Téléverser une image (Fichier .JPG)',
                    'required' => false
                ]
            //*************************************************
            )->add(
                'artCategorie', 
                ChoiceType::class, //doit encore fonctionner avec la DB provisoir pour template
                [
                    'choices' => [
                        'Litterature' => 'Litterature',
                        'Informatique' => 'Informatique',
                        'Meubles' => 'Meubles' ,
                    ],
                    'placeholder' => 'Choisissez votre categorie',
                    'label' => 'Categorie'
                ]
            );
        
        if ($options['standalone']) {
            $builder->add('submit', SubmitType::class,
             [
                    
                    'label' => "Publier l'annonce"
             ]);
        }
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('data_class', ArticleModel::class);
        $resolver->setDefault('standalone', false);
        
        $resolver->addAllowedTypes('standalone', 'bool');
        $resolver->setDefaults(
                [
                    'data_class' => ArticleModel::class,
                ]   
        );
    }
}
    
    