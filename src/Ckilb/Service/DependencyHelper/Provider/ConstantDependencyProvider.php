<?php

namespace Ckilb\Service\DependencyHelper\Provider;

use Ckilb\Service\DependencyHelper\Builder\LocatorMethodBuilderInterface;
use Generated\Shared\Transfer\CkilbDependencyHelperConstantsTransfer;
use Generated\Shared\Transfer\CkilbDependencyHelperConstantTransfer;
use Spryker\Service\Container\Container;

class ConstantDependencyProvider implements ConstantDependencyProviderInterface
{
    private const PROXY_METHOD_CLIENT = 'client';
    private const PROXY_METHOD_FACADE = 'facade';
    private const PROXY_METHOD_SERVICE = 'service';

    /**
     * @var LocatorMethodBuilderInterface
     */
    private $locatorMethodBuilder;

    /**
     * @param LocatorMethodBuilderInterface $locatorMethodBuilder
     */
    public function __construct(LocatorMethodBuilderInterface $locatorMethodBuilder)
    {
        $this->locatorMethodBuilder = $locatorMethodBuilder;
    }

    /**
     * @inheritDoc
     */
    public function provideDependencies(
        CkilbDependencyHelperConstantsTransfer $constants,
        Container $container
    ): void {
        $this->addDependencies($constants->getClientConstants(), $container, self::PROXY_METHOD_CLIENT);
        $this->addDependencies($constants->getFacadeConstants(), $container, self::PROXY_METHOD_FACADE);
        $this->addDependencies($constants->getServiceConstants(), $container, self::PROXY_METHOD_SERVICE);
    }

    /**
     * @param CkilbDependencyHelperConstantTransfer[] $serviceConstants
     * @param Container $container
     * @param string $proxyMethod
     *
     * @return void
     */
    private function addDependencies(iterable $serviceConstants, Container $container, string $proxyMethod): void
    {
        foreach ($serviceConstants as $serviceConstant) {
            $this->addDependency($serviceConstant, $container, $proxyMethod);
        }
    }

    /**
     * @param CkilbDependencyHelperConstantTransfer $constant
     * @param Container $container
     * @param string $proxyMethod
     *
     * @return void
     */
    private function addDependency(
        CkilbDependencyHelperConstantTransfer $constant,
        Container $container,
        string $proxyMethod
    ): void {
        $value = $constant->getValue();

        $container->set(
            $value,
            function (Container $container) use ($constant, $proxyMethod) {
                $method = $this->locatorMethodBuilder->buildLocatorMethod($constant);

                return $container->getLocator()->$method()->$proxyMethod();
            }
        );
    }
}
