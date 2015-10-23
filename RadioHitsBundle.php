<?php

namespace RadioHitsBundle;


use RadioHitsBundle\DependencyInjection\Compiler\RadioCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class RadioHitsBundle extends Bundle
{
	const BUNDLE_ALIAS = 'radio_hits';

	public function build(ContainerBuilder $container)
	{
		parent::build($container);
		$container->addCompilerPass(new RadioCompilerPass());
	}
}