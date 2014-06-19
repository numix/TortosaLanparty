<?php

namespace Lanparty\UsuariBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Lanparty\UsuariBundle\Entity\Usuari;

class Usuaris implements FixtureInterface, ContainerAwareInterface
{
	private $container;

	public function setContainer(ContainerInterface $container = null)
	{
		$this->container = $container;
	}

	public function load(ObjectManager $manager)
	{
		for ($i=1; $i<=500; $i++) {
			$usuari = new Usuari();

			$passwordEnClaro = 'usuari'.$i;
			$salt = md5(time());

			$encoder = $this->container->get('security.encoder_factory')
							->getEncoder($usuari);
			$password = $encoder->encodePassword($passwordEnClaro, $salt);
			
			$usuari->setPassword($password);
			$usuari->setSalt($salt);
			
		}

		$usuaris = array(
			array('nom' => 'Genis', 'cognoms' => 'Colome', 'email' => 'lanparty', 'password' => 'lanparty', 'salt' => 'lanparty', 'direccio' => 'lanparty', 'permet_email' => '1', 'data_alta' => '1-2-2014', 'data_naixement' => '14-11-1991', 'dni' => '12345678K', 'ciutat' => 'Tortosa'),
			//array('email' => 'admin', 'password' => 'admin'),
		);

		foreach ($usuaris as $usuari) {
			$entidad = new Usuari();

			$entidad->setEmail($usuari['email']);
			$entidad->setPassword($usuari['password']);

			$manager->persist($entidad);
		}

		$manager->flush();
	}
}
