<?php

namespace Ckilb\Service\DependencyHelper\Parser;

use ArrayObject;
use Generated\Shared\Transfer\CkilbDependencyHelperConstantsTransfer;
use Generated\Shared\Transfer\CkilbDependencyHelperConstantTransfer;

class ConstantParser implements ConstantParserInterface
{
    private const PREFIX_CONSTANT_CLIENT = 'CLIENT_';
    private const PREFIX_CONSTANT_FACADE = 'FACADE_';
    private const PREFIX_CONSTANT_SERVICE = 'SERVICE_';

    /**
     * @inheritDoc
     */
    public function parseConstants(array $constants): CkilbDependencyHelperConstantsTransfer
    {
        $clientConstants = $this->parseConstantsByPrefix($constants, self::PREFIX_CONSTANT_CLIENT);
        $serviceConstants = $this->parseConstantsByPrefix($constants, self::PREFIX_CONSTANT_SERVICE);
        $facadeConstants = $this->parseConstantsByPrefix($constants, self::PREFIX_CONSTANT_FACADE);

        return (new CkilbDependencyHelperConstantsTransfer())
            ->setClientConstants(new ArrayObject($clientConstants))
            ->setServiceConstants(new ArrayObject($serviceConstants))
            ->setFacadeConstants(new ArrayObject($facadeConstants));
    }

    /**
     * @param string[] $constants
     *
     * @return string[]
     */
    private function parseConstantsByPrefix(array $constants, string $prefix): array
    {
        $constants = $this->getConstantsByPrefix($prefix, $constants);

        return $this->createConstantTransfers($constants);
    }

    /**
     * @param string $prefix
     * @param string[] $constants
     *
     * @return string[]
     */
    private function getConstantsByPrefix(string $prefix, array $constants): array
    {
        $constantsByPrefix = [];

        foreach ($constants as $name => $value) {
            if ($this->hasPrefix($name, $prefix)) {
                $constantsByPrefix[$name] = $value;
            }
        }

        return $constantsByPrefix;
    }

    /**
     * @param string $constantName
     * @param string $prefix
     *
     * @return bool
     */
    private function hasPrefix(string $constantName, string $prefix): bool
    {
        if (substr($constantName, 0, strlen($prefix)) === $prefix) {
            return true;
        }

        return false;
    }

    /**
     * @param string[] $constants
     *
     * @return CkilbDependencyHelperConstantTransfer[]
     */
    private function createConstantTransfers(array $constants): array
    {
        $transfers = [];

        foreach ($constants as $name => $value) {
            $transfers[] = $this->createConstantTransfer($name, $value);
        }

        return $transfers;
    }

    /**
     * @param string $constantName
     * @param string $constantValue
     *
     * @return CkilbDependencyHelperConstantTransfer
     */
    private function createConstantTransfer(string $constantName, string $constantValue): CkilbDependencyHelperConstantTransfer
    {
        return (new CkilbDependencyHelperConstantTransfer())
            ->setName($constantName)
            ->setValue($constantValue);
    }
}
