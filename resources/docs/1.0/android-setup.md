# Android Setup

---

- [Introduction](#section-1)
- [Setup Instructions](#section-2)

<a name="section-1"></a>
## Introduction
In this article, we are going to set up the TYT App’s initial setup for real-time use cases. 

<a name="section-3"></a>
## Setup Instructions

* Open your project File the Android Studio IDE which is used to create the project and also it is very powerful.
    
Major things to do:
-------------------

1. Change the BASE_URL Variable Presented in the Constants File. 
    * It just updates your server’s primary URL to access all types of API Services From the App to your Server.
    * like this  
        *  Note : File Location : package_name(com.tyt.client) -> utilz -> Constants 

        ```java
        public interface URL {
           String BaseURL = "https://admin.tagxi.com/";
        }
        
        ```
        
2. Change the MQTT_URL value of the Variable which is presented in the SocketHelper File which is presented in the Utils Package.
    * It is used to make a Socket Connection between APP and the Server. So Update this value very carefully with your server’s right IP Address.
    * like this 
        * Note : File Location : package_name(com.tyt.client) -> utilz -> SocketHelper
        ```java
        public interface URL {
        String MQTT_URL = "3.90.25.20:1883";
        }
        
        ```
        

3. Create & configure account for map using Google map & Cloud by following below documents.

        * Google Cloud console link: https://developers.google.com/maps/documentation/android-sdk/cloud-setup
        * firebase setup doc: https://firebase.google.com/docs/android/setup


4. After created & enabled the billing from google cloud & map console
        * We need to create nodes in firebase realtime database, please find the sample json database below.

        * We need to update the rules for the created firebase-realtime-database as mentioned below.

```
    {
  "rules": {
    "drivers": {
      ".read": true,
      ".write":true,
        ".indexOn":["is_active"],
      },
    "requests": {
      ".read": true,
      ".write": true
    },
       "SOS": {
      ".read": true,
      ".write": true
    },
       "call_FB_OTP": {
      ".read": true,
      ".write": true
    }
   }
 }

```
    - [Sample-json](https://admin.tagxi.com/firebase-database.json)

        * call_FB_OTP node is used to configure whether the firebase otp should used or dummy otp should use for our testing purpose

5. Download & Paste the google-services.json into the project -> app -> build folder properly to make proper communication from your App which is a client to FireBase.

    Refer below screens for creating project & setup

![image](../../images/android-manual/create-project.png)
![image](../../images/android-manual/firebase-auth.png)

6. Generate SHA-1 and SHA-256 keys from the project
    * you will be able to get these keys in two ways these are

        * Get From Gradle ( Presented in the left panel ) -> android -> signing report makes two clicks.
After that copy debug and release keys from the bottom window 
        
        * Run the below command in the terminal to get SHA keys

            * Key tool -genkey -v -keystore release.keystore -alias [your_alias_name] -keyalg RSA -keysize 2048 -validity 10000

    * Finally copy that keys and paste those in Firebase where
Click Settings icon (presented right on project overview ) -> project settings -> Your App section -> SHA certificate fingerprints click add button and paste & Submit.


7. Google cloud Setup
    * Enable below services in cloud console
        * Places API - which helps to get address while typing keys from the app
        * Maps SDK For Android
        * Google Sheets API - For translation sheets
        * Android Device Verification - For Identify the App name to append in OTP from Firebase
        * Some Geolocation APIs like distance matrix, geocoding, geolocations, Maps JavaScript, Maps static.


8. Reset the version code

    * So Finally Don’t Forget to reset the version code and version name to 1(version code) and “ your own string ” (version name) in the app’s build. Gradle file which is presented inside

anndroid -> defaultConfig
```java
versionCode 1
versionName "1.0"
```

And also if you change the package name from the source make sure it is updated in the same file discussed above
```java

applicationId "com.tyt.client"

```

Note : Please Make Sure You are using 

1. Android Plugin Version  :-  4.1.2

2. Gradle Version          :-  6.5
