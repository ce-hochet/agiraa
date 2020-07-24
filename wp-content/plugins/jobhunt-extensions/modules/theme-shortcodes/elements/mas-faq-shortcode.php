<?php

if ( ! function_exists( 'mas_faq_shortcode_element' ) ) {

	function mas_faq_shortcode_element( $atts, $content = null ){

		extract( shortcode_atts( array(
			'limit'			=> 10,
			'ids'			=> '',
			'category'		=> '',
			'orderby'		=> 'date',
			'order'			=> 'asc',
		), $atts ) );

		$query_args = array(
			'post_type'				=> 'mas_faq',
			'post_status'			=> 'publish',
			'ignore_sticky_posts'	=> 1,
			'orderby'				=> $orderby,
			'order'					=> $order,
			'posts_per_page'		=> $limit,
			'include'				=> $ids,
		);

		if ( ! empty( $category ) ) {
			$query_args['tax_query'] = array(
				array(
					'taxonomy'	=> 'faq_cat',
					'field'		=> 'slug',
					'terms'		=> array_filter( array_map( 'trim', explode( ',', $category ) ) ),
				)
			);
		}

		$html = '';

		$posts = get_posts( $query_args );

		// The Display.
		if ( ! is_wp_error( $posts ) && is_array( $posts ) && count( $posts ) > 0 ) {
			ob_start();
			?>
			<div class="jobhunt-faq-content">
				<ul class="faq-content-questions">
					<?php
						global $post;

						foreach ( $posts as $post ) {

							setup_postdata( $post );

							$title   = get_the_title();
							$content = get_the_content();
							$content = apply_filters( 'mas_faq_content', $content, $post );
							
							?>
							<li class="faq-content-question">
								<div id="question-<?php echo esc_attr( $post->ID ); ?>" class="faq-content-question-header">
									<h5 class="collapsed" data-toggle="collapse" data-target="#collapse-<?php echo esc_attr( $post->ID ); ?>" aria-expanded="true" aria-controls="collapse-<?php echo esc_attr( $post->ID ); ?>"><?php echo esc_html( $title ); ?></h5> 
								</div>
								<div id="collapse-<?php echo esc_attr( $post->ID ); ?>" class="collapse">
									<div class="faq-content-question-body"><?php echo wp_kses_post( $content ); ?></div>
								</div>
							</li>
							<?php
						}
					?>
				</ul>
			</div>
			<?php
			wp_reset_postdata();
			$html = ob_get_clean();
		}

		return $html;

	}
}

add_shortcode( 'mas_faq' , 'mas_faq_shortcode_element' );