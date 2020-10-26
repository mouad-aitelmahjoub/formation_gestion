<?php

namespace App\DataFixtures;

use App\Entity\Stagiaire;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager ,$diplome = Stagiaire::DIPLOME, $tempsLibre = Stagiaire::TEMPSLIBRE)
    {
        $faker = \Faker\Factory::create('fr_FR');

        for ($i=0; $i < 25; $i++) { 
            
            $stagiaire = new Stagiaire();

            $stagiaire->setPrenom($faker->firstName)
                        ->setSituation($faker->title)
                        ->setNomFamille($faker->lastName)
                        ->setNomNaissance($faker->lastName)
                        ->setEmail($faker->email)
                        ->setFixe($faker->numberBetween($min = 100000000, $max = 599999999))
                        ->setMobile($faker->numberBetween($min = 600000000, $max = 799999999))
                        ->setAdresse($faker->address)
                        ->setBirthday($faker->dateTime)
                        ->setSociale($faker->nir)
                        ->setDiplome($faker->randomElement(array_values($diplome)))
                        ->setEmploi($faker->jobTitle)
                        ->setNDossier($faker->swiftBicNumber)
                        ->setFormation($faker->sentence)
                        ->setTempsLibre($faker->randomElement(array_values($tempsLibre)))
                        ->setComment($faker->text)
            ;

            $manager->persist($stagiaire);
        }

        $manager->flush();
    }
}
