<?php
/*
Plugin Name: Testing Easy Inputs
Plugin URI: https://github.com/holisticnetworking/easy-inputs
Description: Testing and demonstrating Easy Inputs.
Version: 0.1-beta
Author: Thomas J. Belknap
Author URI: http://holisticnetworking.net
*/

/*  Copyright 2013  Thomas J Belknap  (email : tbelknap@holisticnetworking.net)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

function register_ei() {
	// First, instantiate the class, checking to make sure no other plugin or theme
	// has already included the file:
	if( !class_exists( 'EasyInputs' ) ) {
		include_once( plugin_dir_path( __FILE__ ) . '../easy-inputs/easy-inputs.php' );
	}
	// Spare yourself the trouble of declaring twice:
	global $ei;
	$ei	= new EasyInputs( 'testing-easy-inputs' );
}

function add_page() {
	add_options_page( 'Testing Easy Inputs', 'Easy Inputs', 'publish_posts', 'easy-inputs', 'options_page');
}

function options_page() {
	global $ei;
	
	echo '<div class="wrap"><h1>Demonstrating Easy Inputs</h1>';
		echo '<p>Below you will see the output from the sample plugin\'s inputs. Go to the plugin file to see the function calls.</p>';
		// Create the form:
		echo $ei->open('dah-form');
		
			// Dead-simple input inclusion:
			echo '<h2>Dead-simple input inclusion</h2>';
			echo $ei->input( 'my_text_input' );
			
			// You can change the global group at any time:
			// $ei->set_group('grinch-group');
			
			// Now, let's include a value and some HTML attributes:
			echo '<h2>Now, let\'s include a value and some HTML attributes:</h2>';
			echo '<p>Please see the README.md file for the proper parameters and values for these. in general, all HTML5-valid attributes are available, including data attributes.</p>';
			echo $ei->input( 'another_text_input', array(
				'value'	=> 'Input Value',
				'attrs'	=> array('class' => 'custom classes', 'data-nana-nana' => 'boo-boo'),
				'label' => 'Specify any label you want.'
			) );
			
			// Labels Optional:
			echo '<h2>Labels are always optional</h2>';
			echo $ei->input( 'still_another_text_input', array(
				'value'	=> 'Input Value',
				'attrs'	=> array('class' => 'custom classes', 'data-value' => 'Nana, nana, boo-boo'),
				'label' => false
			) );
			// Or separable:
			echo '<p>';
			echo $ei->input( 'separate_label', array(
				'value'	=> '42',
				'attrs'	=> array('class' => 'custom classes', 'data-value' => 'Nana, nana, boo-boo'),
				'label' => false
			) );
			echo $ei->label( 'separate_label', 'Or can even be created separately, if you like.' );
			
			// Radio buttons
			echo '<h2>Let\'s add some radio buttons and selects.</h2>';
			echo '<p>Radio buttons require the "options" element in $args be set with a $key=>$value array.</p>';
			echo $ei->input( 'radio_buttons', [ 'type' => 'radio', 'options' => [ 'y' => 'Yes', 'n' => 'No' ] ] );
			echo $ei->input( 'color_select', [ 'type' => 'select', 'options' => [ 
				'gr' => 'Green', 
				'bl' => 'Blue',
				'yl' => 'Yellow',
				'rd' => 'Red',
				'or' => 'Orange' 
			] ] );
			echo $ei->input( 'color_checkbox', [ 'type' => 'checkbox', 'options' => [ 
				'gr' => 'Green', 
				'bl' => 'Blue',
				'yl' => 'Yellow',
				'rd' => 'Red',
				'or' => 'Orange' 
			] ] );
			
			// Textarea
			echo '<h2>Now for a textarea</h2>';
			echo $ei->input( 'big_area_of_text', [ 'type' => 'textarea', 'attrs' => [ 'cols' => 20, 'rows' => 8 ] ] );
			
			
			
			// Slightly more complex, but still simple. This version is the simplest way
			// to include both your input AND an automatically-generated nonce:
			echo '<h3>Slightly more complex, but still simple.</h3><p>This version is the simplest way to include both your input AND an automatically-generated nonce:</p>';
			echo $ei->group( 'mygroup', array( 'inputs' => array( 'my_input' ) ) );
			
			
			
			echo '<h3>Considerably more complex</h3><p>We treat each input as a single call to the input() function, include a fieldset and legend.</p>';
			echo $ei->group( 'seuss-group', array( 
				'fieldset'	=> array(
					'attrs'		=> array( 'class' => 'sneetch' ),
					'legend'	=> array( 'title' => "Don't cry because it's over, smile because it happened." )
				),
				'inputs' => array( 
					'one-input'		=> array( 'attrs'	=> array( 'class' => 'my-custom-class', 'data-stars' => 'on thars' ) ),
					'two-input'		=> array( 'value' => 'Cindy-loo Hoo' ),
					'red-input',
					'blue-input'	=> array( 'label' => 'Custom Label' )
				) ) );
			echo $ei->button('submit', 'Save it!!');
		
		// Close the form:
		echo $ei->close();
	echo '</div>';
}
add_action('admin_menu', 'add_page');
add_action('admin_init', 'register_ei');
?>
