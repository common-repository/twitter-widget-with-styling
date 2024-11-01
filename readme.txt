=== Twitter Widget with Styling ===
Contributors: mpol
Tags: twitter, widget, twitter style, twitter feed, twitter styling, stylesheet, embedded timeline, easy twitter widget
Requires at least: 3.7
Tested up to: 4.6
Stable tag: 2.1.2
License: GPLv2 or later


A Twitter Widget that is easy to configure and easy to style.

== Description ==

> This plugin is essentially unmaintained. If you have it installed and configured, it will probably keep on working for a while.
>
> Twitter changed the way accounts are used inside the JavaScript widget. And I am quite tired of wasting time chasing the whims of a company like Twitter.
> (I should have thought of that earlier).
>
> Anyway, you shouldn't use this type of widget anymore. This type of third-party JavaScript is often blocked by browsers and users, so many people will not see it.
> If you want to have a Twitter Feed on your website, you are better off with something that is done serverside in PHP.
> There are probably many plugins that offer that functionality.

A Twitter Widget that is easy to configure and easy to style. It uses the Embedded Timeline Widget of Twitter.com.
You can have it load an extra stylesheet, where you can style the layout of the widget.

== Installation ==

1. Upload the plugin folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Go to [Twitter](https://dev.twitter.com/docs/embedded-timelines).
4. Create your own Embedded Timeline App.
5. Go to Appearance->Widgets, add the widget to any sidebar.
6. Add your Twitter Name and your Twitter ID from the code you got from Twitter.
7. Enjoy!

== Frequently Asked Questions ==

= How do I edit the stylesheet? =

Copy the style_twitter.css from the plugin to your theme directory.
The widget will find it and add it to the webpage instead of the default in the plugin.
Do not edit the style_twitter.css in the plugin itself, it will be overwritten when updating.

= Can I add multiple widgets to a page? =

Yes, you can, the plugin will load styling for all widgets..

== Screenshots ==

1. Screenshot of the widget in the admin section.
2. Screenshot of the frontend of the widget with transparent styling
3. Screenshot of the frontend of the widget with grey styling
4. Screenshot of the frontend of the widget with brown styling
5. Screenshot of the frontend of the widget with blue styling
6. Screenshot of the frontend of the widget with blue styling

== Changelog ==

= 2.1.2 =
* 2016-08-20
* Fix warning when there is no stylesheet in the theme.
* Also enqueue when caching is used.

= 2.1.1 =
* 2016-08-13
* Add filter twitter_widget_with_styling_data_aria_live for data-aria-live option.
* Add filter twitter_widget_with_styling_data_tweet_limit for data-tweet-limit option.

= 2.1.0 =
* 2016-08-13
* Load CSS file with ?ver=timestamp.
* Remove development option.
* Add filter twitter_widget_with_styling_data_chrome for data-chrome option.
* Remove unneeded actions for flush_widget_cache.

= 2.0.2 =
* 2015-12-11
* Drop pot and nl_NL, they are maintained at GlotPress.

= 2.0.1 =
* 2015-12-05
* Better default feed.

= 2.0.0 =
* 2015-11-10
* Support Multiple Widgets.
* Version 2.0.0 of JavaScript.
* Use wp_localize_script for variable.
* Place Twitter Timeline code in JavaScript file.
* Moar examples.

= 1.3.1 =
* 2015-10-04
* Use plugins_url() for enqueue.

= 1.3.0 =
* 2015-09-15
* Only support WordPress 3.7+, since they really are supported.
* Add License to JavaScript.

= 1.2.9 =
* 2015-09-10
* Update examples.
* Change text-domain to slug.
* Really load translation.

= 1.2.8 =
* 2015-05-30
* Have checkTwitter var really be a counter.

= 1.2.7 =
* 2014-11-07
* Support Child Themes.
* Drop unneeded Widget Customizer support.

= 1.2.6 =
* 2014-04-15
* Support Widget Customizer in 3.9.

= 1.2.5 =
* 2014-04-11
* Only load js when widget is loaded (in footer).

= 1.2.4 =
* 2014-04-02
* More examples.

= 1.2.3 =
* 2014-04-02
* Examples now included.

= 1.2.2 =
* 2014-02-18
* Fix issue with Contact Form 7.

= 1.2.1 =
* 2013-12-10
* Change name of var to not conflict.

= 1.2 =
* 2013-11-22
* Add Serbo-Croatian language (thanks Borisa).
* Add development mode.

= 1.1 =
* 2013-11-13
* First fix issue of loading on every page.

= 1.0 =
* 2013-11-12
* First Version.
