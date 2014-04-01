# CaptusBackend #

The backend of Captus consisting of a number of WordPress plugins.


----------


## Installation ##
### Prerequisites ###
In order to install the exhibition application you will need a LAMP environment and a normal WordPress 3.8.1 site deployed on that server. To set up the environment and WordPress 3.8.1 we suggest to use the following tutorials, it is proved to work in 31.03.2014.

[LAMP installation + CURL for PHP][1]
[Wordpress installation][2]
### Plugins ###
#### External ####
To install the plugins listed in this section just use the Plugins>Add new menu from the admin panel and search for WP-Members, install and activate it. Alternatively you can install it by unzipping the downloaded plugin from the given plugin site.
##### WP-Members (Version 2.9.1) #####
Plugin to handle and customize user management. We use it to make possible custom registration and login forms, to enable registration using only e-mail, customized registration mail sending and everything which deals with user management.
Websites of the plugin for more information or manual installation: https://wordpress.org/plugins/wp-members/ or http://rocketgeek.com/plugins/wp-members/

##### Fotorama (Version 4.4.9) #####
This plugin is used for creating responsive, mobile navigable galleries, which can be used in posts and pages.
Websites of the plugin for more information or manual installation: https://wordpress.org/plugins/fotorama/ or http://fotorama.io/ 

##### WP-Mail-SMTP (Version 0.9.4) #####
This plugin can be used for setting up SMTP details, which is used across the WP environment. It is mainly introduced, because of the registration mails sent by WP-Members
Websites of the plugin for more information or manual installation: http://wordpress.org/plugins/wp-mail-smtp/ or http://www.callum-macdonald.com/code/wp-mail-smtp/ 

##### Simple Custom CSS (Version 2.5) #####
This plugin is installed to enable to define globally universal CSS rules. We used it to enable CSS rules, like hiding the whole header for showing the content in a native mobile application.
Websites of the plugin for more information or manual installation: http://wordpress.org/plugins/simple-custom-css/ or http://johnregan3.github.io/simple-custom-css/ 

#### Internal ####

##### Exhibition Printer #####
This plugin makes possible for printing favorite pages using Google Cloud Printing service. It also attaches a cover and a table of content page to the favorite pages.
For more information and downloading the plugin use the following website:
//TODO GITHUB PAGE

##### WP Favorite Posts (Version 1.6.1) #####
This plugin makes possible to put posts on a favorite list assigned to the user. We will extend this plugin with some functionality later, so no guarantee our modifications will work with the later versions.
//TODO GITHUB PAGE

### Theme ###
The theme is based on the [Hueman][3] responsive theme with slight modifications for enabling some functionality. The modifications are described in the Modification of themes section. To download and install the theme navigate to the website:
//TODO GITHUB PAGE


### Other files to deploy ###
Upload/Copy the following files in the wordpress site’s `./wp-content/plugins` directory:

 - wp-members-pluggable.php //TODO GITHUB link
 - [simple_html_dom.php][4]

### Settings ###
If you follow the steps below you can get the same result as the uploaded version of the Exhibition app on GitHub. The crucial/required settings are bold.
#### 1. Theme settings/Appearance ####

 - In Widgets empty primary and secondary widgets
 - Create a menu with your pages and post, optionally turn on the auto add pages option. **ONLY use Topbar location**
 - Custom CSS, we used the following rules to hide DOM elements:
```
#nav-topbar {
  display:none;
}

#header {
  height:0px;
}

.comment-form-author,
.comment-form-email,
.comment-form-url {
    display:none;
}

```

* Theme Options (for Hueman template): 
  * General tab: **Responsive on**, Hide both sidebars, Page comments off
  * Blog tab: Fill heading, subheading. Include featured post FALSE, Comment count OFF, shows post author description OFF, DISABLE randomized related articles, DISABLE single-post navigation.
  * Header tab: No logo, site description OFF
  * Footer tab: DISABLE footer widget, no footer logo, keep footer credit ON
  * Layout tab: 1 box layout, NO is_home, NO is_single, NO Archive, NO Archive-Category, NO Search, NO Error 404, NO Default Page
  * Sidebars tab: Make everything empty
  * Styling tab: **Dynamic styles ON**, **Boxed layout ON**, Tittillium Web, Latin font, Sidebar 280px+200px, set colors to your needs.

#### 2. Settings ####
* General tab: Fill up the titles and taglines. 
* Reading tab: Front page display – set this accordingly your needs, however it is advised to create a welcome page and set statically to that. Full text shown.
* Discussion tab:  
![discussion_settings](https://cloud.githubusercontent.com/assets/7116322/2579016/bd09dcd6-b99b-11e3-93f7-7f64c7dae533.png)

#### 3. WP Favorite Posts ####
*   **Only registered users can favorite: NO**
*   **Before Link Image: No Image**
*	**Text for add link: `<i class="fa fa-heart-o"></i>`** (Or other icon: http://fortawesome.github.io/Font-Awesome/icons/) 
*	**Show remove link: TRUE**
*	**Text for remove link: `<i class="fa fa-heart"></i>`** (Or other icon: http://fortawesome.github.io/Font-Awesome/icons/)
*	**Text for clear link and cleared: EMPTY**
*	**Text for [remove] link: `<i class="fa fa-trash-o"></i>`** (Or other icon: http://fortawesome.github.io/Font-Awesome/icons/)
*	**Don't load js file and Don't load css file: FALSE**

#### 4. Email ####
Here set up your SMTP server parameters.
#### 5. WP-Members ####
##### WP-Members Options tab #####
![wp_members_options](https://cloud.githubusercontent.com/assets/7116322/2579019/bd28b156-b99b-11e3-8c00-67e1c6db426f.png)
##### Fields tab #####
![wp_members_fields](https://cloud.githubusercontent.com/assets/7116322/2579018/bd282e66-b99b-11e3-91e4-8bbbce094ecf.png)
##### Emails tab #####
![wp_members_emails](https://cloud.githubusercontent.com/assets/7116322/2579017/bd2708c4-b99b-11e3-9f22-454295367605.png)

----------


## Programmer documentation ##
### External plugin modifications and extensions ###
### Exhibition Printer plugin ###
### Modification of themes ###


----------


## System administrator documentation ##


----------


## User documentation ##


  [1]: https://www.digitalocean.com/community/articles/how-to-install-linux-apache-mysql-php-lamp-stack-on-ubuntu "LAMP installation + CURL for PHP"
  [2]: https://www.digitalocean.com/community/articles/how-to-install-wordpress-on-ubuntu-12-04
  [3]: http://wordpress.org/themes/hueman
  [4]: http://simplehtmldom.sourceforge.net/
