# Exhibition Printer plugin #
## About ##
This plugin is designed to make possible to create a printout of the user favorite posts and print it using the Google Cloud service. The printout contains a customizable cover page, a customizable table of contents page and following these the pages of the posts on the users favorite list. 

In a post or page a print button can be rendered by using the `[ex_print_button]` shortcode, which calls the function of `sButton`, which will render the HTML code of the button.

When this button is pressed it sends a POST message, where `doprint = true`, therefor the `exhib_print()` function, which hooks the init action, will be called. This method will arrange the printing tasks: Includes the cover and table of contents page and schedule the favorites by iterating over the result of the `wpfp_get_users_favorites()` function. 

Then it prints the printing tasks out by calling `print_with_google($data_to_print)`. This will connect the Google account using the predefined credentials, choose one printer based on the value of the `$printerid` variable and prints it out. For printing it uses an adapter to the Google Cloud service, stored in the [GoogleCloudPrint.php][5]. The printing could return with the following results:
  - No printers
  - Printing failed
  - Login failed
  - Unexpected

Cover page is a standard HTML/PHP page, which can be customized in any way depending on your needs. Without any modification, you can use the `$_GET["name"]` for personalizing the cover page. The value would be the display name of the current user, if he/she was logged in.

Table of contents page is also a standard HTML/PHP page, which also can be customized to your needs. The `$_GET["name"]` can be used also, moreover there is a semicolon separated list in the `$_GET["content"]`.

## Installation ##
### Wordpress plugin manager ###

 - **Download** the zipped package of the **[exhibition_printer.zip][1]** plugin.
 - Then go to your Wordpress admin section and navigate **Plugins > Add New**
 - On the **Upload tab** select the downloaded zip file and press **Install Now**
 - **Activate** it

### Manual ###

 - Download **[exhibition_printer.zip][1]** plugin to your webserver
 - **Extract** it on your webserver to the folder **`/wp-content/plugins/`**
 - Go on the admin side of the Wordpress, you should see the plugin in the plugin list. **Activate** it.

## License ##
This project, excepth GoogleCloudPrint.php is under Apache v2 license. The GoogleCloudPrint is according to the original regulation under GNU GPL v3. Further information about the Apache v2 checl the [LICENSE file](./LICENSE).

  [1]: ../exhibition_printer.zip
