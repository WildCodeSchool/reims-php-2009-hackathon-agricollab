<?php

namespace App\DataFixtures;

use App\Entity\Equipment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        for ($i = 0; $i < 10; $i++) {
            $tractorBrands = ['Massey Ferguson', 'New Holland', 'John Deere'];
            $equipment = new Equipment();
            $equipment->setBrand($tractorBrands[array_rand($tractorBrands, 1)]);
            $equipment->setType('tracteur');
            $equipment->setModel('xp4x4GO');
            $equipment->setLifeTime(mt_rand(3, 8));
            $equipment->setBuyValue(mt_rand(30000, 300000));
            $equipment->setResidualValue(mt_rand(2000, 20000));
            $equipment->setWorkTime('800');
            $manager->persist($equipment);
        }
        $manager->flush();
    }
}
