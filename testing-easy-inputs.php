<?php
/*
Plugin Name: Testing Easy Inputs
Plugin URI: https://github.com/holisticnetworking/easy-inputs
Description: Testing and demonstrating Easy Inputs.
Version: 0.1-beta
Author: Thomas J. Belknap
Author URI: http://holisticnetworking.net
*/
/**
* Plugin Name: Testing Easy Inputs
* Plugin URI: https://github.com/holisticnetworking/easy-inputs
* Description: Testing and demonstrating Easy Inputs.
* Version: 0.1-beta
* Author: Thomas J. Belknap
* Author URI: http://holisticnetworking.net
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
include_once( plugin_dir_path( __FILE__ ) . '../easy-inputs/easy-inputs.php' );
use EasyInputs\EasyInputs;


/**
 * Register an instance of EasyInputs and save it in the global scope.
 * It isn't necessary to do this step in a more focused plugin. But in this
 * case, we do this to make the object available elsewhere.
 */
function register_ei() 
{
    // Spare yourself the trouble of declaring twice:
    global $ei;
    $ei = new EasyInputs([ 
        'name' => 'testing-easy-inputs', 
        'type' => 'setting'
    ]);
}


/**
 * Add an options page to demonstrate the plugin.
 */
function add_page() 
{
    add_options_page( 'Testing Easy Inputs', 'Easy Inputs', 'publish_posts', 'easy-inputs', 'options_page');
}



/**
 * The actual options page.
 */
function options_page() 
{
    global $ei;
    
    echo '<div class="wrap"><h1>Demonstrating Easy Inputs</h1>';
        echo '<p>Below you will see the output from the sample plugin\'s '
        . 'inputs. Go to the plugin file to see the function calls.</p>';
        // Create the form:
        echo $ei->Form->open();
        
            // Dead-simple input inclusion:
            echo '<h2>Dead-simple input inclusion</h2>';
            echo $ei->Form->input( 'my_text_input' );
            
            // Now, let's include a value and some HTML attributes:
            echo '<h2>Now, let\'s include a value and some HTML'
            . 'attributes:</h2>';
            echo '<p>Please see the README.md file for the proper parameters'
            . ' and values for these. in general, all HTML5-valid attributes' 
            . 'are available, including data attributes.</p>';
            echo $ei->Form->input( 'another_text_input', array(
                'value' => 'Input Value',
                'attrs' => array(
                    'class' => 'custom classes', 
                    'data-nana-nana' => 'boo-boo'
                ),
                'label' => 'Specify any label you want.'
            ) );
            
            // Labels Optional:
            echo '<h2>Labels are always optional</h2>';
            echo $ei->Form->input( 'still_another_text_input', array(
                'value' => 'Input Value',
                'attrs' => array(
                    'class' => 'custom classes', 
                    'data-value' => 'Nana, nana, boo-boo'
                ),
                'label' => 'You can create your own label'
            ) );
            // Or separable:
            echo '<p>';
            echo $ei->Form->input( 'separate_label', array(
                'value' => '42',
                'attrs' => array(
                    'class' => 'custom classes', 
                    'data-value' => 'Nana, nana, boo-boo'
                ),
                'label' => false
            ) );
            echo $ei->Form->label( 
                'separate_label', 
                'Or can even be created separately, if you like.' 
            );
            
            // Radio buttons
            echo '<h2>Let\'s add some radio buttons and selects.</h2>';
            echo '<p>Radio buttons require the "options" element in $args be'
            . ' set with a $key=>$value array.</p>';
            echo $ei->Form->input( 
                'radio_buttons', 
                [ 
                    'type' => 'radio', 
                    'options' => [ 'y' => 'Yes', 'n' => 'No' ] 
                ]
            );
            echo $ei->Form->input( 
                'color_select', 
                    [ 
                        'type' => 'select', 
                        'options' => [
                            'gr' => 'Green',
                            'bl' => 'Blue',
                            'yl' => 'Yellow',
                            'rd' => 'Red',
                            'or' => 'Orange'
                        ] 
                    ] 
                );
            echo $ei->Form->input( 
                'color_checkbox', 
                    [ 
                        'type' => 'checkbox', 
                        'options' => [
                            'gr' => 'Green',
                            'bl' => 'Blue',
                            'yl' => 'Yellow',
                            'rd' => 'Red',
                            'or' => 'Orange'
                        ]
                    ]
                );
            
            // Textarea
            echo '<h2>Now for a textarea</h2>';
            echo $ei->Form->input( 
                'big_area_of_text', 
                [ 
                    'type' => 'textarea', 
                    'attrs' => 
                    [ 
                        'cols' => 20, 
                        'rows' => 8
                    ]
                ]
            );
            
            
            
            // Slightly more complex, but still simple. This version is the 
            // simplest way to include both your input AND an
            // automatically-generated nonce:
            echo '<h3>Slightly more complex, but still simple.</h3><p>This'
            . 'version is the simplest way to include both your input AND an'
            . 'automatically-generated nonce:</p>';
            echo $ei->Form->group( 
                'mygroup', 
                [
                    'inputs' => 
                    [
                        'my_input'
                    ]
                ]
            );
            
            
            
            // echo '<h3>Considerably more complex</h3><p>We treat each input'
            // . 'as a single call to the input() function, include a fieldset'
            // . '  and legend.</p>';
            /* echo $ei->group( 'seuss-group',
                [
                    'fieldset'  => [
                        'attrs'     => [ 'class' => 'sneetch' ],
                        'legend'    => [ 'title' => "Don't cry because"
                            . " it's over, smile because it happened." ]
                    ],
                    'inputs' => 
                        [
                            'one-input'     => [
                                'attrs'   => [
                                    'class' => 'my-custom-class',
                                    'data-stars' => 'on thars'
                                ]
                            ],
                            'two-input'     => [ 'value' => 'Cindy-loo Hoo' ],
                            'red-input',
                            'blue-input'    => [ 'label' => 'Custom Label' ]
                        ]
                    ]
                ); */
                
                
            echo $ei->Form->input( 
                'form_submit', [
                    'type'  => 'button',
                    'value' => 'Save It!',
                    'attrs' => [
                        'class' => 'button'
                    ]
                ]
            );
        
        // Close the form:
        echo $ei->Form->close();
    echo '</div>';
}

add_action('admin_menu', 'add_page');
add_action('admin_init', 'register_ei');