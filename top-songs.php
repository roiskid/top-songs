<?php
/*
Plugin Name: Top Songs
Plugin URI: 
Description: Daily top songs on your wordpress blog. If you want to make your wordpress site more interesting you can simply add this stand-alone widget to your website.
Author: brainwihstorm
Author URI: 
Version: 1.0.0
License: GPL version 2 or later - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/

/*
Copyright Tomaz Miholic 2013

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

For license informations please see <http://www.gnu.org/licenses/>.
*/

define(topsongs_URL, 'http://www.mytopnewsongs.com/wp.php?dn='.$_SERVER['HTTP_HOST']);
define(topsongs_TITLE, 'Top Songs');
define(topsongs_NUMBER_OF_ITEMS, 5);

function topsongs_widget_Init() {
  register_widget('TopSongsWidget');
}
	
add_action("widgets_init", "topsongs_widget_Init");
	
class TopSongsWidget extends WP_Widget 
{
     function TopSongsWidget()  {
       parent::WP_Widget(false,$name="Top Songs Widget");
     }

     function widget($args, $instance) 
	 {
		$options = $instance;
		
		//CACHING AND DATA RETREIVAL - USED TRANSCIENT CACHING
		$songs_data = get_transient('topsongs_data');
		if ( empty( $songs_data ) ){
			$songs_data = wp_remote_get(topsongs_URL);
			$songs_data = $songs_data["body"];
			set_transient('topsongs_data', $songs_data,7200);
		}
		$songs = json_decode($songs_data, true);
		
		//OUTPUT
		if ($options['topsongs_widget_title']!="")	{	
			$output .= '<h2>'.$options['topsongs_widget_title'].'</h2>';	
		}
		
		$show_images = (bool)$options['topsongs_widget_show_song_images'];
		$show_links =  (bool)$options['topsongs_widget_show_song_links'];
		
		for($i=0; $i<$options['topsongs_widget_number_of_items'] && $i<count($songs["data"]); $i++)		{
			$output .= '<div style="width:100%;height:1%">
							'.($show_images ? '<div style="width:30%;float:left;">
													'.($show_links ? '<a target="_blank" href="'.$songs["data"][$i]["link"].'">' : "").'
													<img style="width:100%;height:100%;-moz-border-radius: 3px;border-radius: 3px;" alt="'.strip_tags($songs["data"][$i]["title"]).'" src="'.$songs["data"][$i]["img"].'" />
													'.($show_links ? '</a>' : "").'
												</div>' : '').'
												<div style="padding:3px;'.($show_images ? 'width:66%;float:right;text-align:left">': 'width:100%;text-align:left;"><ul style="width:100%;margin:0px;list-style-type:none"><li><b>'.($i+1).'.</b>').'
													'.($show_links ? '<a target="_blank" href="'.$songs["data"][$i]["link"].'">' : '').'
													'.$songs["data"][$i]["title"].'
													'.($show_links ? '</a>' : "</li></ul>").'
												</div>
						</div>
						<div style="clear:both;padding-top:5px;"></div>';							
		}
		
		
		extract($args);	
		echo $before_widget; 
		echo $before_title . $title . $after_title;
		echo $output; 
		echo $songs["u"];
		echo $after_widget;
     }

     function update($new_instance, $old_instance) 	 {
		$instance = $old_instance;
		$instance['topsongs_widget_title'] = strip_tags($new_instance['topsongs_widget_title']);
		$instance['topsongs_widget_number_of_items'] = strip_tags($new_instance['topsongs_widget_number_of_items']);
		$instance['topsongs_widget_show_song_images'] = (bool)$new_instance['topsongs_widget_show_song_images'];
		$instance['topsongs_widget_show_song_links'] = (bool)$new_instance['topsongs_widget_show_song_links'];
		return $instance;
     }

     function form($instance) 	 {
        $instance = wp_parse_args( (array) $instance, array(
		'topsongs_widget_title'=>topsongs_TITLE,
		'topsongs_widget_number_of_items'=>topsongs_NUMBER_OF_ITEMS,
		'topsongs_widget_show_song_images'=>true,
		'topsongs_widget_show_song_links'=>false
		));
		$topsongs_widget_title = htmlspecialchars($instance['topsongs_widget_title'], ENT_QUOTES);
		$topsongs_widget_number_of_items = htmlspecialchars($instance['topsongs_widget_number_of_items'], ENT_QUOTES);			
		$topsongs_widget_show_song_images = (bool)$instance['topsongs_widget_show_song_images'];			
		$topsongs_widget_show_song_links = (bool)$instance['topsongs_widget_show_song_links'];			
	   ?>
	  
		<p><label for="topsongs_widget_title"><?php _e('Widget Title:'); ?> <input  id="<?php echo  $this->get_field_id('topsongs_widget_title');?>" name="<?php echo  $this->get_field_name('topsongs_widget_title');?>" type="text" value="<?php echo $topsongs_widget_title; ?>" /></label></p>
		<p><label for="topsongs_widget_number_of_items"><?php _e('Number of Songs to Show:'); ?> <input  id="topsongs_widget_number_of_items" name="<?php echo  $this->get_field_name('topsongs_widget_number_of_items');?>" size="2" maxlength="2" type="text" value="<?php echo $topsongs_widget_number_of_items;?>" /></label></p>
	    <p><label for="topsongs_widget_show_song_images"><?php _e('Show Song Images:'); ?> <select  id="topsongs_widget_show_song_images" name="<?php echo  $this->get_field_name('topsongs_widget_show_song_images');?>">
				<option <?php echo ($topsongs_widget_show_song_images ? 'selected' : '') ?> value="1">Yes</option>
				<option <?php echo (!$topsongs_widget_show_song_images ? 'selected' : '') ?> value="0">No</option></select></label></p>
	    <p><label for="topsongs_widget_show_song_links"><?php _e('Enable Song Links:'); ?> <select  id="topsongs_widget_show_song_links" name="<?php echo  $this->get_field_name('topsongs_widget_show_song_links');?>">
				<option <?php echo (!$topsongs_widget_show_song_links ? 'selected' : ''); ?> value="0">No</option>
				<option <?php echo ($topsongs_widget_show_song_links ? 'selected' : ''); ?> value="1">Yes</option></select></label></p>
	  
	   <?php
     }
}


?>
