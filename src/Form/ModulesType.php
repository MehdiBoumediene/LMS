<?php

namespace App\Form;

use App\Entity\Modules;
use App\Entity\Medias;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;
use Doctrine\ORM\EntityRepository;
use App\Entity\Blocs;
use App\Entity\Classes;
use App\Entity\Etudiants;
use App\Entity\Intervenants;

class ModulesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
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

            ->add('medias',FileType::class,[
                'label'=> false,
                'multiple' => true,
                'mapped'=> false,
                'required'=> false,
        
              

            ])


  
      
         
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Modules::class,
        ]);
    }
}
