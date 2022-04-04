<?php
function kim_faq_init() {
	$ct_table = ct_register_table( 'kim_faq', array(
		'singular'     => __( 'FAQ', 'kim_faq' ),
		'plural'       => __( 'FAQS', 'kim_faq' ),
		'show_ui'      => true,
		'show_in_rest' => true,
		// Make custom table visible on rest API
		//'rest_base'  => 'sjd-faq',  // Rest base URL, if not defined will user the table name
		'version'      => 1,
		// Change the version on schema changes to run the schema auto-updater
		//'primary_key' => 'route_id',    // If not defined will be checked on the field that hsa primary_key as true on schema
		'schema'       => array(
			'id'      => array(
				'type'           => 'bigint',
				'length'         => '20',
				'auto_increment' => true,
				'primary_key'    => true,
			),
			'title'    => array(
				'type' => 'varchar',
				'length' => '5000',
				//'default' => date( 'Y-m-d H:i:s' ),
			),
			'shortcode'    => array(
				'type' => 'varchar',
				'length' => '1000',
				//'default' => date( 'Y-m-d H:i:s' ),
			),
			'created_at'    => array(
				'type' => 'datetime',
				//'default' => date( 'Y-m-d H:i:s' ),
			),
			'update_at'    => array(
				'type' => 'datetime',
				//'default' => date( 'Y-m-d H:i:s' ),
			),
			'background_question_colorpicker'    => array(
				'type' => 'varchar',
				'length' => '20',
				//'default' => date( 'Y-m-d H:i:s' ),
			),
			'background_answer_colorpicker'    => array(
				'type' => 'varchar',
				'length' => '20',
				//'default' => date( 'Y-m-d H:i:s' ),
			),
			'background_title_colorpicker'    => array(
				'type' => 'varchar',
				'length' => '20',
				//'default' => date( 'Y-m-d H:i:s' ),
			),
			'question_color_colorpicker'    => array(
				'type' => 'varchar',
				'length' => '20',
				//'default' => date( 'Y-m-d H:i:s' ),
			),
			'answer_color_picker'    => array(
				'type' => 'varchar',
				'length' => '20',
				//'default' => date( 'Y-m-d H:i:s' ),
			),
			'title_colorpicker'    => array(
				'type' => 'varchar',
				'length' => '20',
				//'default' => date( 'Y-m-d H:i:s' ),
			),
			'show_icon_radio_inline'    => array(
				'type' => 'varchar',
				'length' => '20',
				//'default' => date( 'Y-m-d H:i:s' ),
			),
			'show_title_radio_inline'    => array(
				'type' => 'varchar',
				'length' => '20',
				//'default' => date( 'Y-m-d H:i:s' ),
			),
			'icon_color_picker'    => array(
				'type' => 'varchar',
				'length' => '20',
				//'default' => date( 'Y-m-d H:i:s' ),
			),
		),
		// Database engine (default to InnoDB)
		'engine'       => 'InnoDB',
		// View args
		'views'        => array(
			'list' => array(
				'menu_title'  => __( 'Add New FAQ', 'kim_faq' ),
				'parent_slug' => 'kim-faq',
				// 'per_page' => 20 // This will force the per page initial value
			)
		),
		//'supports'     => array( 'meta' )
	) );

}
add_action( 'ct_init', 'kim_faq_init' );

/* ----------------------------------
* LIST VIEW
* Examples about some interesting hooks to use on list view
---------------------------------- */

// Columns on list view
function kim_faq_manage_kim_faq_columns( $columns = array() ) {
	$columns['title']   = __( 'Title', 'kim_faq' );
    $columns['shortcode']   = __( 'Shortcode', 'kim_faq' );
    $columns['created_at']   = __( 'Created at', 'kim_faq' );
    $columns['update_at']   = __( 'Update at', 'kim_faq' );

	return $columns;
}
add_filter( 'manage_kim_faq_columns', 'kim_faq_manage_kim_faq_columns' );

// Sortable columns on list view
function kim_faq_manage_kim_faq_sortable_columns( $sortable_columns = array() ) {

	$sortable_columns['title']   = 'title';                     // ORDER BY title ASC
    $sortable_columns['shortcode']   = array( 'shortcode', false );
    $sortable_columns['created_at']   = array( 'created_at', false );
    $sortable_columns['update_at']   = array( 'update_at', true );

	return $sortable_columns;
}
add_filter( 'manage_kim_faq_sortable_columns', 'kim_faq_manage_kim_faq_sortable_columns' );

