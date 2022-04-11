<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

if ( !class_exists( 'WPBakeryShortCode_la_countdown' ) ) {
	class WPBakeryShortCode_la_countdown extends LaStudio_Shortcodes_Abstract{

	}
}


$shortcode_params = array(
	array(
		"type" => "dropdown",
		"heading" => __("Design", 'la-studio'),
		"param_name" => "count_style",
		"value" => array(
			__("Style 01",'la-studio') => "1",
			__("Style 02",'la-studio') => "2",
		)
	),
	array(
		"type" => "datetimepicker",
		"heading" => __("Target Time For Countdown", 'la-studio'),
		"param_name" => "datetime",
		"description" => __("Date and time format (yyyy/mm/dd hh:mm:ss).", 'la-studio'),
	),
	array(
		"type" => "dropdown",
		"heading" => __("Countdown Timer Depends on", 'la-studio'),
		"param_name" => "time_zone",
		"value" => array(
			__("WordPress Defined Timezone",'la-studio') => "wptz",
			__("User's System Timezone",'la-studio') => "usrtz",
		),
	),
	array(
		"type" => "checkbox",
		"heading" => __("Select Time Units To Display In Countdown Timer", 'la-studio'),
		"param_name" => "countdown_opts",
		"value" => array(
			__("Years",'la-studio') => "syear",
			__("Months",'la-studio') => "smonth",
			__("Weeks",'la-studio') => "sweek",
			__("Days",'la-studio') => "sday",
			__("Hours",'la-studio') => "shr",
			__("Minutes",'la-studio') => "smin",
			__("Seconds",'la-studio') => "ssec",
		),
	),
	LaStudio_Shortcodes_Helper::fieldCssAnimation(),
	LaStudio_Shortcodes_Helper::fieldExtraClass(),

	array(
		"type" => "textfield",
		"heading" => __("Day (Singular)", 'la-studio'),
		"param_name" => "string_days",
		"value" => "Day",
		'group' => __( 'Strings Translation', 'la-studio' ),
	),
	array(
		"type" => "textfield",
		"heading" => __("Days (Plural)", 'la-studio'),
		"param_name" => "string_days2",
		"value" => "Days",
		'group' => __( 'Strings Translation', 'la-studio' ),
	),
	array(
		"type" => "textfield",
		"heading" => __("Week (Singular)", 'la-studio'),
		"param_name" => "string_weeks",
		"value" => "Week",
		'group' => __( 'Strings Translation', 'la-studio' ),
	),
	array(
		"type" => "textfield",
		"heading" => __("Weeks (Plural)", 'la-studio'),
		"param_name" => "string_weeks2",
		"value" => "Weeks",
		'group' => __( 'Strings Translation', 'la-studio' ),
	),
	array(
		"type" => "textfield",
		"heading" => __("Month (Singular)", 'la-studio'),
		"param_name" => "string_months",
		"value" => "Month",
		'group' => __( 'Strings Translation', 'la-studio' ),
	),
	array(
		"type" => "textfield",
		"heading" => __("Months (Plural)", 'la-studio'),
		"param_name" => "string_months2",
		"value" => "Months",
		'group' => __( 'Strings Translation', 'la-studio' ),
	),
	array(
		"type" => "textfield",
		"heading" => __("Year (Singular)", 'la-studio'),
		"param_name" => "string_years",
		"value" => "Year",
		'group' => __( 'Strings Translation', 'la-studio' ),
	),
	array(
		"type" => "textfield",
		"heading" => __("Years (Plural)", 'la-studio'),
		"param_name" => "string_years2",
		"value" => "Years",
		'group' => __( 'Strings Translation', 'la-studio' ),
	),
	array(
		"type" => "textfield",
		"heading" => __("Hour (Singular)", 'la-studio'),
		"param_name" => "string_hours",
		"value" => "Hrs",
		'group' => __( 'Strings Translation', 'la-studio' ),
	),
	array(
		"type" => "textfield",
		"heading" => __("Hours (Plural)", 'la-studio'),
		"param_name" => "string_hours2",
		"value" => "Hrs",
		'group' => __( 'Strings Translation', 'la-studio' ),
	),
	array(
		"type" => "textfield",
		"heading" => __("Minute (Singular)", 'la-studio'),
		"param_name" => "string_minutes",
		"value" => "Mins",
		'group' => __( 'Strings Translation', 'la-studio' ),
	),
	array(
		"type" => "textfield",
		"heading" => __("Minutes (Plural)", 'la-studio'),
		"param_name" => "string_minutes2",
		"value" => "Mins",
		'group' => __( 'Strings Translation', 'la-studio' ),
	),
	array(
		"type" => "textfield",
		"heading" => __("Second (Singular)", 'la-studio'),
		"param_name" => "string_seconds",
		"value" => "Secs",
		'group' => __( 'Strings Translation', 'la-studio' ),
	),
	array(
		"type" => "textfield",
		"heading" => __("Seconds (Plural)", 'la-studio'),
		"param_name" => "string_seconds2",
		"value" => "Secs",
		'group' => __( 'Strings Translation', 'la-studio' ),
	),
);

return apply_filters(
	'LaStudio/shortcodes/configs',
	array(
		'name'			=> __('Count Down', 'la-studio'),
		'base'			=> 'la_countdown',
		'icon'          => 'la-wpb-icon la_countdown',
		'category'  	=> __('La Studio', 'la-studio'),
		'description' 	=> __('Countdown Timer','la-studio'),
		'params' 		=> $shortcode_params
	),
    'la_countdown'
);