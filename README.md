# Background Info
This is a theme designed to work with the bikefuncal plugin. Some things you should know, in order to get it to work:

* It's a child theme of the twentyeleven theme, so you must have twentyeleven installed for this to work. (twentyeleven is installed by default with WordPress)
* You must have the bikefuncal plugin installed.
* We (Velopalooza) use the [[http://wordpress.org/extend/plugins/adrotate/|AdRotate plugin]] to show a list of sponsors. You have two choices for dealing with this: (1) go into front-page.php and delete the part about AdRotate, or (2) install the plugin, and create at least two ad blocks. To create the blocks, go to the WP dashboard, then AdRotate -> Manage Blocks -> Add New.
* You'll almost certainly need to edit the theme's PHP and SCSS (style) files, at least a little. We recommend that you use Mercurial and BitBucket to track your changes. This will make it much easier to share improvements & changes between cities.

# Using SASS
The stylesheets for the theme are written in [[http://sass-lang.com|SASS]]; SASS is like CSS, but much more manageable to write. The file style.css is generated from the files in the scss directory. (Some of the layouts we made would have been tremendously cumbersome to write in plain CSS.)

In order to regenerate style.css from the SCSS files, you have some options.

* Use [[http://compass.handlino.com/|Compass.App]], a graphical program that runs on Windows, Mac, and Linux.
* Use [[http://incident57.com/codekit/|CodeKit]], a graphical app that runs on Mac.
* Run sass from the command line. See installation instructions here: http://sass-lang.com/tutorial.html

To run sass from the command line (after you've installed it on the server):
* ssh into the server
* cd to the velotheme-meg directory
* Run `sass --watch sass:.`
* Edit the .scss files. When you save them, the .css file will be automatically generated.

# Front Page Content
On the front page, there are two content areas: (1) the upper content, to the right of the poster, and (2)the content on the lower part of the page ("Velopalooza 2012" text, the link to the current calendar, and the Velopalooza calendar). Each of these are managed separately.

The upper content is a WordPress Page, and you can edit it like any other Page. So, in the admin panel, create your new page. Then, to make it appear on the front page, go to the admin panel > Settings > Reading. Choose "Front Page displays a static page," then choose your page.

The lower content is hard-coded into front-page.php. You'll need to edit the PHP file to make changes there. However, you can add text to the event calendar with the [[https://bitbucket.org/evan_dickinson/bikefuncal/wiki/Shortcodes|bfc_overview_cal_padding shortcode]]

# Header Images on Secondary Pages
To change the header images on secondary pages (not the front page), you'll need to edit the path in header.php.
