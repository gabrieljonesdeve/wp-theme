<?php

class PostFormatLink extends PostFormat {

    public static $format = 'link';

    // register the metabox
    public static function register_meta_box()
    {
        foreach(self::$screens as $screen){
            add_meta_box(
                'post_formats_link',
                __('Link', 'benjamin'),
                array('PostFormatLink', 'meta_box_html'),
                $screen,
                'top',
                'default'
            );
        }
    }


    // the markup
    public static function meta_box_html( $post )
    {
        wp_nonce_field( 'post_format_nonce_' . self::$format, 'post_format_nonce_' . self::$format );

        $value = self::meta_box_saved_value( $post->ID, self::$format, null );

        $text = isset( $value['text'] ) ? $value['text'] : '';
        $url = isset( $value['url'] ) ? $value['url'] : '';
    ?>
        <p>
            <label>
                <?php echo __( 'URL', 'benjamin' ); // WPCS: xss ok. ?><br />
                <textarea name="post_format_value[<?php echo esc_attr( self::$format ); ?>][url]"><?php echo esc_attr( $url ); ?></textarea>
            </label>
        </p>

        <p>
            <label>
                <?php echo __( 'Text', 'benjamin' ); // WPCS: xss ok. ?><br />
                <input type="text" value="<?php echo esc_attr( $text ); ?>" 
                name="post_format_value[<?php echo esc_attr( self::$format ); ?>][text]"
                 placeholder="<?php echo __( 'click here', 'benjamin' ); ?>"/>
            </label>
        </p>
        <?php
    }


}
