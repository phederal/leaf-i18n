<?php

declare(strict_types=1);


namespace LeafLang\Plugins\Locale;


use LeafLang\Plugins\Locale\LocaleStrategyPluginInterface;

class TestCustomLocaleStrategyPlugin implements LocaleStrategyPluginInterface
{
    /**
     * @param string $locale
     *
     * @return void
     */
    public function setCurrentLocale( string $locale ) : void
    {
        // Not implemented
    }

    /**
     * @return string|null
     */
    public function getCurrentLocale() : ?string
    {
        return 'custom';
    }
}
