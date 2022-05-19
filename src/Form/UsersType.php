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
use App\Entity\Formations;
use App\Entity\Entreprises;
use App\Entity\Modules;
use DateTime;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;

class UsersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('roles')
            ->remove('modiftime')
            ->add('created_at',DateTimeType::class,[
                'date_widget' => 'single_text',
                'label' => 'Date de création',
                "data" => new \DateTime(),
            ])
            ->add('password', PasswordType::class,[
                'required'=>false,
                'empty_data' => ''
            ])
            ->add('isVerified',CheckboxType::class,[
                'label' => 'Compte Activé', 
                'data' => true,
           
            ])
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Apprenant' => 'ROLE_ETUDIANT',
                    'Intervenant' => 'ROLE_INTERVENANT',
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
            ->add('formations', EntityType::class, [
                'class' => Formations::class,
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
    
            ->remove('estimationTime', TimeType::class, [
                'label'=>'Temps',
                'input'  => 'datetime',
                'widget' => 'choice',
            ])     

            ->add('blocage', CheckboxType::class, [
                'label'=>'Blocage du compte',
                'required'=>false,
           
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
