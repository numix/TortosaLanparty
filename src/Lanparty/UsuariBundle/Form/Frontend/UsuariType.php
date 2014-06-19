<?php
namespace Lanparty\UsuariBundle\Form\Frontend;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UsuariType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('nom')
			->add('cognoms')
			->add('email', 'email')
			->add('password', 'repeated', array(
				'type' => 'password',
				'invalid_message' => 'Les dos contrasenyes han de coincidir',
				'options' => array('label' => 'Contraseña')
			))
			->add('direccio')
			// S'ha d'eliminar
			->add('data_naixement', 'birthday')
			->add('dni')
			->add('ciutat')
		;
	}

	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'Lanparty\UsuariBundle\Entity\Usuari'
		));
	}

	public function getName()
	{
		return 'lanparty_usuaribundle_usuaritype';
	}
}