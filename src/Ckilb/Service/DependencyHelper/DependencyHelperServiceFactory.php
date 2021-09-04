<?php

namespace Ckilb\Service\DependencyHelper;

use Ckilb\Service\DependencyHelper\Builder\LocatorMethodBuilder;
use Ckilb\Service\DependencyHelper\Builder\LocatorMethodBuilderInterface;
use Ckilb\Service\DependencyHelper\Parser\ConstantParser;
use Ckilb\Service\DependencyHelper\Parser\ConstantParserInterface;
use Ckilb\Service\DependencyHelper\Provider\ConstantDependencyProvider;
use Ckilb\Service\DependencyHelper\Provider\ConstantDependencyProviderInterface;
use Spryker\Service\Kernel\AbstractServiceFactory;

class DependencyHelperServiceFactory extends AbstractServiceFactory
{
    /**
     * @return ConstantParserInterface
     */
    public function createConstantParser(): ConstantParserInterface
    {
        return new ConstantParser();
    }

    /**
     * @return ConstantDependencyProviderInterface
     */
    public function createConstantDependencyProvider(): ConstantDependencyProviderInterface
    {
        return new ConstantDependencyProvider(
            $this->createLocatorMethodBuilder()
        );
    }

    /**
     * @return LocatorMethodBuilderInterface
     */
    private function createLocatorMethodBuilder(): LocatorMethodBuilderInterface
    {
        return new LocatorMethodBuilder();
    }
}
