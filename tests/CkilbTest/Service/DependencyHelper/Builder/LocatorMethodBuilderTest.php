<?php

namespace Ckilb\Service\DependencyHelper\Builder;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CkilbDependencyHelperConstantTransfer;

class LocatorMethodBuilderTest extends Unit
{
    /**
     * @var LocatorMethodBuilder
     */
    private $subject;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->subject = new LocatorMethodBuilder();
    }

    /**
     * @return void
     */
    public function testBuildLocatorMethod(): void
    {
        $constant = (new CkilbDependencyHelperConstantTransfer())
            ->setName('PREFIX_CONSTANT_NAME')
            ->setValue('CONSTANT_VALUE');

        $locatorMethod = $this->subject->buildLocatorMethod($constant);

        $this->assertSame('constantName', $locatorMethod);
    }
}
