<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Classes;
use App\Entity\Entreprises;
use App\Entity\Modules;


class UsersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('roles')
            ->add('password', PasswordType::class,[
                
            ])
            ->add('isVerified',CheckboxType::class,[
                'label' => 'Compte Activé', 
                'data' => true,
           
            ])
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Étudiant' => 'ROLE_ETUDIANT',
                    'Intervenant' => 'ROLE_INTERVENANT',
                    'Entreprise' => 'ROLE_ENTREPRISE',
                    'Administrateur' => 'ROLE_ADMIN',
                    
                ],
                'expanded' => false,
                'multiple' => true,
                'required' => false,
                'label' => 'Rôles' 
            ])

            ->add('nom')
            ->add('prenom')
            ->add('adresse')
            ->add('telephone')
            ->remove('classes', EntityType::class, [
                'class' => Classes::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.nom', 'ASC');
                },
                'choice_label' => 'nom',
                'multiple' => true,
                
            ])
            ->remove('module', EntityType::class, [
                'class' => Modules::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.nom', 'ASC');
                },
                'choice_label' => 'nom',
                'multiple' => true,
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
