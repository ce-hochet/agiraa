<?php $category = get_the_resume_category(); ?>
<li <?php resume_class(); ?>>
    <div class="resume-inner">
        <?php
        do_action( 'jobhunt_before_resume' );

        do_action( 'jobhunt_before_resume_title' );

        do_action( 'jobhunt_resume_title' );

        do_action( 'jobhunt_after_resume_title' );

        do_action( 'jobhunt_after_resume' ); 
        ?>
    </div>
</li>
