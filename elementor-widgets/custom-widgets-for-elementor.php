<?php
if (!defined('ABSPATH')) {
    exit;
}
// No access of directly access

class GrownexElementorWidget
{
    private static $instance = null;
    public static function get_instance()
    {
        if (!self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function init()
    {
        add_action('elementor/widgets/register', array($this, 'grownexcore_elementor_widgets'));
        add_action('elementor/frontend/after_enqueue_scripts', [$this, 'widget_scripts']);
    }

    public function widget_scripts()
    {
        wp_enqueue_script('grownex-backend-script', GROWNEX_CORE_ASSETS . 'js/grownex-elementor-editor.js', array('jquery'), true, true);
    }

    public function grownexcore_elementor_widgets()
    {
        // Check if the Elementor plugin has been installed / activated.
        if (defined('ELEMENTOR_PATH') && class_exists('Elementor\Widget_Base')) {
            require_once 'about-us.php';
            require_once 'nav-menu.php';
            require_once 'button.php';
        }
    }
}
GrownexElementorWidget::get_instance()->init();

function grownexcore_elementor_widget_categories($elements_manager)
{
    $elements_manager->add_category(
        'grownexcore',
        [
            'title' => __('Grownex Elements', 'grownexcore'),
        ]
    );
    $elements_manager->add_category(
        'grownex_ht',
        [
            'title' => __('Grownex Header Template', 'grownexcore'),
        ]
    );
    $elements_manager->add_category(
        'grownex_ft',
        [
            'title' => __('Grownex Footer Addons', 'grownexcore'),
        ]
    );
}
add_action('elementor/elements/categories_registered', 'grownexcore_elementor_widget_categories');
