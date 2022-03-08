<?php
// disable direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// event container
$output .= '<div id="event-'.get_the_ID().'" class="vsel-content'.vsel_event_cats().vsel_event_status().'">';
	// event details section
	// start event details section before or after title
	if ($page_title_location != 'yes') {
		$output .= $page_meta_section_start;
	}
		// title
		if ($vsel_atts['title_link'] == 'false') {
			$event_title = '<h3 class="vsel-meta-title">'.get_the_title().'</h3>';
		} else {
			if ( ($link_title_to_more_info == 'yes') && (!empty($link)) ) {
				$event_title = '<h3 class="vsel-meta-title"><a href="'.esc_url($link).'" '.$link_target.' title="'.esc_url($link).'">'.get_the_title().'</a></h3>';
			} elseif ($page_link_title == 'yes') {
				$event_title =  '<h3 class="vsel-meta-title"><a href="'.get_permalink().'" rel="bookmark" title="'.get_the_title().'">'.get_the_title().'</a></h3>';
			} else {
				$event_title = '<h3 class="vsel-meta-title">'.get_the_title().'</h3>';
			}
		}
		if ( $page_title_hide != 'yes' ) {
			if ( ($page_title_location != 'yes') && ($page_date_hide != 'yes') && ($page_show_icon == 'yes') && ($page_meta_combine == 'yes') ) {
				$output .= '';
			} else {
				$output .= $event_title;
			}
		}
	// start event details section before or after title
	if ($page_title_location == 'yes') {
		$output .= $page_meta_section_start;
	}
		// combine date icon and title or not
		if ( ($page_title_location != 'yes') && ($page_title_hide != 'yes') && ($page_date_hide != 'yes') && ($page_show_icon == 'yes') && ($page_meta_combine == 'yes') ) {
			$output .= '<div class="vsel-meta-combine">';
		}
		// date
		if ( $page_date_hide != 'yes' ) {
			if ( empty($start_date) || empty($end_date) || ($start_date > $end_date) ) {
				$output .= '<div class="vsel-meta-date vsel-meta-error">';
				$output .= esc_attr__( 'Error: please reset date.', 'very-simple-event-list' );
				$output .= '</div>';
			} elseif ($end_date > $start_date) {
				if ( $page_show_icon == 'yes' ) {
					if ($page_date_format == 'j F Y' || $page_date_format == 'd/m/Y' || $page_date_format == 'd-m-Y') {
						$output .= '<div class="vsel-meta-date-icon vsel-meta-combined-date-icon"><div class="vsel-start-icon">';
						$output .= $page_start_icon_1;
						$output .= '</div>';
						$output .= '<div class="vsel-end-icon">';
						$output .= $page_end_icon_1;
						$output .= '</div></div>';
					} else {
						$output .= '<div class="vsel-meta-date-icon vsel-meta-combined-date-icon"><div class="vsel-start-icon">';
						$output .= $page_start_icon_2;
						$output .= '</div>';
						$output .= '<div class="vsel-end-icon">';
						$output .= $page_end_icon_2;
						$output .= '</div></div>';
					}
				} else {
					if ($page_date_combine == 'yes') {
						$output .= '<div class="vsel-meta-date vsel-meta-combined-date">';
						$output .= $page_start_default;
						$output .= ' '.$date_separator.' ';
						$output .= $page_end_default;
						$output .= '</div>';
					} else {
						$output .= '<div class="vsel-meta-date vsel-meta-start-date">';
						$output .= $page_start_default;
						$output .= '</div>';
						$output .= '<div class="vsel-meta-date vsel-meta-end-date">';
						$output .= $page_end_default;
						$output .= '</div>';
					}
				}
			} elseif ($end_date == $start_date) {
				if ( $page_show_icon == 'yes' ) {
					if ($page_date_format == 'j F Y' || $page_date_format == 'd/m/Y' || $page_date_format == 'd-m-Y') {
						$output .= '<div class="vsel-meta-date-icon vsel-meta-single-date-icon"><div class="vsel-start-icon">';
						$output .= $page_start_icon_1;
						$output .= '</div></div>';
					} else {
						$output .= '<div class="vsel-meta-date-icon vsel-meta-single-date-icon"><div class="vsel-start-icon">';
						$output .= $page_start_icon_2;
						$output .= '</div></div>';
					}
				} else {
					$output .= '<div class="vsel-meta-date vsel-meta-single-date">';
					$output .= $page_same_default;
					$output .= '</div>';
				}
			}
		}
		// combine date icon and title or not
		if ( ($page_title_location != 'yes') && ($page_title_hide != 'yes') && ($page_date_hide != 'yes') && ($page_show_icon == 'yes') && ($page_meta_combine == 'yes') ) {
			$output .= $event_title;
			$output .= '</div>';
		}
		// time
		if ( $page_time_hide != 'yes' ) {
			if ( $one_time_field != 'yes' ) {
				if ($start_time > $end_time) {
					$output .= '<div class="vsel-meta-time vsel-meta-error">';
					$output .= esc_attr__( 'Error: please reset time.', 'very-simple-event-list' );
					$output .= '</div>';
				} else {
					if ( $all_day_event == 'yes' ) {
						$output .= '<div class="vsel-meta-time vsel-meta-all-day">';
						$output .= esc_attr($page_all_day_label);
						$output .= '</div>';
					} elseif( $start_time < $end_time ) {
						if ( $hide_end_time == 'yes' ) {
							$end = '';
						} else {
							$end = ' '.$time_separator.' '.wp_date( esc_attr($template_time_format), esc_attr($end_time), $utc_time_zone );
						}		
						$output .= '<div class="vsel-meta-time">';
						$output .= sprintf(esc_attr($page_time_label), '<span>'.wp_date( esc_attr($template_time_format), esc_attr($start_time), $utc_time_zone ).$end.'</span>' );
						$output .= '</div>';
					}
				}
			} else {
				if (!empty($time)) {
					$output .= '<div class="vsel-meta-time">';
					$output .= sprintf(esc_attr($page_time_label), '<span>'.esc_attr($time).'</span>' );
					$output .= '</div>';
				}
			}
		}
		// location
		if ( $page_location_hide != 'yes' ) {
			if (!empty($location)) {
				$output .= '<div class="vsel-meta-location">';
				$output .= sprintf(esc_attr($page_location_label), '<span>'.esc_attr($location).'</span>' );
				$output .= '</div>';
			}
		}
		// include acf fields
		if( class_exists('acf') && ($page_acf_hide != 'yes') ) {
			include 'vsel-acf.php';
		}
		// more info link
		if ($link_title_to_more_info != 'yes') {
			if ( $page_link_hide != 'yes' ) {
				if (!empty($link)) {
					$output .= '<div class="vsel-meta-link">';
					$output .= '<a href="'.esc_url($link).'" '.$link_target.' title="'.esc_url($link).'">'.esc_attr($link_label).'</a>';
					$output .= '</div>';
				}
			}
		}
		// categories
		if ( $page_cats_hide != 'yes' ) {
			$cats_raw = wp_strip_all_tags( get_the_term_list( get_the_ID(), 'event_cat', '<span>', ' '.$cat_separator.' ', '</span>' ) );
			$cats = get_the_term_list( get_the_ID(), 'event_cat', '<span>', ' '.$cat_separator.' ', '</span>' );
			if( has_term( '', 'event_cat', get_the_ID() ) ) {
				if ($page_link_cat != 'yes') {
					$output .= '<div class="vsel-meta-cats">';
					$output .= $cats_raw;
					$output .= '</div>';
				} else {
					$output .= '<div class="vsel-meta-cats">';
					$output .= $cats;
					$output .= '</div>';
				}
			}
		}
	// end event details section
	$output .= $page_meta_section_end;
	// event info section
	$output .= $page_event_info_section_start;
		// featured image
		if ($vsel_atts['featured_image'] != 'false') {
			if ( $page_image_hide != 'yes' ) {
				if ( has_post_thumbnail() ) {
					$image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), $page_image_source );
					$image_title = get_the_title( get_post_thumbnail_id( get_the_ID() ) );
					if ($page_link_image != 'yes') {
						$output .= '<img class ="'.$page_img_class.'" src="'.$image_attributes[0].'" width="'.$image_attributes[1].'" height="'.$image_attributes[2].'" '.$page_image_max_width.' alt="'.$image_title.'" />';
					} else {
						$output .=  '<a href="'. get_permalink() .'"><img class ="'.$page_img_class.'" src="'.$image_attributes[0].'" width="'.$image_attributes[1].'" height="'.$image_attributes[2].'" '.$page_image_max_width.' alt="'.$image_title.'" /></a>';
					}
				}
			}
		}
		// event info
		if ( $page_info_hide != 'yes' ) {
			$output .= '<div class="vsel-info">';
				if ($page_excerpt != 'yes') {
					$output .= apply_filters( 'the_content', get_the_content() );
				} elseif (!empty($summary)) {
					$output .= apply_filters( 'the_excerpt', $summary );
				}  else {
					$output .= apply_filters( 'the_excerpt', get_the_excerpt() );
				}
			$output .= '</div>';
		}
	// end event info section
	$output .= $page_event_info_section_end;
// end event container
$output .= '</div>';
