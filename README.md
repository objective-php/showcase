# Objective PHP / Showcase

## Project topic

This project provides a "fully" functionnal application based on Objective PHP Framework. It mainly contains components demos.

This is the place to start until we provide an actual documentation.

## How to make it work

A few simple steps are needed to get this application up and running:

```
git clone https://github.com/objective-php/showcase
cd showcase

# the next step assumes that composer is available in your PATH
composer install
php -S 0.0.0.0:8001 -t public 
```

You can then open http://localhost:8001 to access live demo of Objective PHP Framework. Note that the frmaework will show itself much more efficient when using a production grade web server (as Apache or Nginx), while the PHP built-in server will allow you to make the demo running within seconds.

## Add support for Doctrine demos

If you want to be able to run the Doctrine related demos, you'll need a copy of our DB (which is largely based on [http://dev.mysql.com/doc/employee/en/employees-introduction.html](MySQL "employees") database).

You can download our copy of this database from [http://objective-php.org/employees.sql.gz](objective-php.org).

After importing the "employees" (default name) database, you can either create a "demo" user with no password and access to "employees" database, or alter the default configuration located in "app/config/doctrine.php":

```
    $dbConfig->user          = 'demo'; // update user name here
    $dbConfig->password      = ''; // and password here
```


