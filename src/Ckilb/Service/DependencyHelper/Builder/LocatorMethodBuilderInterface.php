<?php

namespace Ckilb\Service\DependencyHelper\Builder;

use Generated\Shared\Transfer\CkilbDependencyHelperConstantTransfer;

interface LocatorMethodBuilderInterface
{
    /**
     * @param CkilbDependencyHelperConstantTransfer $constant
     *
     * @return string
     */
    public function buildLocatorMethod(CkilbDependencyHelperConstantTransfer $constant): string;
}
