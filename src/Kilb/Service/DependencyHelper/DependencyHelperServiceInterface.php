<?php

namespace Kilb\Service\DependencyHelper;

use Generated\Shared\Transfer\KilbDependencyHelperConstantsTransfer;

interface DependencyHelperServiceInterface
{
    /**
     * @param string[] $classConstants
     *
     * @return KilbDependencyHelperConstantsTransfer
     */
    public function parseConstants(array $classConstants): KilbDependencyHelperConstantsTransfer;
}
