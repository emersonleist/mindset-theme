<?php
/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function mindset_blocks_copyright_date_block_init() {
	register_block_type( __DIR__ . '/build/copyright-date' );
	register_block_type( __DIR__ . '/build/company-address' );
	register_block_type( __DIR__ . '/build/company-email' );
	register_block_type(
		__DIR__ . '/build/service-posts',
		array(
			'render_callback' => 'fwd_render_service_posts'
		)
	);
}
add_action( 'init', 'mindset_blocks_copyright_date_block_init' );
/**
* Registers the custom fields for some blocks.
*
* @see https://developer.wordpress.org/reference/functions/register_post_meta/
*/


function mindset_register_custom_fields() {
	register_post_meta(
		'page',
		'company_email',
		array(
			'type'         => 'string',
			'show_in_rest' => true,
			'single'       => true
		)
	);
	register_post_meta(
		'page',
		'company_address',
		array(
			'type'         => 'string',
			'show_in_rest' => true,
			'single'       => true
		)
	);
}
add_action( 'init', 'mindset_register_custom_fields' );

function fwd_render_service_posts( $attributes ) {
    ob_start();
    ?>
    <div <?php echo get_block_wrapper_attributes(); ?>>
        <?php
        $args = array(
            'post_type'      => 'fwd-service',
            'posts_per_page' => -1,
            'order'          => 'ASC',
            'orderby'        => 'title'
        );
 
        $query = new WP_Query( $args );
 
        if ( $query -> have_posts() ) {
 
            echo '<nav class="services-nav">';
            
            while ( $query -> have_posts() ) {
                $query -> the_post();
                echo '<a href="#'. esc_attr( get_the_ID() ) .'">'. esc_html( get_the_title() ) .'</a>';
            }
            wp_reset_postdata();
            
            echo '</nav>';
        
            echo '<section>';
    
            while ( $query -> have_posts() ) {
                $query -> the_post();
 
                echo '<article id="'. esc_attr( get_the_ID() ) .'">';	
                    echo '<h2>' . esc_html( get_the_title() ) . '</h2>';
                    the_content();
                echo '</article>';
                
            }
            wp_reset_postdata();
 
            echo '</section>';
        }
        ?>
    </div>
    <?php
    return ob_get_clean();
}