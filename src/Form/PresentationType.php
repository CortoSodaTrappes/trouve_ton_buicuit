<?php

namespace App\Form;

use App\Entity\Presentations;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PresentationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('presentation')
            ->add('type_personne', ChoiceType::class, array(
                'choices'  => array(
                    'h' => "Homme",
                    'f' => "Femme",
                    'hf' => "Couple",
                    'hh' => "Couple d'hommes",
                    'ff' => "Couple de femmes",
                )))
            ->add('type_relation')
            ->add('id_membre')
            ->add('save', SubmitType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // 'data_class' => Presentations::class,
            'data_class' => null,
        ]);
    }
}
