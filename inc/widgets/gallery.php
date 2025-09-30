<?php if (!defined('ABSPATH')) {
    die;
} // Cannot access directly.

CSF::createWidget('grownex_gallery_widget', array(
    'title'       => esc_html__('Grownex Gallery Widget', 'grownexcore'),
    'classname'   => 'widget_gallery',
    'description' => esc_html__('Add Your Gallery Image', 'grownexcore'),
    'fields'      => array(
        array(
            'id'      => 'title',
            'type'    => 'text',
            'title'   => esc_html__('Title', 'grownexcore'),
        ),
        array(
            'id'           => 'grownexcore_gallery_image',
            'type'  => 'gallery',
            'title'        => esc_html__('Author Image', 'grownexcore'),
            'library'      => 'image',
            'placeholder'  => 'http://',
            'button_title' => esc_html__('Add Image', 'grownexcore'),
            'remove_title' => esc_html__('Remove Image', 'grownexcore'),
        ),
    ),
));

// OutPut
if (!function_exists('grownex_gallery_widget')) {
    function grownex_gallery_widget($args, $instance)
    {
        echo wp_kses_post($args['before_widget']);
        if (!empty($instance['title'])) {
            echo wp_kses_post($args['before_title']) . apply_filters('widget_title widtet-title', $instance['title']) . wp_kses_post($args['after_title']);
        }
?>

        <div class="gallery-widget-wrapper">
            <?php
            $gallery_opt = $instance['grownexcore_gallery_image'];
            $gallery_ids = explode(',', $gallery_opt);
            if (!empty($gallery_ids)) {
                foreach ($gallery_ids as $gallery_item_id) { ?>
                    <a href="<?php echo wp_get_attachment_url($gallery_item_id); ?>"> <?php echo wp_get_attachment_image($gallery_item_id, 'full'); ?></a>
            <?php  }
            } ?>
        </div>

<?php
        echo wp_kses_post($args['after_widget']);
    }
}
