<?php

namespace Ckilb\Service\DependencyHelper\Parser;

use Generated\Shared\Transfer\CkilbDependencyHelperConstantsTransfer;

interface ConstantParserInterface
{
    /**
     * @param string[] $constants
     *
     * @return CkilbDependencyHelperConstantsTransfer
     */
    public function parseConstants(array $constants): CkilbDependencyHelperConstantsTransfer;
}
