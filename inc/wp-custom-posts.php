<?php

if ( !function_exists( 'Grownex_options' ) ) {
    function Grownex_options( $option = '', $default = null ) {
        $defaults = Grownex_default_theme_options();
        $options = get_option( 'Grownex_Theme_Option' );
        $default = ( !isset( $default ) && isset( $defaults[$option] ) ) ? $defaults[$option] : $default;
        return ( isset( $options[$option] ) ) ? $options[$option] : $default;
    }
}
add_action( 'init', 'grownexcore_custom_post_type' );
function grownexcore_custom_post_type() {

}