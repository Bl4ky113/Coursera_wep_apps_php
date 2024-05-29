# Web Applications with PHP
# Michigan University - Coursera

Start: 04/25/24
End: 

Sessions:
- 04/25/24
- ...
- 05/10/24
- 05/21/24 A hell of a month, isn't it?
- ...
- 05/28/24

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
and the same thing to conf dir.
Both in the root of our server, otherwise, see where each module is being loaded, configured and such, so you can change it (dumbass)

Now we can use the php server!

## PHP

Inpired from C, perl, Java, and such.

### Php Phylosophy 
- You are a responsible and intelligent programmer
- You know what you want to do
- Some flexibility on syntax is OK, style choices are OK
- Let's make this as convinient as posible
- Sometimes errors fail silently

Although you mainly use php for web apps, you can also use it for a CLI enviroment.

### Variables 
Variables start with

$foo = val;

Be care full, if you can make some serius mistakes if you declare or use variables without the $ sign.

### Strings
Strings are made with '' or "" but there's a difference, can have multiple lines with 'newline', and \\ is used as escape.
Yo concatenate strings with . not +.

"" strings you can use variables inside of them, and you can use special caracters like \\n or \\t.
With '' strings, it's just a normal constant, non-special, string.

### Comments
Comments can be made with
// this
/* this */
\# and this

### IO
Output can be made with echo, which is a 'language construct' whatever that means. But print is also avialable,
both can be used with or without parentheses. 
echo $foo; // language construct
echo($foo); // function like
print $foo;
print($foo);

echo can take more than 1 parameter in language construct mode, but print in either form can only take one.

### Expressions
Depends on the context but generally have agressive implicit type conversion, so be careful.

$foo = "15" + 15;
echo $foo; -> 30

Every line should end in a ;

###  Operators
- increment ++ --
- str concatenation .
- Equality == != \<= \>= \< \>
- logical && || !
- Identity === !==
- Ternary ? :
- Side asignment += -= .= \*= /=
- bitwise >> << ^ | &

### Casting / Convertion
Generally with mathematical operations, every single element present will become numbers, either int or double.
But the same goes for, specially '.' operator, for the other ones.
You can also use the general C casting with (type) before the value that you need to cast.

$foo = (int) 9.9;

Be careful, TRUE casts into a 1. But FALSE casts into a "" in strings logic.

### Identity vs Equality operators
They behave like the is and is not operators in Python, but I wouldn't know if they work like the === operator in ECMAScript9>

### Control structures
if {} else {} is pretty straight forward. 
There's a elseif.
You can write online if () else () without braces but an ; in the end.

while is pretty normal. do-while exists, ew.
Normal C for loop style. The only new thing is the $ in the variables.

### Arrays
$foo = array("bar", "foo", "fee");
echo $foo[0];

### Maps
$foo = array(
    "key" => "foo",
    "key2" => "foo2"
)
echo $foo["key"];

With nested arrays and maps, just declare that one of it's values is an array or a map.
Some array functions are Functional-Programming style, not OOP methods. Theese are just the normal 
functions that you would expect, although there's some maps with key related functionality variants.

## $\_GET, $\_POST, $\_SESSION

Theese special variables are a way to handle the http requests. Mainly web ones. By their names you can guess what's their propourse.
They also are maps, so in order to get anything you have to use a key.

## Functions

Just like the general C stuff, just the $ sign for paramters. But there's a way to get paramters by reference, like in C++. 
By adding a & before the paramter -> &$param\_by\_ref.

## Var scope

Generally variables are only available as somewhat global, in the root of the file, but theese are not available in function scopes.

You can add a global keyword before defining, but not setting, a variable. This will only work on variables that were defined outside 
the current scope and, of course, affect them. So better be careful of chaching the code with this stuff.

$bar = 0;

function foo () {
    global $bar;
    $bar = 100;
}

## Include and Require

Both are ways to link and use php files inside php files.
Include will retrieve the file and add it to the HTML or the general context.
Require will retrieve the fille and do the same, but if the file isn't available, it'll die and destroy everything.

There's \_once for each function, so if the file was already included or required, or just added, then it wont, since it only has to do it once.

## Zrok and NGrok

Nwo we have to install a firewall bypasseer so the autograder can evaluate our work. 
But there's a problem. NGrok is a propetary software tool, and that sucks. 
So I'm going to use Zrok, which does the same thing, it shares files, ports or anything publicly 
by a temporal url in their dns.

## HTML Forms and PHP

We know that $\_GET exists and others as well, we can use them to handle and use requests. 
Theese are just made from general html forms and that's about it.

Just define the name of the input, create a submit btn and define in the form with action, or script, will follow and which method should it use.

God damnit, now we are going to have to eat a whole 'html inputs' module

Now something useful is the htmlentities function, which will help us avoid getting an HTML Injection in our forms, that if we need or have 
to display in HTML some kind of user input.

## MVC

Model View and Controller is a way that we can split how we work and design our code structure.
Specially dividing the handling of requests, data, dbs and other stuff with the display of the data in 
the html part.

Generally you would separate theese structures with different code files with different names or directories.
But in this course we are just going to have the model on the top of the file, the view right after it, and the 
controller would just be the general php file.
