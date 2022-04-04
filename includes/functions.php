<?php
function kim_faq_shortcode( $atts ) {
	
	global $wpdb;
	$atts = shortcode_atts( [
		'id'  => 0,
		'show_title'  => 0,
		'show_icon'  => 0,
		'title_color'  => 0,
		'icon_color'  => 0,
		'answer_color'  => 0,
		'question_color'  => 0,
		'background_title_color'  => 0,
		'background_answer_color'  => 0,
		'background_question_color'  => 0,
	], $atts );
	$ID = filter_var($atts['id'], FILTER_SANITIZE_NUMBER_INT);
	$table = '';
	$table_name ='kim_question_answer';
	$table = "{$wpdb->prefix}$table_name";
	$query = $wpdb->prepare( 
	  "SELECT * FROM $table WHERE shortcode_id = %s", 
	  $ID
	);
	$results = $wpdb->get_results( $query , ARRAY_A );

	$table_name_get_title ='kim_faq';
	$table_get_title = "{$wpdb->prefix}$table_name_get_title";
	$query = $wpdb->prepare( 
	  "SELECT title FROM $table_get_title WHERE id = %s", 
	  $ID
	);
	$get_title = $wpdb->get_row( $query , ARRAY_A );
	
	if ($atts['icon_color'] != 0 ) {
		$icon_color = 'style="color:'.$atts['icon_color'] .';"';
	} else {
		$icon_color = "";
	}
	if ($atts['title_color'] != 0 ) {
		$title_color = 'style="color:'.$atts['title_color'] .';"';
	} else {
		$title_color = "";
	}
	if ($atts['answer_color'] != 0 ) {
		$answer_color =  'style="color:'.$atts['answer_color'].';"';
	} else {
		$answer_color = "";
	}
	if ($atts['question_color'] != 0 ) {
		$question_color =  'style="color:'.$atts['question_color'].';"';
	} else {
		$question_color = "";
	}
	if ($atts['background_title_color'] != 0 ) {
		$background_title_color =  'style="background-color:'.$atts['background_title_color'].';"';
	} else {
		$background_title_color = "";
	}
	if ($atts['background_answer_color'] != 0 ) {
		$background_answer_color =  'style="background-color:'.$atts['background_answer_color'].';"';
	} else {
		$background_answer_color = "";
	}
	if ($atts['background_question_color'] != 0 ) {
		$background_question_color =  'style="background-color:'.$atts['background_question_color'].';"';
	} else {
		$background_question_color = "";
	}
// 'show_title' 
	// 'show_icon' 
	// 'title_color' 
	// 'answer_color' 
	// 'question_color' 
	// 'background_title_color' 
	// 'background_answer_color' 
	// 'background_question_color'
	$output ='';
	if ($atts['show_title'] == '1') {
		$output .="<div class='kim_title' $background_title_color ><h2 $title_color >".$get_title['title'].'</h2></div>';	
	} 

	$output .= '<div class="accordion">'; 
	foreach ($results as $key => $value) {
		$answer = $value['answer'];
		$question = $value['question'];
		$output .= "<div class='accordion-item'>
			<button id='accordion-button-1' aria-expanded='false' $background_question_color >
				<span class='accordion-title' $question_color > $question</span>";
		
		if($atts['show_icon'] == '1') {
			$output .= 	"<span class='icon' aria-hidden='true' $icon_color ></span>";
		}
		$output .= "</button>";
		$output .= "<div class='accordion-content' $background_answer_color ><p $answer_color >$answer</p></div></div>";
	}
	
	$output .= '</div>
	<script>
	const items = document.querySelectorAll(".accordion button");
	function toggleAccordion() {
		const itemToggle = this.getAttribute("aria-expanded");
		for (i = 0; i < items.length; i++) {
			items[i].setAttribute("aria-expanded", "false");
		}
		if (itemToggle == "false") {
			this.setAttribute("aria-expanded", "true");
		}
	}
	items.forEach((item) => item.addEventListener("click", toggleAccordion));
</script>';
	return $output;
}



	