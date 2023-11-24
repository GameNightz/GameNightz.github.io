Install "xampp"(https://www.apachefriends.org/download.html)

Install Githubs' terminal called "Git Bash"(https://git-scm.com/downloads)

Create new folder in Directory "C:\xampp" named "TheProject"

Clone our repository 
    to do this open a new VS-code Window (for this you need to have linked your Github to VS-code)
        now instead of "Open Folder" click on "Clone Repository" 
            and select "TheProject" when it asks you where to clone it to


manually go to this directory "C:\xampp\apache\conf\extra"
    and open the file titled "httpd-vhosts.conf"

Paste this into said File

"
<VirtualHost localhost:80>
    DocumentRoot "C:\xampp\TheProject\IU-Website\public"
    DirectoryIndex index.php

    <Directory "C:\xampp\TheProject\IU-Website\public">
        AllowOverride All
        Order Allow,Deny
        Allow from All

        FallbackResource /index.php
    </Directory>
</VirtualHost>
<Directory "C:\xampp\TheProject\IU-Website">
    Options Indexes FollowSymLinks MultiViews
    AllowOverride all
    Order Deny,Allow
    Allow from all
    Require all granted
</Directory>
"

Go to the xampp controll panel 
    and start Apache and MySQL

Open the terminal via said controll panel (shell)
    and paste in "cd C:\xampp\TheProject\IU-Website"
        this changes the directory to our TheProject

Paste in "php composer.phar update"
    and let it run 
        this will install Symfony among other things

install Node.js(https://nodejs.org/en/download/) 
    go to your Terminal 
        run "npm install" and afterwards
        run "npm run build"
        

Go to the config of MySQL
    and comment out the line that says "bind-address="...""
        and edit it to say "bind-address="localhost""
    comment out the line that says "password       = ... "
        and edit it to say "password       = root "

Restart your computer for good measure 

Start your xampp as administrator

Now there should be red X's to the left of your modules(if not thats fine, better even)
    click on them and confirm the pop-up 
        there should be green checkmarks Now

Start Apache and MySQL to check if everything works

Create a new Database via the phpMyAdmin site
    call it "IU-Website"

Go to your terminal
    and make sure your directory is set to "C:\xampp\TheProject\IU-Website"
    
Run "php bin/console make:migration"
    and then "php bin/console doctrine:migrations:migrate"
        there might be some error messages 
            but if you look at phpMyAdmin you can see 
                that the Database successfully migrated