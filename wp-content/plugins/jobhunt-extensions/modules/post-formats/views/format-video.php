<div class="cf-elm-block" id="cfpf-format-video-fields" style="display: none;">
	<div id="postbox-container-postformat" class="postbox-container">
		<div id="meta-box-postformat-video" class="postbox" style="display: block;">
			<div class="handlediv"><br></div>
			<h3><span><?php esc_html_e( 'Video Options', 'jobhunt-extensions' ); ?></span></h3>			
			<div class="inside">
				<p style="padding:10px 0 0 0;"><?php esc_html_e( 'For HTML5 video support and Flash fallback please include an M4V file. Include an OGV file optionally to increase cross browser support.', 'jobhunt-extensions' ); ?></p>
				<table class="form-table">
					<tbody>
						<tr>
							<th>
								<label for="postformat_video_m4v">
									<strong><?php esc_html_e( 'M4V File URL', 'jobhunt-extensions' ); ?></strong>
									<span><?php esc_html_e( 'The URL to the .m4v video file', 'jobhunt-extensions' ); ?></span>
								</label>
							</th>
							<td>
								<input type="text" name="postformat_video_m4v" id="postformat_video_m4v" value="<?php echo esc_attr( get_post_meta( $post->ID, 'postformat_video_m4v', true ) ); ?>" size="30">
							</td>
						</tr>
						<tr>
							<th>
								<label for="postformat_video_ogv">
									<strong><?php esc_html_e( 'OGV File URL', 'jobhunt-extensions' ); ?></strong>
									<span><?php esc_html_e( 'The URL to the .ogv video file', 'jobhunt-extensions' ); ?></span>
								</label>
							</th>
							<td>
								<input type="text" name="postformat_video_ogv" id="postformat_video_ogv" value="<?php echo esc_attr( get_post_meta( $post->ID, 'postformat_video_ogv', true ) ); ?>" size="30">
							</td>
						</tr>
						<tr>
							<th>
								<label for="postformat_video_webm">
									<strong><?php esc_html_e( 'WEBM File URL', 'jobhunt-extensions' ); ?></strong>
									<span><?php esc_html_e( 'The URL to the .webm video file', 'jobhunt-extensions' ); ?></span>
								</label>
							</th>
							<td>
								<input type="text" name="postformat_video_webm" id="postformat_video_webm" value="<?php echo esc_attr( get_post_meta( $post->ID, 'postformat_video_webm', true ) ); ?>" size="30">
							</td>
						</tr>
						<tr>
							<th>
								<label for="postformat_video_poster">
									<strong><?php esc_html_e( 'Video Poster', 'jobhunt-extensions' ); ?></strong>
									<span><?php esc_html_e( 'A preivew image.', 'jobhunt-extensions' ); ?></span>
								</label>
							</th>
							<td>
								<input type="text" name="postformat_video_poster" id="postformat_video_poster" value="<?php echo esc_attr( get_post_meta( $post->ID, 'postformat_video_poster', true ) ); ?>" size="30">
							</td>
						</tr>
						<tr style="border-top: 1px solid #eeeeee;">
							<th>
								<label for="postformat_video_embed">
									<strong><?php esc_html_e( 'Embedded Code', 'jobhunt-extensions' ); ?></strong>
									<span><?php esc_html_e( 'If not using self hosted video you can include embeded code here.', 'jobhunt-extensions' ); ?></span>
								</label>
							</th>
							<td>
								<textarea name="postformat_video_embed" id="postformat_video_embed" rows="8" cols="5"><?php echo esc_textarea( get_post_meta( $post->ID, 'postformat_video_embed', true ) ); ?></textarea>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>