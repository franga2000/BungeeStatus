BungeeStatus
============

BungeeStatus is a PHP powered website that allows server owners with PHP-capable web server to show their players which of their servers are online, how many players are there on each and if they are down, why.


##Installation:

* Upload to your webserver
* Change the settings in config.php
* Add your servers to servers.json
* Check your servers.json file using a json parser (http://www.jsoneditoronline.org)

###CONFIGURATION:
config.php:
```php
    'password' =>       'CHANGE-THIS', //The password used to access the admin page
    'columns' =>        2, //The number of columns of serverson the main page
    'player_columns'=>  2, //The number of columns of playerson the server page
    'nojava' =>         false, //Switch to the old loading system
    'toolbar' =>        "top" //Location of the toolbar
```
servers.json:
```json
{
  "servers": [
    {
      "Name": "Server display name",
      "Adress": "Server adress",
      "Port": "Server QUERY port",
      "Description": "Description (optional)",
      "Offline_reason": "Reason shown when the server is offline (optional)"
    },
    {
      "Name": "Hub",
      "Adress": "127.0.0.1",
      "Port": 25570,
      "Description": "The server used for passing between servers"
    }
  ]
}
```
**Everything except the port MUST HAVE QUOTES!**

**Each item inside brackets ([] or {}) except the last one has to be folowed by a comma (,)!**

##Credits:

* Most of everything: franga2000 (http://franga2000.com)
* Minecraft Query Script: xPaw (https://github.com/xPaw/PHP-Minecraft-Query)
* Json Fancify Script: Dave Perrett (http://www.daveperrett.com/articles/2008/03/11/format-json-with-php/)

##License:

GNU GPL v2 ([License included in repo](LICENSE))
