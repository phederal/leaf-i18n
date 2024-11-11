<?php

declare(strict_types=1);


namespace LeafLang\Reader;


use LeafLang\Constants\ConfigConstants;
use LeafLang\Exceptions\LocaleStrategyNotFoundException;
use LeafLang\Plugins\Locale\AcceptLanguageHeaderLocaleStrategyPlugin;
use LeafLang\Plugins\Locale\LocaleStrategyPluginInterface;
use LeafLang\Plugins\Locale\SessionLocaleStrategyPlugin;

class ConfigReader
{
    private static array $settings = [ 
        ConfigConstants::KEY_OMNIGLOT                   => null,
        ConfigConstants::KEY_DEFAULT_LOCALE             => 'en_US',
        ConfigConstants::KEY_TRANSLATION_FILES_LOCATION => './locales',
        ConfigConstants::KEY_LOCALE_STRATEGY            => 'session',
        ConfigConstants::KEY_CUSTOM_LOCALE_STRATEGY     => null,
    ];

    /**
     * @param array $config
     *
     * @return void
     */
    public static function init( array $config ) : void
    {
        static::config( $config );
    }

    /**
     * Set lang config
     *
     * @param string|array $config The lang config key or array of config
     * @param mixed $value The value if $config is a string
     */
    public static function config( $config, $value = null )
    {
        if ( is_array( $config ) ) {
            foreach ( $config as $key => $configValue ) {
                static::config( $key, $configValue );
            }
        } else {
            if ( $value === null ) {
                return static::$settings[ $config ] ?? null;
            }

            static::$settings[ $config ] = $value;
        }

        return '';
    }

    /**
     * @return \LeafLang\Plugins\Locale\LocaleStrategyPluginInterface
     *
     * @throws \LeafLang\Exceptions\LocaleStrategyNotFoundException
     */
    public static function getLocaleStrategy() : LocaleStrategyPluginInterface
    {
        $configuredStrategy      = static::$settings[ ConfigConstants::KEY_LOCALE_STRATEGY ] ?? 'session';
        $customStrategyClassName = static::$settings[ ConfigConstants::KEY_CUSTOM_LOCALE_STRATEGY ];

        if ( $configuredStrategy === 'custom' && is_string( $customStrategyClassName ) ) {
            return new $customStrategyClassName;
        }

        $strategies = static::getLocaleStrategyPlugins();

        if ( !isset( $strategies[ $configuredStrategy ] ) ) {
            throw new LocaleStrategyNotFoundException( $configuredStrategy );
        }

        return $strategies[ $configuredStrategy ];
    }

    /**
     * @return array
     */
    private static function getLocaleStrategyPlugins() : array
    {
        return [ 
            'session'                => new SessionLocaleStrategyPlugin(),
            'accept-language-header' => new AcceptLanguageHeaderLocaleStrategyPlugin(),
        ];
    }
}
