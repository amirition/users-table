# Inpsyde Users Table
This plugin shows a table of users from jsonplaceholder API. If you click on user information on the table, you can see a list of books' titles.
## Installation
Download the last stable version and go to your WordPress admin >> Plugins >> add new and select the newly downloaded zip file. After that, you can actiavte the plugin.

After installation, you can see this URL: http://your-website.com/inpsyde-users-table/
## Caching
Every API response is stored for one day on the page. You can change this number which is in seconds.
## Available Hooks
List of available actions:

- ait_before_users_table
- ait_after_users_table
- ait_before_users_table_sidebar
- ait_after_users_table_sidebar

List of available filters:

- ait_user_detail_url
- ait_users_table_url

## Development
Download the last stable version. In terminal, navigate to the plugin folder and run "composer install". Happy coding! That's all you need! 

# License 
This plugin is licensed under MIT License