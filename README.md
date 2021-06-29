# Mountain States Drivers Ed Admin (www.msdeadmin.com) - HOWTO

Additional notes on how this web application works, for site maintennance and support.
## dreamhost.com shared hosting server installation notes

    # copy/upload the ispring.tar.gz or ispring.zip archive to the server web root and extract to create /ispring folder
    cd ispring
    cp .htaccess.dreamhost.example .htaccess
    # edit .htaccess in your favorite text editor to define base_url, site passwords and other settings
    composer install                    # optional: install php dependencies if /ispring/vendor folder doesn't already exist

## local development with docker (optional)

    git clone git@github.com:nathandias/klini.git
    cd klini/ispring
    cp .env.example .env
    # edit .env in your favorite text editor to define base_url and site passwords
    composer install
    # edit sitedef.php and set $development = true
    cd ..
    docker-compose up -d   
## code structure notes

Overall idea:
- php code in /ispring/function folder fetches data from the API and puts it into php arrays
- php code in /ispring folder formats the array data into html tables
- other non-php code in /ispring/js and /ispring/css, does the paging, prettifying the tables + form validation
### /ispring/function/
- department.php
- student_group.php
- student_result.php

The entire contents of these three files was included/quoted as the "documentation" for the "Advanced Student Details Website".

curl is a php library for fetching data from a specified URL. In this case, calls the to various ispringlearn.com REST API endpoints
return XML data as their response.

Each of the files in these directories corresponds to a call to a different API endpoint.

*department.php* fills *$array3* with department data from the api-learn.ispringlearn.com/department endpoint
- a better variable name for $array3 would be *$department_data*

*student_group.php* fills *$array* all user data from the api-learn.ispringlearn.com/user endpoint
- a better variable name would be *$all_users*
- both 'learners' (students) and non-learner (custom, admin, etc) users are included, so need to filter on role='learner' to display only students

*student_result.php* fills *$array1* with data from the api-learn.ispringlearn.com/learners/modules/results end point
- better variable name would be *$learner_module_results*
- results for all learners (not just a single learner) are included in the response, and the data is in a flat list format, like:

        record 1: [UserId => A, Module => Unit 1, CompletionStatus => passed, ...]
        record 2: [UserId => A, Module => Unit 2, CompletionStatus => passed, ...]
        record 3: [UserId => A, Module => Unit 3, CompletionStatus => in_progress, ...]
        record 4: [UserId => B, Module => Unit 1, CompletionStatus => passed, ...]
        record 5: [UserId => B, Module => Unit 2, CompletionStatus => passed, ...]
        ...
        record 13: [UserId => A, Module => Unit 10, CompletionStatus => passed, ...]

and in particular, NOT a nested structure like:

    record 1: [UserId = A, Modules => [
        [ModuleName => Unit 1, CompletionStatus => passed]
        [ModuelName => Unit 2, CompletionStatus => passed]
        [ModuelName => Unit 3, CompletionStatus => in_progress]
        ]]
    record 2: [UserId = B, Modules => [
        [ModuleName => Unit 1, CompletionStatus => passed]
        [ModuleName => Unit 1, CompletionStatus => passed]
        ...
        [ModuleName => Unit 10, CompletionStatus => passed]
    ]]

### /ispring/

**ORIGINAL FILES**
- index.php - displays the login and authenticates the user
- student_details.php - displays the paged list of all student records
- student_view_details.php - displays an individual student record with full progress details

**ADDED BY NATHAN**
*sitedef.php*
 - reads the site configuration and secret passwords/API keys from environment variables
    - in production on dreamhost.com, values should be set in the .htaccess file using SetEnv command
    - for development, edit sitedef.php and set $development = true to read values from .env file instead
    - .env.example and .htaccess.dreamhost.example files are provided as templates; customize appropriately
    - *.example files are okay to commit to public version control (GitHub); do not commit .env or .htaccess files containing
        live passwords or secrets!
    - .env and .htaccess are included in .gitignore to prevent these from being committed

*index.php*
- checks email/password against those defined in .env file

*student_details.php* 
- uses function/student_group.php to get all the users, and filters by role='learner'
ADDED BY NATHAN
- uses function/student_result.php to add "Completion Status" column to the summary page

*student_view_details.php*
- uses function/student_result.php to show full progress report on the student
- also uses function/student_group.php and function/department.php to supply supplemental data

## Password checking improvements

The original code did email/password validation and authentication for the web app in plain-text, with a simple 'if' statements in two places:
- /ispring/index.php
- /ispring/js/script.js

Hardcoding a password in plain text is never a good idea. It was somewhat hidden in the index.php file, since php files are not world readable, but
the passwords in script.js are absolutely world readable, and therefore vulnerable. Furthermore, if the index.php file is ever committed to public version control (i.e. GitHub), the passwords there would also be visible.

### Nathan's modifications
- extract web app passwords into a .env file not world readable and load the values into php separately using vlucas/phpdotenv
- ensure .env file is not committed to public version control by adding it to .gitignore
- do the password authentication solely in PHP where it is more secure
- do only basic form validation in javascript (OKAY: are any required fields empty? BAD: does the password match a hardcoded plain-text password?)
- while we're at it, also store ispringlearn.com API credentials in the .env file, to keep them safe
- place the .env file outside of the web server and php root