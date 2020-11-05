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
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class StagiaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options, $salutaion = Stagiaire::SALUTATION, $diplome = Stagiaire::DIPLOME, $tempsLibre = Stagiaire::TEMPSLIBRE)
    {
        $builder
            ->add('situation', ChoiceType::class, ['choices'  => $salutaion, 'label'=>'Salutation:'])
            ->add('nomFamille',TextType::class, ['label'=>'Nom de famille:'])
            ->add('nomNaissance',TextType::class,['label'=>'Nom de naissance:'])
            ->add('prenom',TextType::class,['label'=>'Prénom:'])
            ->add('email',EmailType::class,['label'=>'Email:'])
            ->add('mobile',NumberType::class,['label'=>'N° tel mobile:'])
            ->add('fixe',NumberType::class,['label'=>'N° tel fixe:'])
            ->add('adresse',TextType::class,['label'=>'Adresse:'])
            ->add('birthday',DateType::class,['widget' => 'single_text','label' => 'Date de naissance:'])
            ->add('sociale',TextType::class,['label'=>'N° Securité Sociale:'])
            ->add('diplome', ChoiceType::class, ['choices'  => $diplome, 'label'=>'Diplome:'])
            ->add('emploi',TextType::class,['label'=>'Emploi:'])
            ->add('nDossier',TextType::class,['label'=>'N° de Dossier:'])
            ->add('formation',TextType::class,['label'=>'Formation:'])
            ->add('tempsLibre', ChoiceType::class, ['choices'  => $tempsLibre, 'label'=>'Temps libre:'])
            ->add('rdvFormateur',DateTimeType::class,['widget' => 'single_text','label'=>'Rdv Formateur:'])
            ->add('fondDisponible',NumberType::class,['label'=>'Fonds Disponible:'])
            ->add('prixFormation',NumberType::class,['label'=>'Prix Formation:'])
            ->add('comment',TextareaType::class,['label'=>'Commentaire:'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Stagiaire::class,
        ]);
    }
}
