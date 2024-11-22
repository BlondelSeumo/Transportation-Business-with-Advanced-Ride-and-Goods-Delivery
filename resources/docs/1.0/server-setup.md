# Server Installation

---

- [Introduction](#section-1)
- [Installation Requirements](#section-2)
- [Install Apache](#section-5)
- [Install PHP](#section-6)
- [Install mysql](#section-7)
- [Install phpmyadmin](#section-8)
- [Install composer](#section-9)
- [Install Jenkins](#section-10)
- [Setup Laravel Supervisor](#section-12)

<a name="section-1"></a>
## Introduction

We are strongly prefer any Server with ubuntu OS. Because it is quite easy to setup and maintain.

* Minimum Server Requirements
    * Any server with UBUNTU Preferred
    * 4 GB Ram
    * 30 GB Storage
    * vCPU 2 cores

<a name="section-2"></a>
## Installation Requirements

1. Apache
2. PHP8.1
3. mysql
4. phpmyadmin
5. composer
6. Jenkins/FTP
7. Laravel Supervisor


<a name="section-3"></a>

<a name="section-5"></a>
## Install Apache

* Open the ssh terminal using pemfile of your aws instance

* Run "sudo apt install apache2" to install an apache2

* Run "sudo apt update"

* Run "sudo nano /etc/apache2/sites-available/000-default.conf" to edit the config follow next step.

```php
<Directory /var/www/html>

                Options -Indexes
                AllowOverride All
                Require all granted
                ErrorDocument 403 "You Don't have a permission to access this URL"
                ErrorDocument 404 "Requesting Page not Found. Contact admin for further details"
          </Directory>
          ```
* Run "sudo service apache2 restart" to restart the apache2.

* Reference Link : https://www.digitalocean.com/community/tutorials/how-to-install-the-apache-web-server-on-ubuntu-20-04

<a name="section-6"></a>
## Install PHP8.1
Please follow the instrctions from the reference link below. And Install the php extensions below.
<strong>bcmath,bz2,intl,gd,mbstring,mysql,zip,fpm,curl,xml</strong>

Reference Link :  https://www.cloudbooklet.com/developer/how-to-install-or-upgrade-php-8-1-on-ubuntu-20-04/

<a name="section-7"></a>
## Install mysql
Run the below commands one by one

* sudo apt-get update
* sudo apt-get install mysql-server
* mysql_secure_installation
* sudo service mysql restart

To create a new user for mysql

* sudo mysql -u root
* use mysql;
* GRANT ALL ON *.* TO 'taxi_user'@'%' IDENTIFIED BY 'TaxiUser@123' WITH GRANT OPTION;
* FLUSH PRIVILEGES;

Reference Link : https://www.digitalocean.com/community/tutorials/how-to-install-mysql-on-ubuntu-20-04

<a name="section-8"></a>
## Install phpmyadmin

Open the path "var/www/html". and dowonload the phpmyadmin package using below command.

 "sudo wget https://files.phpmyadmin.net/phpMyAdmin/5.2.1/phpMyAdmin-5.2.1-all-languages.zip"

Unzip the downloaded package and rename it to "pma".

<a name="section-9"></a>
## Install composer
Run The Below Commands One By One

* cd ~
* curl -sS https://getcomposer.org/installer -o /tmp/composer-setup.php
* HASH=`curl -sS https://composer.github.io/installer.sig`
* echo $HASH 
* php -r "if (hash_file('SHA384', '/tmp/composer-setup.php') === '$HASH') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
* sudo php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer
* composer

(Or) Please follow the instructions from the reference link below.


Reference Link: https://www.digitalocean.com/community/tutorials/how-to-install-and-use-composer-on-ubuntu-20-04

<a name="section-10"> </a>
## Install Jenkins (Optional if you want to use ftp)
Run The Below Commands One By One :

To install jenkins you need to install JAVA && skip the firewal setup. 
<br>
<strong> Install JAVA  </strong>

1. sudo apt install default-jre
2. sudo apt install default-jdk

<strong> Install Jenkins  </strong>
1. wget -q -O - https://pkg.jenkins.io/debian-stable/jenkins.io.key | sudo apt-key add -
2. sudo sh -c 'echo deb http://pkg.jenkins.io/debian-stable binary/ > /etc/apt/sources.list.d/jenkins.list'
3. curl -fsSL https://pkg.jenkins.io/debian/jenkins.io-2023.key | sudo tee \
/usr/share/keyrings/jenkins-keyring.asc > /dev/null
4. echo deb [signed-by=/usr/share/keyrings/jenkins-keyring.asc] \
https://pkg.jenkins.io/debian binary/ | sudo tee \
/etc/apt/sources.list.d/jenkins.list > /dev/null  
5. sudo apt update
6. sudo apt install jenkins
7. sudo systemctl status jenkins

(Or) Follow the instructions from the reference link below.

Reference Link: https://www.digitalocean.com/community/tutorials/how-to-install-jenkins-on-ubuntu-20-04

### => Install FTP

* Follow the below instructions to install ftp on ubntu server

1. install vsftpd - <strong>sudo apt install vsftpd</strong>

2. take backup of config file by following command - <strong>sudo cp /etc/vsftpd.conf /etc/vsftpd.conf.bak</strong>

3. edit vsftpd.conf by following command - <strong>sudo nano /etc/vsftpd.conf</strong> and add the below lines at bottom of the file and save the file.

```php
listen=NO
listen_ipv6=YES
anonymous_enable=NO
local_enable=YES
dirmessage_enable=YES
write_enable=YES
chroot_local_user=YES
pasv_min_port=12000
pasv_max_port=12100
ssl_enable=NO
port_enable=YES
allow_writeable_chroot=YES
```

4. restart vsftpd - <strong>sudo systemctl restart vsftpd</strong>

5. Create Ftp User by folowing command - <strong> sudo adduser ftp_user</strong>

6. assign directory to user - <strong> sudo usermod -d /var/www/html ftp_user</strong>

7. add user to www-data group - <strong> sudo usermod -aG www-data ftp_user </strong>

8. change directory owners - <strong> cd /var/www </strong> Then - <strong> sudo chown -R ftp_user:www-data html/</strong>

9. change readwrite permissions - <strong>sudo chmod -R 775 html/ </strong>

<a name="section-12"> </a>
## 9. Setup Laravel Supervisor

* Follow the below steps for setup the laravel supervisor

1. sudo apt-get install supervisor

2. sudo nano /etc/supervisor/conf.d/laravel-worker.conf

3. Paste the below lines in that file

```php
[program:laravel-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/html/project-name/artisan queue:work --sleep=3 --tries=3
autostart=true
autorestart=true
user=ubuntu
numprocs=8
redirect_stderr=true
stdout_logfile=/var/www/html/project-name/worker.log
stopwaitsecs=3600
```

<strong>Note:user can be ubuntu/root & project name should be yours</strong>

4. sudo supervisorctl reread

5. sudo supervisorctl update

6. sudo supervisorctl start laravel-worker:*

Reference Link: https://laravel.com/docs/8.x/queues#supervisor-configuration

