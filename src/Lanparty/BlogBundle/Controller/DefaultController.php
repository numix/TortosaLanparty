<?php

namespace Lanparty\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
	public function portadaAction()
	{
		return $this->render('BlogBundle:Default:portada.html.twig');
	}
}
