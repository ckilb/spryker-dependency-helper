<?php

namespace Kilb\Yves\DependencyHelper\Kernel;

trait DependencyHelperTrait
{
    /**
     * @return void
     */
    private function sayHello(): void
    {
        dump('hello'); die;
    }
}
