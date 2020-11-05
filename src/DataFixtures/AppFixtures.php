<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Stagiaire;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager ,$diplome = Stagiaire::DIPLOME, $tempsLibre = Stagiaire::TEMPSLIBRE)
    {
        $faker = \Faker\Factory::create('fr_FR');

        for ($j=0; $j < 4; $j++) { 
            
            $user = new User();

            $user->setUsername('agent0'. $j)
                    ->setroles(['ROLE_AGENT'])
                    ->setpassword($this->encoder->encodePassword($user,'123456'))
                    ->setName($faker->name)
            ;
            
            $manager->persist($user);
            
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
                            ->setCreatedAt($faker->dateTimeBetween($startDate = '-10 days', $endDate = '+10 days', $timezone = "Africa/Casablanca" ))
                            ->setRdvFormateur($faker->dateTimeBetween($startDate = 'now', $endDate = '+10 days', $timezone = "Africa/Casablanca" ))
                            ->setPrixFormation($faker->randomFloat($nbMaxDecimals = 2, $min = 1000, $max = 1500))
                            ->setFondDisponible($faker->randomFloat($nbMaxDecimals = 2, $min = 1500, $max = 2000))
                            ->setUser($user)
                ;
    
                $manager->persist($stagiaire);
            }
        }

        $user = new User();

        $user->setUsername('admin')
                ->setroles(['ROLE_ADMIN'])
                ->setpassword($this->encoder->encodePassword($user,'123456'))
                ->setName($faker->name)
        ;
        
        $manager->persist($user);
        
        $manager->flush();
    }
}
