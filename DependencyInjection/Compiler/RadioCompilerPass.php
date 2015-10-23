<?php

namespace RadioHitsBundle\DependencyInjection\Compiler;


use RadioHitsBundle\Radio\RadioManager;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class RadioCompilerPass implements CompilerPassInterface
{

	/**
	 * You can modify the container here before it is dumped to PHP code.
	 *
	 * @param ContainerBuilder $container
	 *
	 * @api
	 */
	public function process(ContainerBuilder $container)
	{
		if (! $container->hasDefinition('radio_manager'));


		$radioManager = $container->getDefinition('radio_manager');

		$radioServices = $container->findTaggedServiceIds('rhb.radio');

		foreach ($radioServices as $id => $attr) {
			$radioManager->addMethodCall(
				'addRadio',
				[ new Reference($id)]
			);
		}
	}
}