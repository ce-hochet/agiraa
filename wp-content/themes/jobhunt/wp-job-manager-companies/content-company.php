<li <?php company_class(); ?>>
    <div class="company-inner">
        <?php
        do_action( 'jobhunt_before_company' );

        do_action( 'jobhunt_before_company_title' );

        do_action( 'jobhunt_company_title' );

        do_action( 'jobhunt_after_company_title' );

        do_action( 'jobhunt_after_company' );
        ?>
    </div>
</li>
