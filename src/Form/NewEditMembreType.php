<?php

namespace App\Form;

use App\Entity\Membres;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class NewEditMembreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $date = new \DateTime();
        $builder
            ->add('pseudo')
            // ->add('password', PasswordType::class)
            ->add('email', EmailType::class)
            ->add('mainimage', FileType::class, array('label' => 'Image', 'data_class' => null, 'required'=>false))
            ->add('ville')
            ->add('naissance', DateType::class, array(
                'widget' => 'choice',
                'years' => range(1950,$date->format('Y')),
                'format' => 'dd-MM-yyyy')
                )
            ->add('trait_caractere', ChoiceType::class, array(
                'choices'  => array(
                    "Calme" => "Calme",
                    "Sociable" => "Sociable",
                    "Aventureux" => "Aventureux",
                    "Drôle" => "Drôle",
            )))
            ->add('type_relation', ChoiceType::class, array(
                'choices'  => array(
                    "Durable" => "Durable",
                    "Sex friend" => "Sex friend",
                    "One shot" => "One shot",
            )))      
            ->add('silhouette', ChoiceType::class, array(
                'choices'  => array(
                    "Mince" => "Mince",
                    "Pulpeuse/sportif" => "Pulpeuse/sportif",
                    "Rond(e)" => "Rond(e)",
            )))
            ->add('yeux', ChoiceType::class, array(
                'choices'  => array(
                    "Noir" => "Noir",
                    "Gris" => "Gris",
                    "Marron" => "Marron",
                    "Bleu" => "Bleu",
                    "Vert" => "Vert",
            )))

            ->add('taille', ChoiceType::class, array(
                'choices'  => array(
                    "1,50-1,60" => "1,50-1,60",
                    "1,60-1,70" => "1,60-1,70",
                    "1,70-1,80" => "1,70-1,80",
                    "1,80-1,90" => "1,80-1,90",
                    "1,90-2,00" => "1,90-2,00",
            )))

            ->add('cheveux', ChoiceType::class, array(
                'choices'  => array(
                    "Châtain" => "Châtain",
                    "Noirs" => "Noirs",
                    "Blonds" => "Blonds",
                    "Roux" => "Roux",
            )))

            ->add('jesuis', ChoiceType::class, array(
                'choices'  => array(
                    "Homme" => 'Homme',
                    "Femme" => 'Femme',
                    "Couple" => 'Couple',
                    "Couple d'hommes" => "Couple d'hommes",
                    "Couple de femmes" => 'Couple de femmes',
                )))
            ->add('jeveux', ChoiceType::class, array(
                'choices'  => array(
                    "Homme" => 'Homme',
                    "Femme" => 'Femme',
                    "Couple" => 'Couple',
                    "Couple d'hommes" => "Couple d'hommes",
                    "Couple de femmes" => 'Couple de femmes',
                )))
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Membres::class,
        ]);
    }
}
