<?php

class PostFormatGallery extends PostFormat {

    public static $format = 'gallery';
    
    // register the metabox
    public static function register_meta_box()
    {
        foreach ( self::$screens as $screen ) {
            add_meta_box(
                'post_formats_gallery',
                __( 'Gallery', 'benjamin' ),   // WPCS: xss ok.
                array( 'PostFormatGallery', 'meta_box_html' ),
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

    ?>
        <input class="post_format_value" type="hidden" name="post_format_gallery" value="<?php echo esc_attr( $value ); ?>" />
        <p>
            <?php echo __( 'Select Images to add to your gallery here.', 'benjamin' );  // WPCS: xss ok. ?>
            <input type="button" value="<?php echo __( 'Manage Gallery', 'benjamin' );  // WPCS: xss ok. ?>" id="post_format_gallery_add" />
            <a class="gallery_remove" href="#" ><?php echo __( 'Remove Gallery', 'benjamin' );  // WPCS: xss ok. ?></a>

        </p>
        <div class="pfp-shortcode-holder" id="post_format_gallery_list">
            <?php echo do_shortcode( '[gallery link="none" ids="' . $value . '"]' );?>
        </div>
        <?php
    }


}
