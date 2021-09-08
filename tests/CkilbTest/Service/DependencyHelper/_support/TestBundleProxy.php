<?php
namespace CkilbTest\Service\DependencyHelper;

use Spryker\Shared\Kernel\BundleProxy;

class TestBundleProxy extends BundleProxy
{
    /**
     * @var string[]
     */
    private $methodsCalled = [];

    /**
     * @param string $methodName
     * @param array $arguments
     *
     * @return void
     */
    public function __call(string $methodName, array $arguments): void
    {
        $this->methodsCalled[] = $methodName;
    }

    /**
     * @return string[]
     */
    public function getMethodsCalled(): array
    {
        return $this->methodsCalled;
    }
}
