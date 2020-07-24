<?php

add_filter( 'pt-ocdi/import_files', 'jobhunt_ocdi_import_files' );

add_action( 'pt-ocdi/before_content_import', 'jobhunt_ocdi_before_content_import' );

add_action( 'pt-ocdi/after_import', 'jobhunt_ocdi_after_import_setup' );

add_action( 'pt-ocdi/before_widgets_import', 'jobhunt_ocdi_before_widgets_import' );

add_action( 'init', 'jobhunt_kc_force_enable_static_block', 99 );