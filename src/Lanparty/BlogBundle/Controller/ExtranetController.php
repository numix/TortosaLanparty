<?php

namespace Lanparty\BlogBundle\Controller\ExtranetController.php

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

class ExtranetController extends Controller
{
	public function loginAction()
	{
		$peticio = $this->getRequest();
		$sesio   = $peticio->getSession();
		
		$error    = $peticio->attributes->get(
			SecurityContext::AUTHENTICATION_ERROR,
			$sesio->get(SecurityContext::AUTHENTICATION_ERROR)
		);

		return $this->render('BlogBundle:Extranet:login.html.twig', array(
			'error'   => $error
		));
	}
}


