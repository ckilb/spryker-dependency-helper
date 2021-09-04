<?php

namespace Ckilb\Service\DependencyHelper;

use Spryker\Service\Container\Container;
use Spryker\Service\Kernel\AbstractService;

/**
 * @method \Ckilb\Service\DependencyHelper\DependencyHelperServiceFactory getFactory()
 */
class DependencyHelperService extends AbstractService implements DependencyHelperServiceInterface
{
    /**
     * @inheritDoc
     */
    public function provideDependenciesByConstants(
        array $constants,
        Container $container
    ): void {
        $constants = $this->getFactory()->createConstantParser()->parseConstants($constants);

        $this->getFactory()->createConstantDependencyProvider()->provideDependencies($constants, $container);
    }
}
