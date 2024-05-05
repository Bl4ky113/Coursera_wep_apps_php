# Web Applications with PHP
# Michigan University - Coursera

Start: 04/25/24
End: 

Sessions:
- 04/25/24

## Why PHP
A good bunch of web apps are made with it, so we can make more of them and give support to old apps.

## Tools
Apache server: Simple web server made with C
PHP: web scripting language
SQL: standard Structured Query Language to comunicate with the DBs
Javascript: web dynamic scripting language
jQuery: JS protability layer from the old web days where each browser used a different JS implementation

Up to this point, the course has been HTML, Basic web protocols and easy stuff, soo 
:p

## INSTALL

Real notes are now being taken. 

So in windows and mac, the install process explained is just install an Apache server handler and something to run php.
Couldn't be more easy.

But in linux, we can use something called LAMP, similar to XAMPP or MAMP. But I don't want to install that thing,
I will just set up the apache server by myself, add the php plugins and later on add the mariadb, because I'm not using Mysql, to the project and server.

Ok for now, I'VE SUCCESFULLY MADE A APACHE SERVER WITH PHP :D. First, I needed apache, php and the php-apache module installed in my system, available on the arch repo.
Now I just changed the config to point to the apache server in this folder, so I can change the contents without always going to the root apache server folder.

Changing the variables:
ServerRoot "$serverPath"
DocumentRoot "$serverPath"
\<Directory "$serverPath"\>...\</Directory\>

And also we should use my user and group, changing:
User $user
Group $userGroup

Now we add the Php modules, in the list of LoadModule at the end we add:
LoadModule php\_module modules/libphp.so
\<IfModule php\_module\>
	AddHandler php-script .php
\</IfModule\>

Now, we might need a custom php.ini file for out project. We can add it with:
PHPIniDir "$dir\_with\_php.ini"
We might add it after the LoadModule directive, but I'm adding it in the ./extra/php\_module.conf file

uncomment:
LoadModule mpm\_prefork\_module modules/mod\_mpm\_prefork.so

comment:
#LoadModule mpm\_event\_module modules/mod\_mpm\_event.so

So they don't make a conflict, Php uses prefork but can be changed for other module

We also add in the Include List, at the end of it:
Include conf/extra/php\_module.conf

But wait, our server needs to find the modules and config. Since I don't want to create a full copy of all of them
I'm going to use system links with:

$ ln -s /path/to/modules modules 
and the same thing to conf dir

both in the root of our server, otherwise, see where each module is being loaded, configured and such, so you can change it (dumbass)

Now we can use the php server!
