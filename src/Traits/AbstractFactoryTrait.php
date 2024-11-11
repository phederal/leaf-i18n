<?php

namespace LeafLang\Traits;

use LeafLang\Factory\HandlerFactory;

trait AbstractFactoryTrait
{
    /**
     * @return \LeafLang\Factory\HandlerFactory
     */
    protected function getHandlerFactory() : HandlerFactory
    {
        return new HandlerFactory();
    }
}
