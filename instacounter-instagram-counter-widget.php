<?php
/*
 * Plugin Name: Instacounter Instagram Counter Widget
 * Version: 1.0
 * Plugin URI: 
 * Description: With InstaCounter Instagram Counter Widget, you can display Instagram Counter badge on your website (Follower, Following and Media counts). You can register for free account and let InstaCounter start to provide statistics for your Instagram profile. 
 * Author: instacounterdotcom
 * Author URI: http://instacounter.com
 * License: GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
class InstagramCounterWidget extends WP_Widget
{
	/**
	* Declares the InstagramCounterWidget class.
	*
	*/
	function InstagramCounterWidget(){
		$widget_ops = array('classname' => 'widget_InstagramCounter', 'description' => __( "With InstaCounter Instagram Counter Widget, you can display Instagram Counter badge on your website (Follower, Following and Media counts). You can register for free account and let InstaCounter start to provide statistics for your Instagram profile.") );
		$control_ops = array('width' => 300, 'height' => 300);
		$this->WP_Widget('InstagramCounter', __('Instagram Counter Widget'), $widget_ops, $control_ops);
	}
	
	/**
	* Displays the Widget
	*
	*/
	function widget($args, $instance){
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? 'Instagram Counter' : $instance['title']);
		$instagramUserName = empty($instance['instagramUserName']) ? 'instacounterdotcom' : $instance['instagramUserName'];
		$counterStyle = empty($instance['counterStyle']) ? '40' : $instance['counterStyle'];
		$logStatViaInstaCounter = empty($instance['logStatViaInstaCounter']) ? 'no' : $instance['logStatViaInstaCounter'];
				
		# Before the widget
		echo $before_widget;
		
		# The title
		if ( $title )
			echo $before_title . $title . $after_title;
		
		# Render the Widget
		if ($logStatViaInstaCounter == 'yes') {
			echo '<a href="http://instacounter.com/follow/' . $instagramUserName . '" title="Follow ' . $instagramUserName . ' "><img src="http://instacounter.com/counter/' . $counterStyle . '/' . $instagramUserName . '.png' .   '" border=0></a>';
		} else {
			echo '<a href="http://instagram.com/' . $instagramUserName . '" title="Follow ' . $instagramUserName . ' "><img src="http://instacounter.com/counter/' . $counterStyle . '/' . $instagramUserName . '.png' .   '" border=0></a>';
		}
		# After the widget
		echo $after_widget;
	}
	
	/**
	* Saves the widgets settings.
	*
	*/
	function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['title'] = strip_tags(stripslashes($new_instance['title']));
		$instance['instagramUserName'] = strip_tags(stripslashes($new_instance['instagramUserName']));
		$instance['counterStyle'] = strip_tags(stripslashes($new_instance['counterStyle']));
		$instance['logStatViaInstaCounter'] = strip_tags(stripslashes($new_instance['logStatViaInstaCounter']));
		
		return $instance;
	}
	
	/**
	* Creates the edit form for the widget.
	*
	*/
	function form($instance){
		//Defaults
		$instance = wp_parse_args( (array) $instance, array('title'=>'', 'instagramUserName'=>'instacounterdotcom', 'logStatViaInstaCounter'=>'no', 'counterStyle'=>'1') );
		
		$title = htmlspecialchars($instance['title']);
		$instagramUserName = htmlspecialchars($instance['instagramUserName']);
		$counterStyle = htmlspecialchars($instance['counterStyle']);
		$logStatViaInstaCounter  = htmlspecialchars($instance['logStatViaInstaCounter']);
		
		#Some intro for this widget
		echo '<p style="text-align:left;">Please visit <a href="http://instacounter.com" target="_blank">Instacounter</a> and login once with Instagram first (OAuth).</p><hr/>';
		
		# Output the options
		echo '<p style="text-align:right;"><label for="' . $this->get_field_name('title') . '">' . __('Title:') . ' <input style="width: 250px;" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" /></label></p>';
		# Fill InstagramCounter ID
		echo '<p style="text-align:right;"><label for="' . $this->get_field_name('instagramUserName') . '">' . __('Instagram Username:') . ' <input style="width: 100px;" id="' . $this->get_field_id('instagramUserName') . '" name="' . $this->get_field_name('instagramUserName') . '" type="text" value="' . $instagramUserName . '" /></label></p>';
		
		# logStatViaInstaCounter Feature : option to select YEs or No 
		echo '<p style="text-align:right;"><label for="' . $this->get_field_name('logStatViaInstaCounter') . '">' . __('Turn On Clicks Hit (will need to redirect to InstaCounter.com before Instagram.com)') . ' <select name="' . $this->get_field_name('logStatViaInstaCounter')  . '" id="' . $this->get_field_id('logStatViaInstaCounter')  . '">"';
?>
		<option value="no" <?php if ($logStatViaInstaCounter == 'no') echo 'selected="yes"'; ?> >No</option>
		<option value="yes" <?php if ($logStatViaInstaCounter == 'yes') echo 'selected="yes"'; ?> >Yes</option>			 
<?php
		echo '</select></label>';
		
		# Fill Counter Style Selection
		echo '<p style="text-align:right;"><label for="' . $this->get_field_name('counterStyle') . '">' . __('Counter Style:') . ' <select name="' . $this->get_field_name('counterStyle')  . '" id="' . $this->get_field_id('counterStyle')  . '">"';
?>
		<option value="1" <?php if ($counterStyle == '1') echo 'selected="yes"'; ?> >Counter 1</option>
		<option value="2" <?php if ($counterStyle == '2') echo 'selected="yes"'; ?> >Counter 2</option>
		<option value="3" <?php if ($counterStyle == '3') echo 'selected="yes"'; ?> >Counter 3</option>
		<option value="4" <?php if ($counterStyle == '4') echo 'selected="yes"'; ?> >Counter 4</option>
		<option value="5" <?php if ($counterStyle == '5') echo 'selected="yes"'; ?> >Counter 5</option>				 
<?php
		echo '</select></label>';
			
	}

}// END class
	
	/**
	* Register  widget.
	*
	* Calls 'widgets_init' action after widget has been registered.
	*/
	function InstagramCounterInit() {
	register_widget('InstagramCounterWidget');
	}	
	add_action('widgets_init', 'InstagramCounterInit');
?>