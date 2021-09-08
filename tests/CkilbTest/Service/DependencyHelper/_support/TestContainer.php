<?php
namespace CkilbTest\Service\DependencyHelper;

use Spryker\Shared\Kernel\Container\AbstractApplicationContainer;
use Spryker\Shared\Kernel\LocatorLocatorInterface;

class TestContainer extends AbstractApplicationContainer
{
    /**
     * @var array
     */
    private $values = [];

    /**
     * @var TestLocator
     */
    private $locator;

    public function __construct(array $services = [])
    {
        parent::__construct($services);

        $this->locator = new TestLocator();
    }

    /**
     * @param string $containerKey
     * @param mixed $value
     */
    public function set(string $containerKey, $value): void
    {
        $this->values[$containerKey] = $value;
    }

    /**
     * @return LocatorLocatorInterface
     */
    public function getLocator(): LocatorLocatorInterface
    {
        return $this->locator;
    }

    /**
     * @return array
     */
    public function getValues(): array
    {
        return $this->values;
    }
}
