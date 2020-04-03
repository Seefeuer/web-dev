# Seefeuer Web Dev

Virtual web development server


## Requirements

You will need to have installed:

- [vagrant](https://www.vagrantup.com/)
- [git](https://git-scm.com/download/win)

## Installation

Using Linux, open a terminal in this folder and run:
````
sudo vagrant up
````
Using Windows and being and administrative user, open a terminal and run:
````
vagrant up
````
Afterwards, you can enter the virtual server and inspect the exchange folder
````
vagrant ssh
cd /vagrant
ls -la
```` 

## Stop virtual server
Using Linux, open a terminal in this folder and run:
````
sudo vagrant halt
````
Using Windows and being and administrative user, open a terminal and run:
````
vagrant halt
````

## Start after reboot
Using Linux, open a terminal in this folder and run:
````
sudo vagrant up
````
Using Windows and being and administrative user, open a terminal and run:
````
vagrant up
````

## Package Content

This virtual server includes:

- Apache web server
- MySQL database server
- PHP 7.4
- PHP extensions
  - CURL
  - IMAP
  - ZIP
  - XML
  - Imagick

### Usage

#### Database Access

Download [MySQL Workbench for Windows][1] or HeidiSQL to manage the virtual database.

Connection:

- Host: localhost OR 127.0.0.1
- Port: 3307
- User: root OR vagrant
- Pass: root OR vagrant

Create some users for your web applications, like <code>wordpress</code> or <code>developer</code>.
Set rights for each new user.

#### Web Server

Open a browser and point to <code>localhost:2080</code>.

Now, place a fresh web application installation into this folder.
Configure the installation to make use of the database.
Open your web application on <code>localhost:2080/MyWebApp</code>.

## Configuration

If you are running Windows without any other web server, you could have the virtual web server listing to port 80 instead of 2080.
To configure this, modify the Vagrantfile by replacing port 2080 by 80.

Furthermore, you can adjust the number of CPUs and memory (in MB) in the Vagrantfile.

*Attention:* You will need to restart the virtualisation after changes in the Vagrantfile

----

[1]: https://dev.mysql.com/get/Downloads/MySQLGUITools/mysql-workbench-community-8.0.19-winx64.msi
