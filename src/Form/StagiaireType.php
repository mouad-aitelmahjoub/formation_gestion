<?php

namespace App\Form;

use App\Entity\Stagiaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class StagiaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options, $salutaion = Stagiaire::SALUTATION, $diplome = Stagiaire::DIPLOME, $tempsLibre = Stagiaire::TEMPSLIBRE)
    {
        $builder
            ->add('situation', ChoiceType::class, ['choices'  => $salutaion, 'label'=>'Salutation'])
            ->add('nomFamille',TextType::class, ['label'=>'Nom de famille'])
            ->add('nomNaissance',TextType::class,['label'=>'Nom de naissance'])
            ->add('prenom',TextType::class,['label'=>'Prénom'])
            ->add('email',EmailType::class)
            ->add('mobile',NumberType::class,['label'=>'N° tel mobile'])
            ->add('fixe',NumberType::class,['label'=>'N° tel fixe'])
            ->add('adresse',TextType::class)
            ->add('birthday',DateType::class,['widget' => 'single_text','label' => 'Date de naissance'])
            ->add('sociale',TextType::class,['label'=>'N° Securité Social'])
            ->add('diplome', ChoiceType::class, ['choices'  => $diplome])
            ->add('emploi',TextType::class,['label'=>'Emploi'])
            ->add('nDossier',TextType::class,['label'=>'N° de Dossier'])
            ->add('formation',TextType::class,['label'=>'Formation'])
            ->add('tempsLibre', ChoiceType::class, ['choices'  => $tempsLibre, 'label'=>'Temps libre'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Stagiaire::class,
        ]);
    }
}
