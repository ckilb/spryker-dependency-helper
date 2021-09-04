<?php

namespace Ckilb\Service\DependencyHelper\Builder;

use Generated\Shared\Transfer\CkilbDependencyHelperConstantTransfer;

class LocatorMethodBuilder implements LocatorMethodBuilderInterface
{
    private const CONST_SEPARATOR = '_';

    /**
     * @inheritDoc
     */
    public function buildLocatorMethod(CkilbDependencyHelperConstantTransfer $constant): string
    {
        $name = $this->removePrefix($constant->getName());
        $name = $this->convertSnakeCaseToCamelCase($name);

        return lcfirst($name);
    }

    /**
     * @param string $constantName
     *
     * @return string
     */
    private function removePrefix(string $constantName): string
    {
        $chunks = $this->splitBySeparator($constantName);

        array_shift($chunks);

        return implode(self::CONST_SEPARATOR, $chunks);
    }

    /**
     * @param string $string
     *
     * @return string
     */
    private function convertSnakeCaseToCamelCase(string $string): string
    {
        $chunks = array_map(function (string $chunk) {
            return ucfirst(strtolower($chunk));
        }, $this->splitBySeparator($string));

        return implode('', $chunks);
    }

    /**
     * @param string $string
     *
     * @return array
     */
    private function splitBySeparator(string $string): array
    {
        return explode(self::CONST_SEPARATOR, $string);
    }
}
