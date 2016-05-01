<?php

namespace HitsBundle\DependencyInjection\Compiler;


use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class SourceCompilerPass implements CompilerPassInterface
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
		if (! $container->hasDefinition('source_manager'));


		$sourceManager = $container->getDefinition('source_manager');

		$radioServices = $container->findTaggedServiceIds('hit.source');

		foreach ($radioServices as $id => $attr) {
			$sourceManager->addMethodCall(
				'addSource',
				[ new Reference($id)]
			);
		}
	}
}