# Backend Setup

---

- [Introduction](#section-1)
- [Setup Instructions](#section-2)
- [Map Setup](#section-4)
- [Firebase Config](#section-5)
- [Queue Setup](#section-6)
- [Translation Setup](#section-7)


<a name="section-1"></a>
## Introduction
You are almost finished and ready to setup your back end part. once you setup jenkins and taken a build or just uploaded the laravel project in your project path. Please follow the below steps for running the server app.

* Admin App & Dispatcher App Link

    Admin App: http://your-base-url/login

    Default Access For Admin

     email: admin@admin.com <br>

     password: 123456789 <br>


 Dispatcher App :  http://your-base-url/login-dispatch






<a name="section-2"></a>
## Setup Instructions

* rename the ".env-example" file to ".env"
* Create a database using phpmyadmin
* Setup DB config in .env file
    ```php
    APP_URL=http://tagxi.com/future/public
    ```
   ```php
   DB_PORT=3306
DB_DATABASE=your_db_name
DB_USERNAME=your_user_name
DB_PASSWORD=your_passoword

   ```

   * Sample .env file
   ```php
APP_NAME=Tagxi
APP_ENV=local
APP_KEY=base64:mnQvTJAlzNknS4lqVmprl9XOSm2BVE0ceeXdFzSyQDU=
APP_DEBUG=true
APP_URL=http://localhost/tyt/public
LOG_CHANNEL=daily
SYSTEM_DEFAULT_TIMEZONE=Asia/Kolkata
SYSTEM_DEFAULT_CURRENCY = 'INR'
APP_FOR=production
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_db_name
DB_USERNAME=your_user_name
DB_PASSWORD=your_user_password
BROADCAST_DRIVER=log
CACHE_DRIVER=array
FILESYSTEM_DRIVER=local
QUEUE_CONNECTION=database
SESSION_DRIVER=file
SESSION_LIFETIME=120
MEMCACHED_HOST=127.0.0.1
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false
MAIL_MAILER=smtp
MAIL_HOST=smtp.sendgrid.net
MAIL_PORT=587
MAIL_USERNAME=apikey
MAIL_PASSWORD=SG.=KNd4LUxxowWdtklHgamytGu_mIBGMQhHVINFZiY
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=suport@tagxi.com
MAIL_FROM_NAME="tagxi"
PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1
MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
FIREBASE_CREDENTIALS=/var/www/html/tyt/public/push-configurations/firebase.json
FIREBASE_DATABASE_URL=https://your-firbase-url.com/
TWILIO_SID=your-twilio-sid
TWILIO_AUTH_TOKEN=your-twilio-token
TWILIO_PHONE_NUMBER=your-twilio-number
PAYPAL_SANDBOX_CLIENT_ID=your-client-id
PAYPAL_SANDBOX_CLIENT_SECRET=your-secrect-id
PAYPAL_MODE=sandbox
PAYPAL_SANDBOX_APP_ID=your-app-id
STRIPE_KEY=your-key
STRIPE_SECRET=your-secrect

```

* Need to configure database config in .env file mentioned above.

* run the below commands to run the project.

    * composer install
    * php artisan migrate
    * php artisan db:seed
    * php artisan passport:install
    * php artisan storage:link
```
<a name="section-4"></a>
## Map Configuration

* To create zone & see map view  & other map functionalities we need to add google map key in admin app settings section.


<a name="section-5"></a>
## Firebase Configuration

* After created the account in firebase, you need to create realtime database by following the explanation in android setup document section. 

* After created the realtime database you need to copy the database url and paste it to the below .env variable
```php
FIREBASE_DATABASE_URL=https://your-app.firebaseio.com/
FIREBASE_CREDENTIALS= /var/www/html/tyt/public/push-configurations/firebase.json
```

* To get realtime drivers from fiebase we need to configure web app in firebase. so that we need to create web app.
![image](../../images/user-manual-docs/firebase-create-web-app.png)
![image](../../images/user-manual-docs/firebase-web-config.png)


<!-- ```php
GOOGLE_MAP_KEY=AIzaSyBeTRs1icwooRpk7ErjCEQCwu0OQowVt9I
``` -->

* Generate firebase.json content and replace it in the below paths. Please find the image for how to generate firebase.json file.

    <!-- * node/firebase.json -->
    * public/push-configurations/firebase.json

![image](../../images/user-manual-docs/project-settings–firebase-console.png)


<a name="section-6"></a>
## Queue Setup

* for sending notifications & other stuffs we need to configure the supervisor setup to run the queue jobs in the server by following the document https://laravel.com/docs/8.x/queues#supervisor-configuration

* sample laraver-worker file

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
* We need to run cron jobs so that please open the cronjob file and enter the below line with your projrvt name.
* to open cronjob file please use the following command "crontab -e"

```php
* * * * * cd /var/www/html/taxi && php artisan schedule:run >> /dev/null 2>&1
```

<a name="section-7"></a>
## Translation

* We have used barryvdh/laravel-translation-manager for the admin app translations

* For Mobile Translation keywords you need to enable the translation sheet api in google cloud console & get the api key from there & paste in to our .environment value below like this.

<!-- ```php
GOOGLE_SHEET_KEY = AIzaGyBVE-WE-lwXhxWFHJthZ6FleF1WQ3NmGAV
``` -->
