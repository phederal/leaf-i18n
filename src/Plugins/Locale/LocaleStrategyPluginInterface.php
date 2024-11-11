<?php

declare(strict_types=1);


namespace LeafLang\Plugins\Locale;


use Leaf\Http\Session;

interface LocaleStrategyPluginInterface
{
    /**
     * @param string $locale
     *
     * @return void
     */
    public function setCurrentLocale( string $locale ) : void;

    /**
     * @return string|null
     */
    public function getCurrentLocale() : ?string;
}
