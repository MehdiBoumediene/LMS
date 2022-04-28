<?php

namespace App\Form;

use App\Entity\Calendrier;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use App\Entity\Classes;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CalendrierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('start',DateTimeType::class,[
                'label' => 'Date début',
                'widget' => "single_text"
            ])
            ->add('end',DateTimeType::class,[
                'label' => 'Date fin',
                'widget' => "single_text"
                
            ])
            ->add('description')
            ->remove('all_day')
            ->add('background_color', ColorType::class,[
                'label' => 'Couleur du fond ',
                
                
            ])
            ->add('border_color', ColorType::class,[
                'label' => 'Couleur bordure ',
                
                
            ])
            ->add('text_color', ColorType::class,[
                'label' => 'Couleur du texte ',
                
                
            ])

            ->add('classe', EntityType::class, [
                'class' => Classes::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.nom', 'ASC');
                },
                'choice_label' => 'nom',
                'multiple'=>true
            ])

            ->remove('type')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Calendrier::class,
        ]);
    }
}
