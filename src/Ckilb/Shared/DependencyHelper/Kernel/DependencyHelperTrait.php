<?php

namespace Ckilb\Shared\DependencyHelper\Kernel;

use Ckilb\Service\DependencyHelper\DependencyHelperServiceInterface;
use ReflectionClass;
use Spryker\Yves\Kernel\Container;

trait DependencyHelperTrait
{
    /**
     * @param Container $container
     *
     * @return void
     */
    private function provideDependenciesByClassConstants(Container $container): void
    {
        $constants = $this->getClassConstants();

        $this->getDependencyHelperService($container)->provideDependenciesByConstants($constants, $container);
    }

    /**
     * @return string[]
     */
    private function getClassConstants(): array
    {
        return (new ReflectionClass($this))->getConstants();
    }

    /**
     * @param Container $container
     *
     * @return DependencyHelperServiceInterface
     */
    private function getDependencyHelperService(Container $container): DependencyHelperServiceInterface
    {
        return $container->getLocator()->dependencyHelper()->service();
    }
}