/* ----------------------------------
* ADD/EDIT VIEW
* Examples about some interesting hooks to use on add/edit views
---------------------------------- */

// Default data when creating a new item (similar to WP auto draft) see ct_insert_object()
function kim_faq_kim_faq_default_data( $default_data = array() ) {

	$default_data['title'] = 'Auto draft';
	$default_data['created_at'] = date( 'Y-m-d H:i:s' );

	return $default_data;
}
add_filter( 'ct_kim_faq_default_data', 'kim_faq_kim_faq_default_data' );

/* ----------------------------------
* CMB2
* Examples about CMB2 compatibility
---------------------------------- */

// CMB2 meta box initialization
function kim_faq_cmb2_meta_boxes() {
	$kim_faq_object_type = 'kim_faq';
	$cmb_faq = new_cmb2_box( array(
		'id'           => 'cmb-kim_faq-meta-box-id',
		'title'        => __( 'Details', 'kim_faq' ),
		'object_types' => array( $kim_faq_object_type ),
	) );

	$cmb_faq->add_field( array(
		'name'      => __( 'Title', 'kim_faq' ),
		'type'      => 'text',
		'id'        => 'title',
	) );

	$kim_faq_object_type = 'kim_faq';
	$cmb_faq2 = new_cmb2_box( array(
		'id'           => 'cmb-kim2_faq-meta-box-id',
		'title'        => __( 'Questions & Answers', 'kim_faq' ),
		'object_types' => array( $kim_faq_object_type ),
	) );
	
	$group_field_id = $cmb_faq2->add_field( array(
		'id'          => 'afq_repeater',
		'type'        => 'group',
		'options'     => array(
			'group_title'       => __( 'Entry {#}', 'cmb2' ), // since version 1.1.4, {#} gets replaced by row number
			'add_button'        => __( 'Add Question & Answer', 'cmb2' ),
			'remove_button'     => __( 'Remove Questions & Answers', 'cmb2' ),
			'sortable'          => true,
			// 'closed'         => true, // true to have the groups closed by default
			// 'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'cmb2' ), // Performs confirmation before removing group.
		),
	) );
	
	// Id's for group's fields only need to be unique for the group. Prefix is not needed.
	$cmb_faq2->add_group_field( $group_field_id, array(
		'name' => 'Entry Question',
		'id'   => 'question',
		'type' => 'text',
		// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
	) );
	// Id's for group's fields only need to be unique for the group. Prefix is not needed.
	$cmb_faq2->add_group_field( $group_field_id, array(
		'name' => 'Entry Answer',
		'id'   => 'answer',
		'type' => 'text',
		// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
	) );

	// 'show_title' 
	// 'show_icon' 
	$kim_faq_object_type = 'kim_faq';
	$cmb_faq_set = new_cmb2_box( array(
		'id'           => 'kim_faq_settings',
		'title'        => __( 'Settings', 'kim_faq' ),
		'object_types' => array( $kim_faq_object_type ),
	) );

	$cmb_faq_set->add_field( array(
		'name'    => 'Show Title',
		'id'      => 'show_title_radio_inline',
		'type'    => 'radio_inline',
		'options' => array(
			'0' => __( 'False', 'cmb2' ),
			'1'   => __( 'True', 'cmb2' ),
		),
		'default' => '1',
	) );
	$cmb_faq_set->add_field( array(
		'name'    => 'Show Icon',
		'id'      => 'show_icon_radio_inline',
		'type'    => 'radio_inline',
		'options' => array(
			'0' => __( 'False', 'cmb2' ),
			'1'   => __( 'True', 'cmb2' ),
		),
		'default' => '1',
	) );

	$cmb_faq_set->add_field( array(
		'name'    => 'Icon Color Picker',
		'id'      => 'icon_color_picker',
		'type'    => 'colorpicker',
		'default' => '',
		// 'options' => array(
		//     'alpha' => true, // Make this a rgba color picker.
		// ),
	) );
	$cmb_faq_set->add_field( array(
		'name'    => 'Title Color Picker',
		'id'      => 'title_colorpicker',
		'type'    => 'colorpicker',
		'default' => '',
		// 'options' => array(
		//     'alpha' => true, // Make this a rgba color picker.
		// ),
	) );
	$cmb_faq_set->add_field( array(
		'name'    => 'Answer Color Picker',
		'id'      => 'answer_color_picker',
		'type'    => 'colorpicker',
		'default' => '',
		// 'options' => array(
		//     'alpha' => true, // Make this a rgba color picker.
		// ),
	) );
	$cmb_faq_set->add_field( array(
		'name'    => 'Question Color Picker',
		'id'      => 'question_color_colorpicker',
		'type'    => 'colorpicker',
		'default' => '',
		// 'options' => array(
		//     'alpha' => true, // Make this a rgba color picker.
		// ),
	) );
	$cmb_faq_set->add_field( array(
		'name'    => 'Background Title Color Picker',
		'id'      => 'background_title_colorpicker',
		'type'    => 'colorpicker',
		'default' => '',
		// 'options' => array(
		//     'alpha' => true, // Make this a rgba color picker.
		// ),
	) );
	$cmb_faq_set->add_field( array(
		'name'    => 'Background Answer Color Picker',
		'id'      => 'background_answer_colorpicker',
		'type'    => 'colorpicker',
		'default' => '',
		// 'options' => array(
		//     'alpha' => true, // Make this a rgba color picker.
		// ),
	) );
	$cmb_faq_set->add_field( array(
		'name'    => 'Background Question Color Picker',
		'id'      => 'background_question_colorpicker',
		'type'    => 'colorpicker',
		'default' => '',
		// 'options' => array(
		//     'alpha' => true, // Make this a rgba color picker.
		// ),
	) );
	
	$cmb_publish = new_cmb2_box( array(
		'id'           => 'cmb-kim_kim_faq_publish-meta-box-id',
		'title'        => __( 'Publish', 'kim_faq' ),
		'object_types' => array( $kim_faq_object_type ),
		'context'      => 'side',
		'classes'      => 'cmb2-side',
		'priority'     => 'default',  //  'high', 'core', 'default' or 'low'
	) );

	$cmb_publish->add_field( array(
		'id'         => 'created_at',
		'before'     => "<span id='timestamp'>Published on:</span>",
		'type'       => 'text',
		'attributes' => array(
			'readonly'        => 'readonly',
			'data-codeeditor' => json_encode( array(
				'codemirror' => array(
					'mode'     => 'css',
					'readOnly' => 'nocursor',
				),
			) ),
		),
	) );


    $cmb = new_cmb2_box( array(
        'id'           => 'cmb2_shortcode_metabox',
        'title'        => 'Shortcode',
        'object_types' => $kim_faq_object_type,
    ) );

    $cmb->add_field( array(
        'name' => 'Your Shortcode',
        'id'   => 'Shortcode',
        'type' => 'shortcode',
        'desc' => '',
    ) );

}
add_action( 'cmb2_admin_init', 'kim_faq_cmb2_meta_boxes' );

