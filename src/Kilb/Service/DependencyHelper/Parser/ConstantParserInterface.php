<?php

namespace Kilb\Service\DependencyHelper\Parser;

use Generated\Shared\Transfer\KilbDependencyHelperConstantsTransfer;

interface ConstantParserInterface
{
    /**
     * @param string[] $classConstants
     *
     * @return KilbDependencyHelperConstantsTransfer
     */
    public function parseConstants(array $classConstants): KilbDependencyHelperConstantsTransfer;
}
