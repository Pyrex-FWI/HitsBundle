<?php

/**
 * Created by PhpStorm.
 * User: chpyr
 * Date: 19/10/15
 * Time: 13:12
 */
class AppKernel extends \Symfony\Component\HttpKernel\Kernel
{

	/**
	 * Returns an array of bundles to register.
	 *
	 * @return \Symfony\Component\HttpKernel\Bundle\BundleInterface[] An array of bundle instances.
	 *
	 * @api
	 */
	public function registerBundles()
	{
		return [
				new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
				new \RadioHitsBundle\RadioHitsBundle(),
		];
	}

	/**
	 * Loads the container configuration.
	 *
	 * @param \Symfony\Component\Config\Loader\LoaderInterface $loader A LoaderInterface instance
	 *
	 * @api
	 */
	public function registerContainerConfiguration(\Symfony\Component\Config\Loader\LoaderInterface $loader)
	{
		$loader->load(__DIR__.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.yml');
	}
}