/* ----------------------------------
* QUERY
* As WP_Query, CT has a query class named CT_Query to apply (cached) searches on custom tables
---------------------------------- */

//  Fields to apply a search, used on searches ('s' query var)
function kim_faq_kim_faq_search_fields( $search_fields = array() ) {

	$search_fields[] = 'title';

	return $search_fields;

}
add_filter( 'ct_query_kim_faq_search_fields', 'kim_faq_kim_faq_search_fields' );

add_filter( 'ct_insert_object_data', 'update_kim_faq', 10, 2 );
function update_kim_faq( $object_data, $original_object_data ) {
	// Checking by nonce field
	if ( isset( $object_data['nonce_CMB2phpcmb-kim_kim_faq_publish-meta-box-id'] ) ) {
		$object_data['update_at'] = date( 'Y-m-d H:i:s' );
		$shortcode_id = isset($_GET['id']) ? $_GET['id'] : '';
	    $background_question_colorpicker = $object_data['background_question_colorpicker'];
		$background_answer_colorpicker = $object_data['background_answer_colorpicker'];
		$background_title_colorpicker= $object_data['background_title_colorpicker'];
		$question_color_colorpicker = $object_data['question_color_colorpicker'];
		$answer_color_picker = $object_data['answer_color_picker'];
		$question_color_colorpicker = $object_data['question_color_colorpicker'];
		$title_colorpicker = $object_data['title_colorpicker'];
		$icon_color_picker = $object_data['icon_color_picker'];
		$show_icon_radio_inline = $object_data['show_icon_radio_inline'];
		$show_title_radio_inline = $object_data['show_title_radio_inline'];
		$object_data['shortcode'] = "[kim_faq id='$shortcode_id'";
		$object_data['shortcode'] .= " show_title='$show_title_radio_inline'";
		$object_data['shortcode'] .= " show_icon='$show_icon_radio_inline'";
		if ($icon_color_picker != '#' && $icon_color_picker != '') {
			$object_data['shortcode'] .= " icon_color='$icon_color_picker'";
		}
		if ($title_colorpicker != '#' && $title_colorpicker != '') {
			$object_data['shortcode'] .= " title_color='$title_colorpicker'";
		}
		if ($answer_color_picker != '#' && $answer_color_picker != '') {
			$object_data['shortcode'] .= " answer_color='$answer_color_picker'";
		}
		if ($question_color_colorpicker != '#' && $question_color_colorpicker != '') {
			$object_data['shortcode'] .= " question_color='$question_color_colorpicker'";
		}
		if ($background_title_colorpicker != '#' && $background_title_colorpicker != '') {
			$object_data['shortcode'] .= " background_title_color='$background_title_colorpicker'";
		}
		if ($background_answer_colorpicker != '#' && $background_answer_colorpicker != '') {
			$object_data['shortcode'] .= " background_answer_color='$background_answer_colorpicker'";
		}
		if ($background_question_colorpicker != '#' && $background_question_colorpicker != '') {
			$object_data['shortcode'] .= " background_question_color='$background_question_colorpicker'";
		}
		$object_data['shortcode'] .= " ]";

		global $wpdb;
		$table     = $wpdb->prefix . 'kim_question_answer';
		$wpdb->delete( $table, [ 'shortcode_id' => $shortcode_id ] );
		$sql = "INSERT INTO $table";
		$sql .= " (shortcode_id,question,answer)";
		$sql .= " VALUES";
		foreach ( $object_data['afq_repeater'] as $key => $value ) {
			$Question = $value['question'];
			$Answer = $value['answer'];   
			if ( $key == count( $object_data['afq_repeater'] ) - 1 ) {
				$sql .= " ('$shortcode_id','$Question','$Answer');";
			} else {
				$sql .= " ('$shortcode_id','$Question','$Answer'),";			 
			}
		}

		$wpdb->query($sql);
		  
	}
	return $object_data;
	
}

