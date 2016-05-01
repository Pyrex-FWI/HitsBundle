<?php

namespace HitsBundle;


use HitsBundle\DependencyInjection\Compiler\SourceCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class HitsBundle extends Bundle
{
	const BUNDLE_ALIAS = 'hits';

	public function build(ContainerBuilder $container)
	{
		parent::build($container);
		$container->addCompilerPass(new SourceCompilerPass());
	}
}