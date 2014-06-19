<?php

namespace Lanparty\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LlocController extends Controller
{
	public function estaticaAction($pagina)
	{
		return $this->render('BlogBundle:Lloc:'.$pagina.'.html.twig');
	}
}