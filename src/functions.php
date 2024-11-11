<?php

if ( !function_exists( 'tl' ) ) {

    /**
     * @param string $key
     * @param array $params
     *
     * @return string
     */
    function tl( string $key, array $params = [] ) : string
    {
        return lang()->translate( $key, $params );
    }
}

if ( !function_exists( 'lang' ) ) {

    /**
     * @return \LeafLang\Lang
     */
    function lang() : \LeafLang\Lang
    {
        $instance = \LeafLang\Reader\ConfigReader::config(
            \LeafLang\Constants\ConfigConstants::KEY_OMNIGLOT,
        );

        if ( !$instance ) {
            $instance = new \LeafLang\Lang();
            \LeafLang\Reader\ConfigReader::config(
                \LeafLang\Constants\ConfigConstants::KEY_OMNIGLOT, $instance,
            );
        }

        return $instance;
    }
}
