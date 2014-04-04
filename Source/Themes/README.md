# Hueman template modified #
## About ##
This template offers a fully responsive, good looking, usable template. A lot of settings can be modified comfortably from the admin panel.

Original version and all the credits and all the merit should go to [Alexander Agnarson][1]. You can find the original project on the [wordpress site][2] or on the [developers website][3]

### Modification of the theme ###
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

## Installation ##
### Wordpress themes manager ###

 - **Download** the zipped package of the **[hueman-modified.zip][4]** template.
 - Then go to your Wordpress admin section and navigate **Appearance > Themes > Add New**
 - On the **Upload tab** select the downloaded zip file and press **Install Now**
 - **Activate** it

### Manual ###

 - Download **[hueman-modified.zip][4]** plugin to your webserver
 - **Extract** it on your webserver to the folder **`/wp-content/themes/`**
 - Go on the admin side of the Wordpress, you should see the plugin in the plugin list. **Activate** it.

## License ##
According to the original project, the modified version of Hueman template is also under GNU GPL v3 license. Further information can be read in the hueman [subfolder](./hueman/license.txt).

  [1]: http://alxmedia.se/
  [2]: https://wordpress.org/themes/hueman
  [3]: http://alxmedia.se/themes/hueman/
  [4]: ./hueman-modified.zip