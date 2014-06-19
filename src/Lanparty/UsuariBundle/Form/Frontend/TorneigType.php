<?php
namespace Lanparty\UsuariBundle\Form\Frontend;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TorneigType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('nom')
			->add('descripcio')
		;
	}

	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
			//'data_class' => 'Lanparty\UsuariBundle\Entity\Torneig'
			'data_class' => null
		));
	}

	public function getName()
	{
		return 'lanparty_usuaribundle_torneigtype';
	}
}