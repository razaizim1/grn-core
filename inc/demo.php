<?php

// Function to define demo import files
function grownexcore_import_files() {
    return array(
        array(
            'import_file_name'           => esc_html__( 'Default All Demo', 'grownexcore' ),
            'import_file_url'            => plugin_dir_url( __FILE__ ) . 'demo/default/demo.xml',
            'import_widget_file_url'     => plugin_dir_url( __FILE__ ) . 'demo/default/widgets.wie',
            'import_customizer_file_url' => plugin_dir_url( __FILE__ ) . 'demo/default/customizer.dat',
            'local_import_json'          => array(
                array(
                    'file_path'   => plugin_dir_url( __FILE__ ) . 'demo/default/theme-options.json',
                    'option_name' => 'Grownex_Theme_Option',
                ),
            ),
            'import_notice'              => esc_html__( 'This is Grownex Default Demo', 'grownexcore' ),
            'preview_url'                => 'https://grownex.themepul.com/',
        ),
       
    );
}

// Hook to add the import files filter
add_filter( 'ocdi/import_files', 'grownexcore_import_files' );

// Function to set up the theme after import
function grownexcore_after_import_setup() {
    // Assign menus to their locations
    grownexcore_assign_menus();

    // Assign front page and posts page
    grownexcore_assign_front_and_posts_pages();
}

// Hook to add the after import action
add_action( 'ocdi/after_import', 'grownexcore_after_import_setup' );

// Function to assign menus to their locations
function grownexcore_assign_menus() {
    $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );

    set_theme_mod( 'nav_menu_locations', array(
        'mainmenu' => $main_menu->term_id,
    ) );
}

// Function to assign front page and posts page
function grownexcore_assign_front_and_posts_pages() {
    $front_page_slug = 'home';
    $blog_page_slug  = 'blog';

    $front_page_id = get_page_by_path( $front_page_slug );
    $blog_page_id  = get_page_by_path( $blog_page_slug );

    if ( $front_page_id && $blog_page_id ) {
        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', $front_page_id->ID );
        update_option( 'page_for_posts', $blog_page_id->ID );
    }
}