// $data = apply_filters( "cmb2_override_{$a['field_id']}_meta_value", $data, $this->object_id, $a, $this );
add_filter( 'cmb2_override_afq_repeater_meta_value', 'update_db_faq', 10, 4 );
function update_db_faq($data, $object_id, $a, $_this ) {
	$id = isset($_GET['id']) ? $_GET['id'] : '';
	$edit_sjd_faq = isset($_GET['page']) ? $_GET['page'] : '';

	if ( $edit_sjd_faq = 'edit_kim_faq' && $id != '' ) {
		$table_name ='kim_question_answer';
		global $wpdb;
		$table = "{$wpdb->prefix}$table_name";
		$sql    = "SELECT shortcode_id,question,answer  FROM $table WHERE shortcode_id = $id";
		$data =  $wpdb->get_results( $sql, ARRAY_A  );		
	}

	return $data;
}

function cmb2_render_callback_for_shortcode( $field, $escaped_value, $object_id, $object_type, $field_type_object ) {
   
	$id = isset($_GET['id']) ? $_GET['id'] : '';
	$edit_sjd_faq = isset($_GET['page']) ? $_GET['page'] : '';

	if ( $edit_sjd_faq = 'edit_kim_faq' && $id != '' ) {
		$table_name ='kim_faq';
		global $wpdb;
		$table = "{$wpdb->prefix}$table_name";
		$sql    = "SELECT shortcode  FROM $table WHERE id = '$id'";
		$data =  $wpdb->get_row( $sql, ARRAY_A  );

		if ($data) {
			$shortcode = $data['shortcode'];
			if ( empty($shortcode) ) {
				echo '<h4 class="shortcode-class">Please click on update button to generating shortcode<h4>';	
			} else {	
				echo "<h4 class='shortcode-class'>$shortcode<h4>";
			}
	
		}
	

	}
}
add_action( 'cmb2_render_shortcode', 'cmb2_render_callback_for_shortcode', 10, 5 );
