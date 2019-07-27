<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

// require "fzaninotto/faker/src/autoload.php";

class UserFixtures extends Fixture
{

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {

        $user = new User();

        $user->setUsername('hamza');
        $mp = $this->encoder->encodePassword($user, 'demo');
        $user->setPassword($mp);
        $manager->persist($user);

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
