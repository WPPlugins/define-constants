=== Define Constants ===
Contributors: Ramon Fincken, Danny van Kooten
Donate link: http://donate.ramonfincken.com
Tags: define,defines,constant,constants
Requires at least: 2.0.2
Tested up to: 4.5.3
Stable tag: 1.2.1

GUI in backend to define constants without any programming knowledge. Every file in your theme has access to your constant.

== Description ==

GUI in backend to define constants without any programming knowledge. Every file in your theme has access to your constant.<br>No need to edit a functions.php file or a separate plugin file anymore<br>
Results in constants like: define('MY_CONSTANT',$value);<br><br>
Options: Re-arrange constants (Drag and drop)<br>
Protect constants as "internal value"<br>
Optional description per constant :)

<br>
<br>Coding by: 
<a href="http://wordpress.org/extend/plugins/profile/dvankooten">Danny van Kooten</a>
<a href="http://www.mijnpress.nl">MijnPress.nl</a> <a href="http://twitter.com/#!/ramonfincken">Twitter profile</a> <a href="http://wordpress.org/extend/plugins/profile/ramon-fincken">More plugins</a>

== Installation ==

1. Upload directory `define-constants` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Create some constants
4. You are ready to go! Every file in your theme has access to your constant.

== Frequently Asked Questions ==

= How does this plugin work? =
If you have a contstant named MY_TWITTER_URL ... You can use something like this in your PHP template file: `<a href="<?php echo MY_TWITTER_URL;?>">Twitter</a>`<br>
Or install a PHP in post plugin and use <?php echo MY_TWITTER_URL;?>



= I have a lot of questions and I want support where can I go? =

<a href="http://pluginsupport.mijnpress.nl/">http://pluginsupport.mijnpress.nl/</a> or drop me a tweet to notify me of your support topic over here.<br>
I always check my tweets, so mention my name with @ramonfincken and your problem.


== Changelog ==
= 1.2.1 =
Bugfix: Style extra div removal. Thanks to Alex for reporting 

= 1.2 =
First public release


== Screenshots ==

1. Default view
<a href="http://s.wordpress.org/extend/plugins/define-constants/screenshot-1.png">Fullscreen Screenshot 1</a><br>
