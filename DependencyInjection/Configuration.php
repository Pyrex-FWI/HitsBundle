<?php

namespace HitsBundle\DependencyInjection;

use DeejayPoolBundle\DeejayPoolBundle;
use Symfony\Component\Config\Definition\ArrayNode;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\ScalarNode;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $digital_dj_poolRoot = $treeBuilder->root('deejay_pool');

        return $treeBuilder;
    }

}
