# Mountain States Drivers Ed Admin (www.msdeadmin.com) - HOWTO

Additional notes on how this web application works, for site maintennance and support.

## Installation Notes
1. copy the ispring.tar.gz file to a web server that supports PHP code execution and SSL certificates
2. tar zxvpf ispring.tar.gz
3. this creates the 'ispring' subdirectory containing the relevant code


## Directory Structure

ispring/
    .env.example                # copy this file to '.env' and edit the secret values for valid email id and passwords
    index.php                   # displays the login form
    sitedef.php                 # defines the site URL and reads in the .env to get valid email id and password
    student_details.php         # displays a list of student records with a link to view individual records (uses function/student_group.php to get data)
    student_view_details.php    # displays a single student record (primarily uses function/student_result.php to get data)
|_ css/
|_ js/
     - paging.js
     - script.js    # front-end validation of username and password
|_ function/
     - department.php           # accesses the ispringlearn.com/departments API endpoint and returns data in php variable $array3
     - student_group.php        # accesses the ispringlearn.com/user?departments[]=specific_id API endpoint and returns data in php variable $array
     - student_result.php       # accesses the ispringlearn.com/learners/modules/results endpoint and returns data in php variable $array1

## index.php

Originally, this code file used a php if statement to test whether user POSTed email and password matched a plain-text email and password hardcoded
into the php source file. It also indirectly loadeded /js/script.js which contained some javascript form validation of the same hardcoded plain-text
email and password.

### Security vulnerabilities discovered
1. js/script.js: this file is always world readable, and thus so are any username/passwords contained in it
2. index.php - although the php source file would not necessarily be readable, if the code is commited to public version control (i.e. GitHub),
    then the login credentials could be public too

### Nathan's security modifications
1. remove the plain-text credentials from both script.js and index.php, and put them into a .env file
2. add .env to .gitignore list to exclude it from version control (okay to commit a .env.example with dummy values to version control though)
3. load the .env values into php variables in the needed scripts using vlucas/phpdotenv library (included in sitedef.php)
4. authenticate the credentials in php / backend...and only do basic validation in javascript

changed files: index.php, sitedef.php, js/script.js
added files: .env, .env.example

While we're at it, also pulled ispring API credentials out out the source file and placed these values in .env





