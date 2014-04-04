# WP favorite posts modified #
## About ##
This plugin makes possible to put posts on a favorite list assigned to the user. We will extend this plugin with some functionality later, so no guarantee our modifications will work with the later versions.

Original version and all the credits and all the merit should go to [Huseyin Berberoglu][1]. You can find the original project on the [wordpress site][2] or on the [developers website][3]

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

## Installation ##
### Wordpress plugin manager ###

 - **Download** the zipped package of the **[wp-favorite-posts_modified.zip][4]** plugin.
 - Then go to your Wordpress admin section and navigate **Plugins > Add New**
 - On the **Upload tab** select the downloaded zip file and press **Install Now**
 - **Activate** it

### Manual ###

 - Download **[wp-favorite-posts_modified.zip][4]** plugin to your webserver
 - **Extract** it on your webserver to the folder **`/wp-content/plugins/`**
 - Go on the admin side of the Wordpress, you should see the plugin in the plugin list. **Activate** it.

## License ##
According to the original project, the modified version of the WP favorite posts plugin is also under GNU GPL v3 license. Further information can be read in the [license file](./license.txt).

  [1]: http://nxsn.com/
  [2]: https://wordpress.org/plugins/wp-favorite-posts/
  [3]: http://nxsn.com/projects/wp-favorite-posts/
  [4]: ./wp-favorite-posts_modified.zip