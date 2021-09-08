<?php

namespace Ckilb\Service\DependencyHelper\Builder;

use Ckilb\Service\DependencyHelper\Parser\ConstantParser;
use Codeception\Test\Unit;

class ConstantParserTest extends Unit
{
    /**
     * @var ConstantParser
     */
    private $subject;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->subject = new ConstantParser();
    }

    /**
     * @return void
     */
    public function testParseConstants(): void
    {
        $facadeName = 'FACADE_FOO';
        $facadeValue = 'facade foo';

        $clientName = 'CLIENT_BAR';
        $clientValue = 'client bar';

        $serviceName = 'SERVICE_HELLO';
        $serviceValue = 'service hello';

        $constants = $this->subject->parseConstants([
            $facadeName => $facadeValue,
            $clientName => $clientValue,
            $serviceName => $serviceValue,
            'UNPARSED_world' => 'unparsed world',
        ]);

        $this->assertCount(1, $constants->getFacadeConstants());
        $this->assertCount(1, $constants->getClientConstants());
        $this->assertCount(1, $constants->getServiceConstants());

        $this->assertSame($facadeName, $constants->getFacadeConstants()[0]->getName());
        $this->assertSame($facadeValue, $constants->getFacadeConstants()[0]->getValue());

        $this->assertSame($clientName, $constants->getClientConstants()[0]->getName());
        $this->assertSame($clientValue, $constants->getClientConstants()[0]->getValue());

        $this->assertSame($serviceName, $constants->getServiceConstants()[0]->getName());
        $this->assertSame($serviceValue, $constants->getServiceConstants()[0]->getValue());
    }
}
