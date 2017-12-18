<?php


namespace Form;

/**
 * Description of UserForm
 *
 * @author MG
 */

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
                    ]
                ]
            )->add(
                'artPrice',
                IntegerType::class,
                [
                    'constraints' => [
                        new Assert\NotBlank()
                    ]
                ]
            )->add(
                'artDescription',
                TextType::class,
                [
                    'constraints' => [
                        new Assert\NotBlank(),
                    ]
                ]
            )->add(
                'artSold',  // ce ci doit être un raidio pout true ou false
                RadioType::class,// ca cest pas just pas trouver dans le manuel
                [
                    'choices' => [
                        'true' => 'Mettre en vente',
                        'false' => 'Déjà vendu (ne va plus être affiché sur le site)'
                    ]
                ]
            )->add(
                'categorie', 
                ChoiceType::class, //doit encore fonctionner avec la DB provisoir pour template
                [
                    'choices' => [
                        'Littérature' => 'Littérature',
                        'Informatique' => 'Informatique',
                        'Meubles' => 'Meubles' ,
                    ],
                    'placeholder' => 'Choisissez votre catégorie',
                ]
            );
        
        if ($options['standalone']) {
            $builder->add('submit', SubmitType::class);
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('data_class', ArticleModel::class);
        $resolver->setDefault('standalone', false);
        
        $resolver->addAllowedTypes('standalone', 'bool');
    }
}
    
    
       