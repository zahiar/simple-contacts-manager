# Simple Contacts Manager

This application will store simple user details such as first name, surname and job title in a local file on disk.

## Installation

To install this application you can either use Vagrant (a vagrant file has been provided) or do a custom setup of your own.

### Using Vagrant with VirtualBox
First you will need to install both Vagrant and VirtualBox, if you don't already have them.

A vagrant file has been provided which will setup a pre-configured environment designed to get you up and running as
quickly as possible.

1. cd into the vagrant directory
2. Run this command (note: this may take some time)
   > vagrant up
3. Once the vagrant box is up and running now add the following line to your hosts file
   > 192.168.56.99 dev.za

   If you need to change the IP address then simply edit file: *Vagrantfile* and re-run step 2.
4. The application should be up and running now, so you should be able to access it from:
    <http://dev.za>

#### Running PHPUnit
PHPUnit 4.8 is installed and can be run from the command-line like so:
> phpunit

Tests are stored in */var/www/za/tests* and can be run like so:
> cd /var/www/za/tests

> phpunit model/PersonTest.php

### Custom Installation
You will need a LAMP stack with the following requirements:
PHP 5.5
PHPUnit 4.8

The application sourcecode lies in the *src* folder so copy that to your server, and setup any necessary
VHOSTS (adding any required entries to your hosts file, if necessary).
