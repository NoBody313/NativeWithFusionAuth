# PHP Legacy App

This repository contains a PHP legacy application with home rolled authentication. It's not very secure, any account with a password of 'password' is logged in.

Read the corresponding blog posts:

* https://fusionauth.io/blog/2020/10/07/updating-crufty-php-application/
* https://fusionauth.io/blog/2020/10/14/how-to-migrate-user-data-centralized-auth-system/

### Prerequisites

* A modern PHP
* FusionAuth installed and setup. See https://fusionauth.io/docs/v1/tech/5-minute-setup-guide (do the first six steps). 
  * Set the callback url to be `http://localhost:8000/oauth-callback.php`.
* This repo

### Connector license

Note that Connectors are a feature available to FusionAuth installations with a paid edition. You can [sign up for a 14 day free trial](https://fusionauth.io/pricing) of the "Developer" Edition to test this functionality out.

### Setup

* Clone this repo and `cd` into it.
* Run `composer install`.
* Update the values in `config.php`.
* Configure a Connector. 
  * Set the authentication URL to be `http://localhost:8000/fusionauthconnector.php` (for production, please use TLS).
  * Set the header value of `Authorization` to `supersecretauthheader` or whatever authorization header you set in `config.php`.
* Associate it with your tenant. Make sure you check the `Migrate User` checkbox.
* Start a webserver: `php -S 0.0.0.0:8000` . This should not be used for production.

### To use

* Go to `http://localhost:8000` and login. 
* Users will who successfully authenticate will be migrated from the legacy application to FusionAuth.
* If you reset a FusionAuth user's password (using the administrative user interface) to `password2`, that's what you'll have to use to login.
