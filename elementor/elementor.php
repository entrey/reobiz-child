<?php

use Elementor\Plugin as Elementor;

/**
 * Elementor Plugin Modifications
 *
 *
 * @package reobiz-child\elementor
 * @author Peniaz Roman
 * @link https://github.com/entrey
 *
 * @since 4.3.0
 */
class Entrey_Elementor
{
    public function __construct()
    {
        if ( ! did_action( 'elementor/loaded' ) ) {
            // Bailout.
            return;
        }

        add_action( 'elementor/widgets/widgets_registered', [ $this, 'inject_extra_widgets' ] );
        add_action( 'elementor/widgets/widgets_registered', [ $this, 'enqueue_widgets_dependencies' ] );
    }

    public function inject_extra_widgets()
    {
        $widgets_folder_path = __DIR__ . '\widgets\\';

        foreach ( glob( $widgets_folder_path . '*.php' ) as $file ) {
            require_once $file;

            $file_name = basename( $file );
            $this->instantiate_widget_class( $file_name );
        }
    }

    protected function instantiate_widget_class( $file_name )
    {
        $base_name = str_replace( '.php', '', $file_name );
        $class_name = str_replace( '-', '_', $base_name );
        $class_name = ucwords( $class_name );
        $class_name = 'Entrey_' . $class_name;

        if ( class_exists( $class_name ) ) {
            $widget_manager = Elementor::instance()->widgets_manager;
            $widget_manager->register_widget_type( new $class_name() );
        }
    }

    public function enqueue_widgets_dependencies()
    {
        wp_enqueue_style( 'entrey-tabs', get_stylesheet_directory_uri() . '/elementor/css/tabs.css' );
        wp_enqueue_script( 'entrey-tabs', get_stylesheet_directory_uri() . '/elementor/js/tabs.js' );
    }
}

new Entrey_Elementor();
