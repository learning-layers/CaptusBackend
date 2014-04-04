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
Websites of the plugin for more information or a manual installation: https://wordpress.org/plugins/wp-members/ or http://rocketgeek.com/plugins/wp-members/

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
[Exhibition Printer readme](Source/Plugins/exhibition_printer/README.md)

##### WP Favorite Posts (Version 1.6.1) #####
This plugin makes possible to put posts on a favorite list assigned to the user. We will extend this plugin with some functionality later, so no guarantee our modifications will work with the later versions.
[Modified WP Favorite Posts readme](Source/Plugins/wp-favorite-posts/README.md)

### Theme ###
The theme is based on the [Hueman][3] responsive theme with slight modifications for enabling some functionality. The modifications are described in the Modification of themes section. To download and install the theme navigate to the website:
[Modified Hueman theme readme](Source/Themes/README.md)


### Other files to deploy ###
Upload/Copy the following files in the wordpress site’s `./wp-content/plugins` directory:

 - [wp-members-pluggable.php](Source/Files/wp-members-pluggable.php)
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
.wpfp-span ul {
	display: table;
	border-spacing: 20px;
	border-collapse: 
}

.wpfp-span ul li {
	display: table-row;
}

.wpfp-span ul li a {
	display: table-cell;
}

#wpmem_reg {
	margin: 0 0 15px 30px;
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
### Modification of WP Favorite Post plugin ###
With the modification of this plugin we aimed to extend the original plugin with some functionality, make cooperation with the WP-Members plugin in order to support our use-cases. Two use-case are related with the modified version of the WP Favorite Post plugins:

1. Once a user registers to the site, in the e-mail the list of favorites should be also included.
 
2. Once a user logs in the plugin should detect it and persist the cookies in the database assigning to our user.
 
Let's see how we extended the original plugin:
##### Persist at login #####
We created a new function in the end of the wp_favorite-posts.php file. The action is called `exhib_persist_cookies()` and it is called if the `wp hook` is called. In the `exhib_persist_cookies()` we check if the user logged and there are favorites stored in cookies by calling the original plugins `wpfp_get_cookie()` method. 
If these conditions hold then we iterate through all of the cookies and do two things:
1. Check if it is already in the database by calling `wpfp_check_favorited($post_id)`. If not then we immediately add it by calling `wpfp_add_to_usermeta($post_id)`.
2. Delete the cookie by calling `wpfp_set_cookie()`

##### Include favorites in registration mail #####
We created a new function `add_favorite_posts_to_reg_mail($email_content)` which subscribe on the `wpmem_email_newreg` hook. There for it is called by the WP-Members plugin just before a registration mail is sent. The idea is to create a list of links and show the post titles, which we can generate based on iterating over all of the cookies returned by `wpfp_get_cookie()` and attach the link for each favorite post to the `$favorite_links` variable. 
After that we can inject it in the e-mail content, so we introduced a wildcard shortcut `[**wp-favorite-posts**]`, which can be used in the WP-Members admin panel and replaced with the content of the `$favorite_links` variable.

### Modification of themes ###
These modifications aimed to achieve two basic goals regarding the layout:
#### Add new toggle buttons to the header ####
For supporting not only native app, but also a responsive, fully usable web view we wanted to add two more toggable region to the header: A region for JavaScript based QR-code scanning and a region for login/logout. Therefor we had to modify the following files:

 - header.php: In the `container-inner` div we introduced a `login` and a `toggle-qr` div to show the toggle button and the `login-expand` and `scanner` as their toggable region.
 
 - scripts.js: We added the functionality to div buttons above to be toggable. When a button is toggled it toggles out all the others.
 
 - style.css: We created the stlying and positioning rules for our new divs. Also we extended the IE (8) fixes to be available for our newly introduced divs.
 
 - responsive.css: We introduced stlying rules how the buttons should look like and positiond in the smaller, typically mobile, displays.

#### Modify the post layout to contain "favorite button" ####
To achieve this requirement and also to get the desired style of the page we modified the `single.php` file according the following steps.

 - To avoid showing the page title we commented out the following command: `get_template_part('inc/page-title')`
 
 - To avoid showing the author line we commented out the whole tag of `<p class="post-byline">`
 
 - To show the favorite button we introduced a new span block in the `post-inner group` class, which calls `wpfp_link()` method to render the button.

### Exhibition Printer plugin ###
This plugin is designed to make it possible to create a printout of the user favorite posts and print it using the Google Cloud service. The printout contains a customizable cover page, a customizable table of contents page and following these the pages of the posts on the users favorite list. 

In a post or page a print button can be rendered by using the `[ex_print_button]` shortcode, which calls the function of `sButton`, which will render the HTML code of the button.

When this button is pressed it sends a POST message, where `doprint = true`, therefor the `exhib_print()` function, which hooks the init action, will be called. This method will arrange the printing tasks: Includes the cover and table of contents page and schedule the favorites by iterating over the result of the `wpfp_get_users_favorites()` function. 

