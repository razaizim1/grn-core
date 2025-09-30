<?php if (!defined('ABSPATH')) {
    die;
} // Cannot access directly.

// Blog Post

CSF::createWidget('grownexcore_blog_post_widget', array(
    'title'       => esc_html__('Grownex Post With Thumbnail', 'grownexcore'),
    'classname'   => 'footer-widget-post-with-thum eco-custom-widget',
    'description' => esc_html__('Add your Contact Info', 'grownexcore'),
    'fields'      => array(
        array(
            'id'    => 'title',
            'type'  => 'text',
            'title' => esc_html__('Title', 'grownexcore'),
        ),
        array(
            'id'      => 'grownexcore_widget_blog_position',
            'type'    => 'select',
            'title'   => esc_html__('Select Options', 'grownexcore'),
            'options' => array(
                'ASC'  => esc_html__('ASC', 'grownexcore'),
                'DESC' => esc_html__('DESC', 'grownexcore'),
            ),
            'default' => 'ASC',
        ),
        array(
            'id'      => 'grownexcore_widget_blog_number',
            'type'    => 'number',
            'title'   => esc_html__('Show Post', 'grownexcore'),
            'default' => 2,
        ),
        array(
            'id'      => 'grownexcore_widget_blog_show_meta',
            'type'    => 'switcher',
            'title'   => esc_html__('Enable Meta', 'grownexcore'),
            'default' => true,
        ),
        array(
            'id'      => 'grownexcore_widget_blog_show_image',
            'type'    => 'switcher',
            'title'   => esc_html__('Enable Image', 'grownexcore'),
            'default' => true,
        ),
        array(
            'id'      => 'grownexcore_widget_blog_text_limit',
            'type'    => 'number',
            'title'   => esc_html__('Title Text Limit', 'grownexcore'),
            'default' => 5,
        ),
    ),
));

// OutPut

if (!function_exists('grownexcore_blog_post_widget')) {
    function grownexcore_blog_post_widget($args, $instance)
    {
        echo wp_kses_post($args['before_widget']);
        if (!empty($instance['title'])) {
            echo wp_kses_post($args['before_title']) . apply_filters('widget_title widtet-title', $instance['title']) . wp_kses_post($args['after_title']);
        }
?>
        <ul class="grownexcore-widget-post-thum">
            <?php
            $post_q = new WP_Query(array(
                'post_type'      => 'post',
                'posts_per_page' => $instance['grownexcore_widget_blog_number'],
                'order'          => $instance['grownexcore_widget_blog_position'],
            ));
            if ($post_q->have_posts()) :
                while ($post_q->have_posts()) :
                    $post_q->the_post(); ?>
                    <li>
                        <?php if (!empty($instance['grownexcore_widget_blog_show_image'] == true)) {
                            the_post_thumbnail('thumbnail');
                        } ?>
                        <div class="grownexcore-widget-post-thum-content">
                            <div class="recent-widget-date">
                                <i class="fal fa-clock"></i><?php echo get_the_date() ?>
                            </div>

                            <?php
                            $title = get_the_title();
                            $title_trimmed = wp_trim_words($title, 10, '');

                            echo '<h3 class="post-title"><a href="' . esc_url(get_the_permalink()) . '" rel="bookmark">' . $title_trimmed . '</a></h3>';
                            ?>

                            <?php if (!empty($instance['grownexcore_widget_blog_show_meta'] == true)) : ?>
                            <?php endif; ?>
                        </div>
                    </li>
            <?php endwhile;
            endif; ?>
        </ul>
<?php
        echo wp_kses_post($args['after_widget']);
    }
}
