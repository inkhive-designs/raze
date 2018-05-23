<?php
/**
 * Adds a meta box to the post editing screen
 */
function raze_custom_meta() {
    add_meta_box( 'raze_meta', __( 'Display Options', 'raze' ), 'raze_meta_callback', 'page','side','high' );
}
add_action( 'add_meta_boxes', 'raze_custom_meta' );

/**
 * Outputs the content of the meta box
 */
 
function raze_meta_callback( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'raze_nonce' );
    $raze_stored_meta = get_post_meta( $post->ID );
    ?>
    
    <p>
	    <div class="raze-row-content">
	        <label for="enable-slider">
	            <input type="checkbox" name="enable-slider" id="enable-slider" value="yes" <?php if ( isset ( $raze_stored_meta['enable-slider'] ) ) checked( $raze_stored_meta['enable-slider'][0], 'yes' ); ?> />
	            <?php _e( 'Enable Slider', 'raze' )?>
	        </label>
	        <br />
	        <label for="enable-showcase">
	            <input type="checkbox" name="enable-showcase" id="enable-showcase" value="yes" <?php if ( isset ( $raze_stored_meta['enable-showcase'] ) ) checked( $raze_stored_meta['enable-showcase'][0], 'yes' ); ?> />
	            <?php _e( 'Enable Custom Showcase', 'raze' )?>
	        </label>
	        <br />

<!--
	        <label for="enable-grid">
	            <input type="checkbox" name="enable-grid" id="enable-grid" value="yes" <?php if ( isset ( $raze_stored_meta['enable-grid'] ) ) checked( $raze_stored_meta['enable-grid'][0], 'yes' ); ?> />
	            <?php _e( 'Enable Grid', 'raze' )?>
	        </label>
	        <br />
-->

	        <label for="hide-title">
	            <input type="checkbox" name="hide-title" id="hide-title" value="yes" <?php if ( isset ( $raze_stored_meta['hide-title'] ) ) checked( $raze_stored_meta['hide-title'][0], 'yes' ); ?> />
	            <?php _e( 'Hide Page Title', 'raze' )?>
	        </label>
	        <br />
	        <label for="enable-full-width">
	            <input type="checkbox" name="enable-full-width" id="enable-full-width" value="yes" <?php if ( isset ( $raze_stored_meta['enable-full-width'] ) ) checked( $raze_stored_meta['enable-full-width'][0], 'yes' ); ?> />
	            <?php _e( 'Enable Full Width (Hide Sidebar)', 'raze' )?>
	        </label>
	    </div>
	</p>
 
    <?php
}


/**
 * Saves the custom meta input
 */
function raze_meta_save( $post_id ) {
 
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'raze_nonce' ] ) && wp_verify_nonce( $_POST[ 'raze_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
 
    // Checks for input and sanitizes/saves if needed
    if( isset( $_POST[ 'meta-text' ] ) ) {
        update_post_meta( $post_id, 'meta-text', sanitize_text_field( $_POST[ 'meta-text' ] ) );
    }
    
    // Checks for input and saves
	if( isset( $_POST[ 'enable-slider' ] ) ) {
	    update_post_meta( $post_id, 'enable-slider', 'yes' );
	} else {
	    update_post_meta( $post_id, 'enable-slider', '' );
	}
	
	// Checks for input and saves
	if( isset( $_POST[ 'enable-showcase' ] ) ) {
	    update_post_meta( $post_id, 'enable-showcase', 'yes' );
	} else {
	    update_post_meta( $post_id, 'enable-showcase', '' );
	}
	
	// Checks for input and saves
	if( isset( $_POST[ 'enable-grid' ] ) ) {
	    update_post_meta( $post_id, 'enable-grid', 'yes' );
	} else {
	    update_post_meta( $post_id, 'enable-grid', '' );
	}

	// Checks for input and saves
	if( isset( $_POST[ 'hide-title' ] ) ) {
	    update_post_meta( $post_id, 'hide-title', 'yes' );
	} else {
	    update_post_meta( $post_id, 'hide-title', '' );
	}
	
	// Checks for input and saves
	if( isset( $_POST[ 'enable-full-width' ] ) ) {
	    update_post_meta( $post_id, 'enable-full-width', 'yes' );
	} else {
	    update_post_meta( $post_id, 'enable-full-width', '' );
	}
 
}
add_action( 'save_post', 'raze_meta_save' );