Then it prints the printing tasks out by calling `print_with_google($data_to_print)`. This will connect the Google account using the predefined credentials, choose one printer based on the value of the `$printerid` variable and prints it out. For printing it uses an adapter to the Google Cloud service, stored in the [GoogleCloudPrint.php][5]. The printing could return with the following results:
  - No printers
  - Printing failed
  - Login failed
  - Unexpected

Cover page is a standard HTML/PHP page, which can be customized in any way depending on your needs. Without any modification, you can use the `$_GET["name"]` for personalizing the cover page. The value would be the display name of the current user, if he/she was logged in.

Table of contents page is also a standard HTML/PHP page, which also can be customized to your needs. The `$_GET["name"]` can be used also, moreover there is a semicolon separated list in the `$_GET["content"]`.

### WP-Members pluggable extension ###

The file [wp-members-pluggable.php](Source/Files/wp-members-pluggable.php) contains a solution for many requirements to extend the functionality of the WP-Members plugin:

 - Make possible to register by using only the email address (look at [this site][6] to get more info how it works)
 
 - Auto login directly after registration (look at function `autologin_after_registration($fields)`
 
 - Hide admin bar in the pages: `add_filter('show_admin_bar', '__return_false');` 
 
 - Modifing messages of login, registration forms
 
[simple_html_dom.php][4] is required for the work.

----------


## System administrator documentation ##
This section of the documentation is written for those people who has to manage the content, customize it to the current needs and generally has a basic knowledge about how to use, manage the Wordpress CMS.
### Posts - Exhibition items ###
The idea behind using Wordpress is to provide an easy way to manage a content of an exhibiton by reusing the general concept of the Wordpress ecosystem. One of these concept pairing is the reuse of posts: In our application the information we want to provide about an exhibition item is recorded in a post. That means that if we create a post it will be (at default settings) immediately "likeable", commentable and they can be organized in categories based on different aspects of the exhibition items.

All in all: Create a post if you want to provide information about an exhibiton item, assign it to categories and publish.
### Pages - Static pages ###
Pages are the static content of an exhibition: This means those parts which the visitors typically just read, but no interaction is needed. For example a Welcome page or a page for describing the history of the exhibition should be created in the system as a page.

There are an other set of pages, which provides functionality for the user by holding shortcuts and absolutely **adviced to create** them: **Favorite page, Login page**

### Usable shortcuts ###
These shortcuts can be used in any post and page, just simply insert somewhere in the content the shortcut form: [something]
#### [wp-favorite-posts] ####
This shortcut will render a list of the users favorite posts. It also renders delete button for each favorite post and shows it in a table like format.

**Advised to use it in a Favorite page**
#### [ex_print_button] ####
Renders a button for printing via the Google Cloud Service a customized printout containing a cover and table of contents page and the users favorite posts.

**It is also advised to put this shortcut on a Favorite page**, because therefor the user can see in advance what will be printed.
#### [wp-members page="register"] ####
Renders a WP-Members register form, which (by default) contains only an e-mail input box and a register button.
#### [wp-members page="login"] ####
Renders a WP-Members login form, which (by default) contains an username and a password field as well as a login button.
### Header menu ###
At the Appearance > Menus you can create a menus, which will be shown in the top header. You can insert here your static pages, your categories in a multi-level menu.
It is suggested to keep the number of menu elements lower, this is making the navigation in mobile devices more comfortable.
### Emails customization ###
In the Settings>WP-Members>Emails tab you can edit the content of the mails sent by WP-Members as a response of different user actions like registration or password reset.

In the registration letter you can use a special shortcode: **[\**wp-favorite-posts\**]**
This will render you a list of the registered user favorite post and their links in the place, where you used the shortcode.
### Printing customization ###
If you use [ex_print_button] shortcut, you can print the users favorites with a cover page and a table of contents page.
Therefor it is desirable to customize them. To achieve this you need to know some HTML/PHP, but it is not that hard.
You can edit them in the Plugins>Editor>Select Exhibition Printer> Select cover.php or tableofcontents.php.
In cover.php a `name` parameter in the `GET` list will be passed containing the user name. Morover in the tableofcontents.php the list of the content will be passed in a semicolon separated list under the `content GET` parameter

Modify and customize your page to meet your needs.

## LICENSE ##
For the license of the different components check the LICENSE file in the root of the repository.

  [1]: https://www.digitalocean.com/community/articles/how-to-install-linux-apache-mysql-php-lamp-stack-on-ubuntu "LAMP installation + CURL for PHP"
  [2]: https://www.digitalocean.com/community/articles/how-to-install-wordpress-on-ubuntu-12-04
  [3]: http://wordpress.org/themes/hueman
  [4]: http://simplehtmldom.sourceforge.net/
  [5]: https://github.com/yasirsiddiqui/php-google-cloud-print
  [6]: http://www.wilycode.com/allow-email-as-username-within-wp-members-plugin/
