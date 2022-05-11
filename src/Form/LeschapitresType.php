<?php

namespace App\Form;

use App\Entity\Lesmodules;
use App\Entity\Chapitres;
use App\Entity\Formations;
use App\Entity\Medias;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Doctrine\ORM\EntityRepository;
use App\Entity\Blocs;
use App\Entity\Classes;
use App\Entity\Etudiants;
use App\Entity\Intervenants;
use App\Entity\Leschapitres;

class LeschapitresType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nom')
        ->add('description',TextareaType::class)
        ->remove('created_at')
        ->remove('created_by')
        ->remove('bloc', EntityType::class, [
            'class' => Blocs::class,
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('u')
                    ->orderBy('u.nom', 'ASC');
            },
            'choice_label' => 'nom',
        ])

        ->remove('classes', EntityType::class, [
            'class' => Classes::class,
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('u')
                    ->orderBy('u.nom', 'ASC');
            },
            'choice_label' => 'nom',
        ])
        
        ->add('modules', EntityType::class, [
            'class' => Lesmodules::class,
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('u')
                    ->orderBy('u.nom', 'ASC');
            },
            'choice_label' => 'nom',
            'multiple' => true,
        ])

        ->add('files',FileType::class,[
            'label'=> false,
            'multiple' => true,
            'mapped'=> false,
            'required'=> false,
    
        
        ])

        ->add('medias',FileType::class,[
            'label'=> false,
            'multiple' => true,
            'mapped'=> false,
            'required'=> false,
    
          

        ])


        ->add('formations', EntityType::class, [
            'class' => Formations::class,
            
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('u')
                    ->orderBy('u.nom', 'ASC');
            },
            'choice_label' => 'nom',
        ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Leschapitres::class,
        ]);
    }
}
