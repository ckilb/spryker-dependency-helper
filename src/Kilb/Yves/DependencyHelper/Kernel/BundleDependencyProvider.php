<?php

namespace Kilb\Yves\DependencyHelper\Kernel;

use ReflectionClass;
use Spryker\Yves\Kernel\AbstractBundleDependencyProvider as SprykerAbstractBundleDependencyProvider;
use Spryker\Yves\Kernel\Container;

abstract class BundleDependencyProvider extends SprykerAbstractBundleDependencyProvider
{
    private const PREFIX_CONSTANT_CLIENT = 'CLIENT_';
    private const PREFIX_CONSTANT_SERVICE = 'SERVICE_';


    /**
     * @param Container $container
     *
     * @return Container
     */
    public function provideDependencies(Container $container): Container
    {
        $container = parent::provideDependencies($container);
        dump($container->getLocator()->dependencyHelper()->service()); die;

        $constants = $this->getClassConstants();
        $clientConstants = $this->getClientConstants($constants);
        $serviceConstants = $this->getServiceConstants($constants);

        $this->addClients($container, $clientConstants);
        $this->addServices($container, $serviceConstants);

        return $container;
    }

    /**
     * @return string[]
     */
    private function getClassConstants(): array
    {
        return (new ReflectionClass($this))->getConstants();
    }

    /**
     * @param string[] $constants
     *
     * @return string[]
     */
    private function getClientConstants(array $constants): array
    {
        $clientConstants = [];
        $prefixLength = strlen(self::PREFIX_CONSTANT_CLIENT);

        foreach ($constants as $name => $value) {
            if (substr($name, 0, $prefixLength) === self::PREFIX_CONSTANT_CLIENT) {
                $clientConstants[$name] = $value;
            }
        }

        return $clientConstants;
    }

    /**
     * @param string[] $constants
     *
     * @return string[]
     */
    private function getServiceConstants(array $constants): array
    {
        $serviceConstants = [];
        $prefixLength = strlen(self::PREFIX_CONSTANT_SERVICE);

        foreach ($constants as $name => $value) {
            if (substr($name, 0, $prefixLength) === self::PREFIX_CONSTANT_SERVICE) {
                $serviceConstants[$name] = $value;
            }
        }

        return $serviceConstants;
    }

    /**
     * @param Container $container
     * @param string[] $clientConstants
     *
     * @return void
     */
    private function addClients(Container $container, array $clientConstants): void
    {
        foreach ($clientConstants as $name => $value) {
            $container[$value] = function (Container $container) use ($name) {
                $method = $this->getLocatorMethodByConstantName($name);

                return $container->getLocator()->$method()->client();
            };
        }
    }

    /**
     * @param Container $container
     * @param string[] $serviceConstants
     *
     * @return void
     */
    private function addServices(Container $container, array $serviceConstants): void
    {
        foreach ($serviceConstants as $name => $value) {
            $container[$value] = function (Container $container) use ($name) {
                $method = $this->getLocatorMethodByConstantName($name);

                return $container->getLocator()->$method()->service();
            };
        }
    }

    /**
     * @param string $constantName
     *
     * @return string
     */
    private function getLocatorMethodByConstantName(string $constantName): string
    {
        $chunks = explode('_', $constantName);

        array_shift($chunks);

        $method = implode('_', $chunks);

        return strtolower($method);
    }
}
