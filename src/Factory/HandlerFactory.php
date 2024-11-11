<?php

declare(strict_types=1);


namespace LeafLang\Factory;

use LeafLang\Handler\FileHandler;
use LeafLang\Handler\LocaleHandler;
use LeafLang\Handler\RouteHandler;
use LeafLang\Handler\TranslationsHandler;
use LeafLang\Reader\ConfigReader;

class HandlerFactory
{
    /**
     * @return \LeafLang\Handler\TranslationsHandler
     */
    public function createTranslationsHandler() : TranslationsHandler
    {
        return new TranslationsHandler( $this->createLocaleHandler(), $this->createFileHandler() );
    }

    /**
     * @return \LeafLang\Handler\LocaleHandler
     */
    public function createLocaleHandler() : LocaleHandler
    {
        return new LocaleHandler( ConfigReader::getLocaleStrategy(), $this->createFileHandler() );
    }

    /**
     * @return \LeafLang\Handler\RouteHandler
     */
    public function createRouteHandler() : RouteHandler
    {
        return new RouteHandler();
    }

    /**
     * @return \LeafLang\Handler\FileHandler
     */
    public function createFileHandler() : FileHandler
    {
        return new FileHandler();
    }
}
