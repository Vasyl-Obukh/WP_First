<?php
/**
 * Widget API: WP_first_Widget_Subscribe class
 *
 * @package wp_first
 * @subpackage inc
 * @since 1.0.0
 */

/**
 * Core class used to implement a Subscribe widget.
 *
 * @since 1.0.0
 *
 * @see WP_Widget
 */
class WP_first_Widget_Subscribe extends WP_Widget {

    /**
     * Sets up a new Subscribe widget instance.
     *
     * @since 1.0.0
     */
    public function __construct() {
        $widget_ops = array(
            'classname' => 'widget_subscribe news_sletter',
            'description' => __( 'Subscribe form.' ),
            'customize_selective_refresh' => true,
        );
        $control_ops = array(
            'width' => 400,
            'height' => 350,
        );
        parent::__construct( 'subscribe', __( 'Subscribe form' ), $widget_ops, $control_ops );
    }

    /**
     * Outputs the content for the current Text widget instance.
     *
     * @since 1.0.0
     *
     * @param array $args     Display arguments including 'before_title', 'after_title',
     *                        'before_widget', and 'after_widget'.
     * @param array $instance Settings for the current Text widget instance.
     */
    public function widget( $args, $instance ) {

        /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

        $widget_text = ! empty( $instance['text'] ) ? $instance['text'] : '';

        /**
         * Filters the content of the Text widget.
         *
         * @since 2.3.0
         * @since 4.4.0 Added the `$this` parameter.
         *
         * @param string                               $widget_text     The widget content.
         * @param array                                $instance Array of settings for the current widget.
         * @param WP_Widget_Text|WP_Widget_Custom_HTML $this     Current Text widget instance.
         */
        $text = apply_filters( 'widget_text', $widget_text, $instance, $this );

        echo $args['before_widget'];
        if (  !empty( $title ) ) {
            echo $args['before_title'] . $title . $args['after_title'];
        } ?>
            <?php echo !empty( $instance['filter'] ) ? wpautop( $text ) : $text; ?>

            <form>
                <div class="form-group blog_form">
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email Address" >
                </div>

                <div class="search_btn-3">
                    <button class="btn btn-default" type="submit">  Subscribe </button>
                </div>
            </form>

        <?php
        echo $args['after_widget'];
    }

    /**
     * Handles updating settings for the current Text widget instance.
     *
     * @since 2.8.0
     * @access public
     *
     * @param array $new_instance New settings for this instance as input by the user via
     *                            WP_Widget::form().
     * @param array $old_instance Old settings for this instance.
     * @return array Settings to save or bool false to cancel saving.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field( $new_instance['title'] );
        if ( current_user_can( 'unfiltered_html' ) ) {
            $instance['text'] = $new_instance['text'];
        } else {
            $instance['text'] = wp_kses_post( $new_instance['text'] );
        }
        $instance['filter'] = ! empty( $new_instance['filter'] );
        return $instance;
    }

    /**
     * Outputs the Subscribe widget settings form.
     *
     * @since 1.0.0
     * @access public
     *
     * @param array $instance Current settings.
     */
    public function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array('title' => '', 'text' => ''));
        $filter = isset( $instance['filter'] ) ? $instance['filter'] : 0;
        $title = sanitize_text_field( $instance['title'] );
        ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo
            $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title);
            ?>" ></p>

        <p><label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Content:' ); ?>
        </label>
        <textarea class="widefat" name="<?php echo $this->get_field_name('text'); ?>"
             id="<?php echo $this->get_field_id('text'); ?>" cols="20" rows="16"><?php echo esc_textarea(
             $instance['text'] ); ?></textarea></p>

        <p><input id="<?php echo $this->get_field_id('filter'); ?>" name="<?php echo $this->
            get_field_name('filter'); ?>"  type="checkbox"<?php checked( $filter ); ?> />&nbsp;<label
                for="<?php echo $this->get_field_id('filter'); ?>"><?php _e('Automatically add
             paragraphs'); ?></label></p>
        <?php
    }
}