
/***************************************

Color Elephant Web App
Author : Tamilvanan N
Created On : 07-Aug-2017 
Modified On : 08-Aug-2017

***************************************/


Fictional Problem :

We want to create a web based platform that allows candidates to be evaluated by
multiple people.

Database Configuration :

Filename - profileClass.php
Variables - $dbname, $username, $password, $host

Tables Used :

1.profile
2.user
3.reviews

DB dump sql file name - query_patches.sql

Please create and import the database.

Mail configuration :

I have created the gmail id for testing purpuose. Please change it, if you want.

Variables - $mailUserName, $mailPassword

PHP Version Used - PHP 5.5.9
MySQL Version Used - Server version: 5.6.33-0ubuntu0.14.04.1 (Ubuntu)


/*******************

Workflow steps

********************/

1. Registration process with E-Mail Id
2. Clicking on One time link from mail box
3. Password set up
4. Login using registered mail id & Updated password
5. Add Profile - Profile(s) can be added
6. My Profile - Profiles added by own will be shown here. User can view the details, download the attachemnts and view the public ratings.
7. Public Profile - User can view the public profiles added by other users. They can rate it for others.
8. Logout
