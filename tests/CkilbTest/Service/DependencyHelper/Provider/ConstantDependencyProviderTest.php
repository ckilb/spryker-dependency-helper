<?php

namespace Ckilb\Service\DependencyHelper\Builder;

use Ckilb\Service\DependencyHelper\Provider\ConstantDependencyProvider;
use CkilbTest\Service\DependencyHelper\TestContainer;
use Codeception\Test\Unit;
use Generated\Shared\Transfer\CkilbDependencyHelperConstantsTransfer;
use Generated\Shared\Transfer\CkilbDependencyHelperConstantTransfer;
use Spryker\Service\Container\Container;

class ConstantDependencyProviderTest extends Unit
{
    /**
     * @var ConstantDependencyProvider
     */
    private $subject;

    /**
     * @var LocatorMethodBuilderInterface
     */
    private $locatorMethodBuilder;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->locatorMethodBuilder = $this->createMock(LocatorMethodBuilderInterface::class);
        $this->subject = new ConstantDependencyProvider($this->locatorMethodBuilder);
    }

    /**
     * @return void
     */
    public function testProvideDependencies(): void
    {
        $clientConstant = (new CkilbDependencyHelperConstantTransfer())
            ->setName('CLIENT_client')
            ->setValue('clientBundle');

        $facadeConstant = (new CkilbDependencyHelperConstantTransfer())
            ->setName('FACADE_facade')
            ->setValue('facadeBundle');

        $serviceConstant = (new CkilbDependencyHelperConstantTransfer())
            ->setName('SERVICE_service')
            ->setValue('serviceBundle');

        $constants = (new CkilbDependencyHelperConstantsTransfer())
            ->addClientConstant($clientConstant)
            ->addFacadeConstant($facadeConstant)
            ->addServiceConstant($serviceConstant);

        $container = new TestContainer();

        $this->locatorMethodBuilder
            ->expects($this->exactly(3))
            ->method('buildLocatorMethod')
            ->will($this->returnValueMap([
                [$clientConstant, $clientConstant->getValue()],
                [$facadeConstant, $facadeConstant->getValue()],
                [$serviceConstant, $serviceConstant->getValue()],
            ]));

        $this->subject->provideDependencies($constants, $container);

        $this->assertCount(3, $container->getValues());

        $this->assertArrayHasKey($clientConstant->getValue(), $container->getValues());
        $this->assertArrayHasKey($facadeConstant->getValue(), $container->getValues());
        $this->assertArrayHasKey($serviceConstant->getValue(), $container->getValues());

        $this->assertInternalType('callable', $container->getValues()[$clientConstant->getValue()]);
        $this->assertInternalType('callable', $container->getValues()[$facadeConstant->getValue()]);
        $this->assertInternalType('callable', $container->getValues()[$serviceConstant->getValue()]);

        $container->getValues()[$clientConstant->getValue()]($container);
        $container->getValues()[$facadeConstant->getValue()]($container);
        $container->getValues()[$serviceConstant->getValue()]($container);

        $this->assertEquals(
            [$clientConstant->getValue(), $facadeConstant->getValue(), $serviceConstant->getValue()],
            $container->getLocator()->getBundlesCalled()
        );

        $this->assertEquals(
            ['client', 'facade', 'service'],
            $container->getLocator()->getBundleProxy()->getMethodsCalled()
        );
    }
}
