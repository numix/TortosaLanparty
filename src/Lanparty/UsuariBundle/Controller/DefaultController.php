<?php

namespace Lanparty\UsuariBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Lanparty\UsuariBundle\Entity\Usuari;
use Lanparty\UsuariBundle\Entity\Torneig;
use Lanparty\UsuariBundle\Form\Frontend\UsuariType;
use Lanparty\UsuariBundle\Form\Frontend\TorneigType;


class DefaultController extends Controller
{
    public function defaultAction()
	{
		$usuari = new Usuari();

		$encoder = $this->get('security.encoder_factory')
						->getEncoder($usuari);
		$password = $encoder->encodePassword(
			'la-contraseña-en-claro',
			$usuari->getSalt()
		);

		$usuari->setPassword($password);
		
		//$usuari = $this->get('security.context')->getToken()->getUser();
		//$nom = $usuari->getNom();
	}

	public function loginAction()
	{
		$peticio = $this->getRequest();
		$sesio = $peticio->getSession();
		
		$error = $peticio->attributes->get(
			SecurityContext::AUTHENTICATION_ERROR,
			$sesio->get(SecurityContext::AUTHENTICATION_ERROR)
		);

		return $this->render('UsuariBundle:Default:login.html.twig', array(
			'last_username' => $sesio->get(SecurityContext::LAST_USERNAME),
			'error'			=> $error
		));
	}

	public function caixaLoginAction()
	{
		$peticio = $this->getRequest();
		$sesio = $peticio->getSession();
		
		$error = $peticio->attributes->get(
			SecurityContext::AUTHENTICATION_ERROR,
			$sesio->get(SecurityContext::AUTHENTICATION_ERROR)
		);

		return $this->render('UsuariBundle:Default:caixaLogin.html.twig', array(
			'last_username' => $sesio->get(SecurityContext::LAST_USERNAME),
			'error'			=> $error
		));
	}

    public function indexAction()
    {
       	$peticio = $this->getRequest();
		$sesio = $peticio->getSession();
		
		$error = $peticio->attributes->get(
			SecurityContext::AUTHENTICATION_ERROR,
			$sesio->get(SecurityContext::AUTHENTICATION_ERROR)
		);

		return $this->render('UsuariBundle:Default:index.html.twig', array(
			'last_username' => $sesio->get(SecurityContext::LAST_USERNAME),
			'error'			=> $error
		));
    }

    public function registreAction()
	{

		$peticio = $this->getRequest();

		$usuari = new Usuari();
		$formulari = $this->createForm(new UsuariType(), $usuari);

		$formulari->handleRequest($peticio);

		if ($formulari->isValid()) {
			$encoder = $this->get('security.encoder_factory')
							->getEncoder($usuari);
			$usuari->setSalt(md5(time()));
			$passwordCodificat = $encoder->encodePassword(
				$usuari->getPassword(),
				$usuari->getSalt()
			);
			$usuari->setPassword($passwordCodificat);
			
			$em = $this->getDoctrine()->getManager();

			$em->persist($usuari);
			$em->flush();
		
			$this->get('session')->getFlashBag()->add('info', 'Done!');
			
			// Anar a URL portada
			//return $this->redirect($this->generateUrl('portada'));
		}
		
		return $this->render('UsuariBundle:Default:registre.html.twig',
		array('formulari' => $formulari->createView())
		);

	}

	public function torneigAction()
	{
		$em = $this->getDoctrine()->getManager();
		$torneig = $em->getRepository('UsuariBundle:Torneig')->findAll();

		return $this->render('UsuariBundle:Default:torneig.html.twig', array(
	 		'torneig' => $torneig
	 		));
	}

	public function canviarAction($slug)
	{
	

		return $this ->render('UsuariBundle:Default:torneigfinal.html.twig',
			array('slug' => $slug)
		);
	}

	public function torneig_finalAction($slug)
	{

		return new RedirectResponse($this->generateUrl(
		'usuari_torneig',
		array('slug' => $slug)
		));

		return $this ->render('UsuariBundle:Default:torneigfinal.html.twig',
			array('slug' => $slug)
		);

		$torneig = $em->getRepository('UsuariBundle:Torneig')->findAll();

		return $this->render('UsuariBundle:Default:torneig.html.twig', array(
	 		'torneig' => $torneig
	 		));

		return $this->render('UsuariBundle:Default:torneig-exacte.html.twig', array(
	 		'torneig' => $torneig
	 		));
	}

	public function torneig_exacteAction($slug)
	{

		$torneig = new Torneig();

		$em = $this->getDoctrine()->getManager();
		$torneig = $em	->getRepository('UsuariBundle:Torneig')
						->findBy(
							array('slug'=> $slug)
				        	);

		return $this->render('UsuariBundle:Default:torneigfinal.html.twig', array(
	 		'torneig' => $torneig
		));
		
	}

	public function insertartorneigAction(){

		$peticio = $this->getRequest();

		$torneig = new Torneig();

		$formulari = $this->createForm(new TorneigType(), $torneig);

		$formulari->handleRequest($peticio);

		if ($formulari->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($torneig);
			$em->flush();
			return $this->redirect($this->generateUrl('usuari_torneig'));
		}

		return $this->render('UsuariBundle:Default:torneigfinal.html.twig', array(
	 		'formulari' => $formulari->createView()
		));
	}
	public function llistausuariAction(){

		$usuari = new Usuari();

		$em = $this->getDoctrine()->getManager();
		$usuari = $em	->getRepository('UsuariBundle:Usuari')
						->findAll();

		return $this->render('UsuariBundle:Default:llista.html.twig', array(
	 		'usuari' => $usuari
		));

	}


}
