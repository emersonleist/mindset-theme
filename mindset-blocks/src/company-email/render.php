<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
?>
<div <?php echo get_block_wrapper_attributes(); ?>>
	<?php if ( $attributes[ 'svgIcon' ] ) : ?>
		<svg viewBox="0 0 8 6" xmlns="http://www.w3.org/2000/svg">
			<path d="m0 0h8v6h-8zm.75 .75v4.5h6.5v-4.5zM0 0l4 3 4-3v1l-4 3-4-3z"/>
		</svg>
	<?php endif; ?>
	<p><?php echo wp_kses_post( get_post_meta( 15, 'company_email', true ) ); ?></p>
	</div>		
