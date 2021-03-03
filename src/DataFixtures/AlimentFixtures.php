<?php

namespace App\DataFixtures;

use App\Entity\Aliment;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AlimentFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $a1 = new Aliment();
        $a1->setNom("Pomme")
          ->setCalories(20)
          ->setPrix(1000)
          ->setImage("pomme.png")
          ->setProteine(0.66)
          ->setGlucide(4.32)
          ->setLipide(0.31);
          $manager->persist($a1);

          $a2 = new Aliment();
          $a2->setNom("Poire")
          ->setCalories(12)
          ->setPrix(600)
          ->setImage("poire.png")
          ->setProteine(0.88)
          ->setGlucide(5.66)
          ->setLipide(1.44);
          $manager->persist($a2);

          $a3 = new Aliment();
          $a3->setNom("Pêche")
          ->setCalories(24)
          ->setPrix(1200)
          ->setImage("peche.png")
          ->setProteine(0.42)
          ->setGlucide(3.32)
          ->setLipide(0.48);
          $manager->persist($a3);

        $manager->flush();
    }
}
