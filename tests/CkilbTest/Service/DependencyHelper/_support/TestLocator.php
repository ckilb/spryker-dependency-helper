<?php
namespace CkilbTest\Service\DependencyHelper;

use Spryker\Shared\Kernel\BundleProxy;
use Spryker\Shared\Kernel\LocatorLocatorInterface;

class TestLocator implements LocatorLocatorInterface
{
    /**
     * @var string[]
     */
    private $bundlesCalled = [];

    /**
     * @var TestBundleProxy
     */
    private $bundleProxy;

    public function __construct()
    {
        $this->bundleProxy = new TestBundleProxy();
    }

    /**
     * @param string $bundle
     * @param array|null $arguments
     *
     * @return BundleProxy
     */
    public function __call($bundle, ?array $arguments = null): BundleProxy
    {
        $this->bundlesCalled[] = $bundle;

        return $this->bundleProxy;
    }

    /**
     * @return string[]
     */
    public function getBundlesCalled(): array
    {
        return $this->bundlesCalled;
    }

    /**
     * @return TestBundleProxy
     */
    public function getBundleProxy(): TestBundleProxy
    {
        return $this->bundleProxy;
    }
}
