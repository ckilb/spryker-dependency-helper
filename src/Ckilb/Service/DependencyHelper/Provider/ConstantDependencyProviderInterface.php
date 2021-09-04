<?php

namespace Ckilb\Service\DependencyHelper\Provider;

use Generated\Shared\Transfer\CkilbDependencyHelperConstantsTransfer;
use Spryker\Service\Container\Container;

interface ConstantDependencyProviderInterface
{
    /**
     * @param CkilbDependencyHelperConstantsTransfer $constants
     * @param Container $container
     *
     * @return void
     */
    public function provideDependencies(
        CkilbDependencyHelperConstantsTransfer $constants,
        Container $container
    ): void;
}
