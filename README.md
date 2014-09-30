cicada
======

### Welcome Cicada.

Track your household expenses with this user-friendly and ridiculously-easy-to-use web application. Version 0.1 will be ready soon, with basic functionality and almost no critical bugs.

For suggestions, ideas, comments etc, contact @karate and @godfath3r.

### How to use it

- Download and set-up the latest 2.x version of cakephp which is 2.5.4
- Go to cake-php folder and pull cicada:

```
$ cd /var/www/<cakephp-folder>
$ rm -r app/
$ git clone https://github.com/karate/cicada.git app
```
- Then you have to setup your sql, make a new db named cicada and import database.sql
file located in app/ folder.

(Note: You have to give privileges to your user for using cicada db, and then put those credentials into app/Config/database.php. For more information consult cakephp documentation)

## Development

The development process of Cicada happens mainly through github. Feel free to fill an issue when something unexpected happens and/or fix it. You are more than welcome for pull request and suggestions.
