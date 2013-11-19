=== Top Songs ===
Contributors: brainwithstorm
Donate link: 
Tags: songs, top songs, charts, music, artists, songs, tracks, new songs
Requires at least: 2.9
Tested up to: 3.7.x
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Plugin to show top songs - admin can set it to widget area, set its title and number of songs and some special display options.

== Description ==

Plugin to show top songs - admin can set it to widget area, set its title and number of songs and some special display options.
Simple stand-alone widget displaying daily top songs via ajax script (that is cached for 2 hours after loading data) from external source (check external source section). There are some display customization options like number of displayed songs, song images display and link to songs option (default: false)

** External source **

External source page (External source URL: http://www.mytopnewsongs.com) is owned by Tomaz Miholic and it's not in privacy policy conflict with the website privacy. External source is necessary part of this plugin because the data is coming from this source.
Please not that if image display option is enabled that this can have impact on your wordpress website loading time, because images are loaded from external source from four different subdomains (External source domain: mytopnewsongs.com, subdomains: imga,imgb,imgc,imgd).

In next upgrade it's planned to add the categories (music genres) so user can select most appropriate genre for his blog/music style.

== Installation ==

1. Download the zip folder named top-songs.zip
2. Unzip the folder and put it in the plugins directory of your wordpress installation. (wp-content/plugins).
3. Activate the plugin through the plugin window in the admin panel.
4. Go to Widgets to set it to widget area (best option is side area).

== Frequently asked questions ==

= Can I set number of displayed songs ? =

Yes. You can control number of displayed songs in widget configuration area once it's put on Widget Area.

= Can I hide images of the songs ? =

Yes. You can control image display in widget configuration area (default option is set to: true).

= Can I create external links to songs ? =

Yes. You can display songs to perform as external link to external source displayed above by setting this in widget configuration area. Default option is set not to show external song links. (Default display external link: false)

= Who created this plugin? =

Plugin was created by Tomaz Miholic also known as brainwithstorm. He is owner of few blogs and based on needs of getting top songs data on his wordpress websites he created this plugin and now he wants to share it with community.

= Can plugin have impact on page load time? =

If option that displays images is enabled than this can happen due to external images being loaded into user's user agent. Also every two hours cache of songs will expire and initial load of new songs can also has slight impact on the page load.

== Screenshots ==

1. screenshot_1.png - showing stand-alone chart with no images
2. screenshot_2.png - showing few simple setting to make plugin more interactive
3. screenshot_3.png - showing music chart with images enabled

== Changelog ==

= 1.0.0 =
* Initial release

== Upgrade notice ==

= 1.0.0 =
* Initial release

== Arbitrary section 1 ==

