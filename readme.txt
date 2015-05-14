=== SIS Google Map ===
Contributors: sayful
Tags: google, google map, google map api,
Requires at least: 3.0
Tested up to: 4.2
Stable tag: 2.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Display custom Google Map. Customize google map without any programming skills.

== Description ==

[Note: This version 2.0.0 is different from the previous version 1.0. And previous shortcode will get the default value of current version. So after upgrading the plugin update your code. It will just take a minute.]

<h1>Features</h1>
<ul>
	<li>Unlimited Maps at same page or site.</li>
	<li>Five predefined styles.</li>
	<li>TinyMCE button for better user experience.</li>
	<li>Easy to change Width, Height and Zoom Level</li>
</ul>

= Usages =

After installing and activating the plugin, You will get a TinyMCE button at WordPress editor.
Go to WordPress editor on page or post and put your cursor where you want to insert map and then just click on map icon, a pop-up window will be opened. 
Fill all fields (Latitude, Longitude, Width, Height, Zoom Level and Map Style) and click on "OK"

= Latitude & Longitude =

You need Latitude and Longitude coordinate for map. You may find longitude and latitude from <a target="_blank" href="http://universimmedia.pagesperso-orange.fr/geo/loc.htm">http://universimmedia.pagesperso-orange.fr/geo/loc.htm</a>.
Default Latitude is 37.42200 and Default Longitude is -122.08395 that is Googleplex.

= Width =

Give the map width at pixel or percentage. Default value is 100%

= Height =

Give the map height at pixel. Default value is 350px

= Zoom Level =

Give the map zoom level between 0-21. Highest value zooms in and lowest zooms out. Default value is 15

= Map Style =

Choose predefined map styles from the list. Available options are None, Greyscale, Subtle Grayscale, Bright Bubbly, Mixed and Pale Dawn. Default value is "None"



Without using TinyMCE button you can also write your shortcode manually. Just paste the following shortcode where you want to display google map and change the attributes value as your need.

`[sis_google_map lat="" long="" width="" height="" style="" zoom=""]`

[Note: here style value will be --- none, mixed, pale_dawn, greyscale, bright_bubbly, subtle_grayscale]

Example with default value:

`[sis_google_map lat="37.42200" long="-122.08395" width="100%" height="350px" style="none" zoom="15"]`




== Installation ==

Installing the plugins is just like installing other WordPress plugins. If you don't know how to install plugins, please review the two options below:

Install by Search

* From your WordPress dashboard, choose 'Add New' under the 'Plugins' category.
* Search for 'SIS Google Map' a plugin will come called 'SIS Google Map by Sayful Islam' and Click 'Install Now' and confirm your installation by clicking 'ok'
* The plugin will download and install. Just click 'Activate Plugin' to activate it.

Install by ZIP File

* From your WordPress dashboard, choose 'Add New' under the 'Plugins' category.
* Select 'Upload' from the set of links at the top of the page (the second link)
* From here, browse for the zip file included in your plugin titled 'sis-google-map.zip' and click the 'Install Now' button
* Once installation is complete, activate the plugin to enable its features.

Install by FTP

* Find the directory titles 'sis-google-map' and upload it and all files within to the plugins directory of your WordPress install (WORDPRESS-DIRECTORY/wp-content/plugins/) [e.g. www.yourdomain.com/wp-content/plugins/]
* From your WordPress dashboard, choose 'Installed Plugins' option under the 'Plugins' category
* Locate the newly added plugin and click on the 'Activate' link to enable its features.


== Frequently Asked Questions ==
Do you have questions or issues with SIS Google Map? [Ask for support here.](http://wordpress.org/support/plugin/sis-google-map)

== Screenshots ==

1. Screenshot of SIS Google Map Back-end TinyMCE button.
2. Screenshot of SIS Google Map Front-end.

== Changelog ==

= version 2.0.0 =
* Removed previous version 1.0
* Unlimited Maps at same page or site.
* Five predefined styles.
* TinyMCE button for better user experience.

= version 1.0 =
* Implementation of basic functionality.


== Upgrade Notice ==

= 2.0.0 =
This version 2.0.0 is different from the previous version 1.0. And previous shortcode will get the default value of current version. So after upgrading the plugin update your code. It will just take a minute.