<?php

namespace Ckilb\Service\DependencyHelper;

use Generated\Shared\Transfer\CkilbDependencyHelperConstantsTransfer;
use Spryker\Service\Container\Container;

interface DependencyHelperServiceInterface
{
    /**
     * @param string[] $constants
     * @param Container $container
     *
     * @return void
     */
    public function provideDependenciesByConstants(
        array $constants,
        Container $container
    ): void;
}
