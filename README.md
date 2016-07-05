# WP Version
 A virtual machine for testing WordPress in different environments.
 
## What's in it?
Nginx and Apache web servers alongside php fpm.

### Operating System
* Ubuntu 14.04.4 LTS (Trusty Tahr)

### Web Server
* apache 2.4.7
* nginx 1.4.7

### PHP
* phpbrew (see https://github.com/phpbrew/phpbrew for documentation and options). PHP versions are compiled with `+default+fpm+mysql+gd+openssl=shared -- --with-openssl-dir=/usr/include/openssl` 
 * ~~PHP 5.2.4 (simply was not able to build it on this system)~~
 * PHP 5.2.17
 * PHP 5.3.29
 * PHP 5.4.45
 * PHP 5.5.37
 * PHP 5.6.23
 
* PHP 7.0.8-3
 
* git
* WP CLI (https://wp-cli.org/) 

## Usage 
At the moment it is a very manual task to change the environment. For a future release changing environments will be simplified.

### Web Server
Make sure to stop the currently running server. Either check with `sudo netstat -tulpn | grep --color :80` which server is running or stop them both `sudo service apache2 stop && sudo service nginx stop` and then start the one you want to use 

```
sudo service nginx start
```

or

```
sudo service apache2 start
```

### PHP
The above PHP versions come bundled and you can change between them using 

```
phpbrew fpm stop && phpbrew use X.X.XX && phpbrew fpm start
```

(e.g. `phpbrew fpm stop && phpbrew use 5.3.29 && phpbrew fpm start`). 

You are not limited to these versions however and can compile new versions easily. First find the version you want to be using with 

```
phpbrew known --more
```

and compile it with

```
phpbrew install X.X.XX +default+fpm+mysql+gd+openssl=shared -- --with-openssl-dir=/usr/include/openssl
```

If you encounter errors during compile, missing packages etc. check http://jcutrer.com/howto/linux/how-to-compile-php7-on-ubuntu-14-04 or http://crybit.com/20-common-php-compilation-errors-and-fix-unix/ for common errors and their fixes (or simply google the error message).

After succesful compilation change the address on which to accept FastCGI requests in the respective `php-fpm.conf`, e.g. `~/.phpbrew/php/php-5.3.29/etc/php-fpm.conf`, form socket to localhost port 9000 (to allow fast switching of php versions):


```
// remove or comment this line
; listen = /home/vagrant/.phpbrew/php/php-5.3.29/var/run/php-fpm.sock
// add this line
listen =  127.0.0.1:9000
```

**Note**

This has already been done for the preinstalled PHP versions.

// TODO: Add global config, i.e. https://github.com/phpbrew/phpbrew/wiki/Setting-up-Configuration

### Composer Packages

Check out the documentation for each tool and the usage examples, if you don't know how to use them:

**Adding Languages**

Search on https://wp-languages.github.io/ for the language package you want to install, e.g.:
 
```
"koodimonni-language/core-de_de": "4.5.3",
"koodimonni-language/core-de_de_formal": "4.5.3"
```

**Adding Plugins and Themes**
Search on https://wpackagist.org/ for the plugin or theme you want to install and add it like this:

```
"wpackagist-plugin/user-switching": "1.0.9"
```

or 

```
"wpackagist-theme/twentysixteen": "1.2"
```

### WordPress

Change the WordPress version in `composer.json` and run `composer update`

## Without Composer
If you do not want to use composer, run the following to obtain WordPress: 

```
mkdir /var/www/wp-version/web/wordpress; cd /var/www/wp-version/web/wordpress
git init && git remote add origin git@github.com:WordPress/WordPress.git
git fetch origin master --tags
```

and then checkout your preferred version with `git checkout tags/X.X.X`, e.g.

```
git checkout tags/4.5.3
```

You can also add plugins and themes via the backend or your local file system (shared folder).
## Notes

### PHP 5.2.x
If you change to PHP 5.2.x and want to go back to another version you'll have to turn `phpbrew off` first before running another command with `phpbrew` as phpbrew requires 5.3. When turning `phpbrew off` the bundled PHP version is in use (PHP 7.0.3), e.g.

```
phpbrew fpm stop && phpbrew off
phpbrew use php-5.6.23 && phpbrew fpm start
```

**PHP 5.2.17 only works with nginx at the moment.**

Composer requires PHP 5.3.2+ so make sure to install the required packages before changing to PHP 5.2.X.
### Themes
If you checkout an older version of WordPress you might want to activate the default theme that came with that version as well. Otherwise there might be some `Undefined Function` errors on the page. See the following for a list and pick the theme that is nearest to the release you are checking out:

Twenty Ten &ndash; Version 3.0
Twenty Eleven &ndash; Version 3.2
Twenty Twelve &ndash; Version 3.5
Twenty Thirteen &ndash; Version 3.6
Twenty Fourteen &ndash; Version 3.8
Twenty Fifteen &ndash; Version 4.1
Twenty Sixteen &ndash; Version 4.4

**The latest version of the theme is not necessarily compatible to the WordPress version it original shipped with, (e.g. WordPress 3.8 and TwentyFourteen 1.7). If you happen to see `undefined function` errors you might want to get an older version of the theme.**

### Server Logs
The server logs (error and access log) are located in `/var/www/wp-version/log`.

