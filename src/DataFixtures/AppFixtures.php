<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Contact;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 50; $i++) {
            $contact = $this->createContact(
                $faker->lastName(),
                $faker->firstName(),
                $faker->phoneNumber()
            );
            $manager->persist($contact);
        }
        // $contacts = [
        //     $this->createContact('Dupont', 'Jean', '0123456789'),
        //     $this->createContact('Durand', 'Paul', '0123456789'),
        //     $this->createContact('Cage', 'Nicolas', '0123456789'),
        //     $this->createContact('Fromentin', 'Pascal', '0123456789')
        // ];

        // foreach ($contacts as $contact) {
        //     $manager->persist($contact);
        // }

        $manager->flush();
    }

    private function createContact(string $nom, string $prenom, string $telephone): Contact
    {
        $contact = new Contact();
        $contact
            ->setNom($nom)
            ->setPrenom($prenom)
            ->setTelephone($telephone);

        return $contact;
    }
}
