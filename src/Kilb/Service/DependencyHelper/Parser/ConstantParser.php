<?php

namespace Kilb\Service\DependencyHelper\Parser;

use Generated\Shared\Transfer\KilbDependencyHelperConstantsTransfer;

class ConstantParser implements ConstantParserInterface
{
    /**
     * @inheritDoc
     */
    public function parseConstants(array $classConstants): KilbDependencyHelperConstantsTransfer
    {
        dump('yolo'); die;
    }
}
