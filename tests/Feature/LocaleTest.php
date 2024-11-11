<?php

it( 'tests that setCurrentLocale sets locale and getCurrentLocale retrieves it', function () {
    lang()->init( [ 
        'TRANSLATION_FILES_LOCATION' => './tests/data/locales'
    ] );

    expect( lang()->getCurrentLocale() )->toBe( 'en_US' );

    lang()->setCurrentLocale( 'pt_PT' );

    expect( lang()->getCurrentLocale() )->toBe( 'pt_PT' );
} );

it( 'tests that getCurrentLocale get locale using custom strategy', function () {
    lang()->init( [ 
        'TRANSLATION_FILES_LOCATION'        => './tests/data/locales',
        'LOCALE_STRATEGY'                   => 'custom',
        'CUSTOM_LOCALE_STRATEGY_CLASS_NAME' => \LeafLang\Plugins\Locale\TestCustomLocaleStrategyPlugin::class
    ] );

    expect( lang()->getCurrentLocale() )->toBe( 'custom' );
    expect( tl( 'welcome.page.title' ) )->toBe( 'Hello Custom' );

    // Here because of caching issues with tests
    \LeafLang\Reader\ConfigReader::config( 'LOCALE_STRATEGY', 'session' );
} );

it( 'tests that setCurrentLocale throws exception if locale on found in files', function () {
    lang()->init( [ 
        'TRANSLATION_FILES_LOCATION' => './tests/data/locales'
    ] );

    expect( lang()->getCurrentLocale() )->toBe( 'en_US' );

    expect( fn () => lang()->setCurrentLocale( 'random_locale' ) )
        ->toThrow( \LeafLang\Exceptions\MissingTranslationFileException::class);
} );

it( 'tests that getAvailableLocales gets all locales that there are files for', function () {
    lang()->init( [ 
        'TRANSLATION_FILES_LOCATION' => './tests/data/locales'
    ] );

    expect( lang()->getAvailableLocales() )->toBe( [ 'custom', 'en_US', 'pt_BR', 'pt_PT' ] );
} );

it( 'tests that getDefaultLocale returns configured default locale', function () {
    lang()->init( [ 
        'DEFAULT_LOCALE'             => 'pt_PT',
        'TRANSLATION_FILES_LOCATION' => './tests/data/locales'
    ] );

    expect( lang()->getDefaultLocale() )->toBe( 'pt_PT' );

    // Here because of caching issues with tests
    \LeafLang\Reader\ConfigReader::config( 'DEFAULT_LOCALE', 'en_US' );
} );

afterEach( function () {
    if ( session_status() === PHP_SESSION_ACTIVE ) {
        session_destroy();
    }
} );
