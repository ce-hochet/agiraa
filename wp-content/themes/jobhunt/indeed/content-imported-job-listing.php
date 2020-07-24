<li class="<?php echo esc_attr( $source ); ?>_job_listing job_listing" data-longitude="<?php echo esc_attr( $job->longitude ); ?>" data-latitude="<?php echo esc_attr( $job->latitude ); ?>">
    <a href="<?php echo esc_url( $job->url ); ?>" target="_blank" <?php echo $link_attributes; ?>>
        <div class="job-listing-company-logo">
            <img class="company_logo" src="<?php echo esc_url( $job->logo ); ?>" alt="Logo" />
        </div>
        <div class="job-details">
            <div class="job-details-inner">
                <h3 class="job-listing-loop-job__title"><?php echo esc_html( $job->title ); ?></h3>
                <div class="job-listing-company company">
                    <strong><?php echo esc_html( $job->company ); ?></strong>
                    <!-- <small class="tagline"><?php //echo esc_html( $job->tagline ); ?></small> -->
                </div>
                <?php if ( !empty ( $job->location ) ) : ?>
                    <div class="job-location location">
                        <i class="la la-map-marker"></i><?php echo esc_html( $job->location ); ?>
                    </div>
                <?php endif; ?>
            </div><!-- /.job-details-inner -->
            <div class="job-listing-meta meta">
                <?php if ( !empty ( $job->location ) ) : ?>
                    <div class="job-location location">
                        <i class="la la-map-marker"></i><?php echo esc_html( $job->location ); ?>
                    </div>
                <?php endif; ?>
                <?php if ( !empty ( $job->type ) ) : ?>
                    <ul class="job-types">
                        <li class="job-type <?php echo esc_attr( $job->type_slug ); ?>"><?php echo esc_html( $job->type ); ?></li>
                    </ul>
                <?php endif; ?>
                <span class="job-published-date date">
                    <?php printf( __( '%s ago', 'jobhunt' ), human_time_diff( $job->timestamp, current_time( 'timestamp' ) ) ); ?>
                </span>
            </div>
        </div><!-- /.job-details -->
    </a>
</li>