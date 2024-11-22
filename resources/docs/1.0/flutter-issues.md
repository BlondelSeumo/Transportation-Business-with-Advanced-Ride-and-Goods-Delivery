# Common Issues Of Flutter  App

---

- [Version Issues](#version-issues)
- [Project "Runner" is Damaged](#project-runner-damaged)
- [OTP Not Received](#otp-not-received)
- [Blank Screen While Running](#blank-screen-issue)

<a name="version-issues"></a>
## Version Issues

* We got the most of the tickets due to the flutter version. Please make sure that you are using the correct version for both android or ios.

Please look at the below versions

<strong> flutter version for Android & Ios project is 'Channel stable, 3.3.0'</strong>




<a name="project-runner-damaged"></a>
## Project "Runner" is Damaged

* This issue comes due to missing the below steps. You should not run the project in excode without making the required changes in the code.

* Please follow the required changes below

* change some details in given files,

<strong> Note : File Location : "project/ios/Runner/Runner.xcodeproj/project.pbxproj" </strong>

```flutter
PRODUCT_BUNDLE_IDENTIFIER = 'your bundle id here';  (change in 3 places in same file)
```

*  <strong> Note : File Location : "project/ios/Runner/info.plist" </strong>

```flutter
<key>CFBundleDisplayName</key>

<string>project name here</string>


```

* Open your project File with the Xcode IDE which is used to create the project and also it is very powerful.


project file is in location, 

*  <strong> Note : File Location : "project/ios/runner.xcworkspace" </strong>

change map api key in file, <strong> Note : File Location :  project/ios/Runner/appDelegate.swift </strong>

```flutter
GMSServices.provideAPIKey("your map key here")

```

<a name="otp-not-received"></a>
## OTP Not Received

* Please make sure the below Firebase Setup 

	* We need to create nodes in firebase realtime database, please find the sample json database below or refer firebase setup.

	* call_FB_OTP node is used to configure whether the firebase otp should used or dummy otp should use for our testing purpose <strong> call_FB_OTP should be (boolean)true </strong>


### Update the rules part with below content

```flutter
	{
  "rules": {
    "drivers": {
      ".read": true,
      ".write":true,
        ".indexOn":["is_active","g","service_location_id","vehicle_type","l","ownerid"],
      },
    "requests": {
      ".read": true,
      ".write": true,
        ".indexOn":["service_location_id"],
    },
       "SOS": {
      ".read": true,
      ".write": true
    },
       "call_FB_OTP": {
      ".read": true,
      ".write": true
    },
      "driver_android_version": {
      ".read": true,
      ".write": true
    },
      "driver_ios_version": {
      ".read": true,
      ".write": true
    },
      "user_android_version": {
      ".read": true,
      ".write": true
    },
      "user_ios_version": {
      ".read": true,
      ".write": true
    },
      "request-meta": {
      ".read": true,
      ".write": true,
        ".indexOn":["driver_id","user_id"]
    },
      "owners": {
      ".read": true,
      ".write": true,
        ".indexOn":["driver_id","user_id"]
    }
   }
 }

```


### Create release keys

1. create release keys by running command in terminal

<strong>   note: change anyname with any specific name you like, </strong>

 * keytool -genkey -v -keystore ~/[name].jks -keyalg RSA -keysize 2048 -validity 10000 -alias [your_alias_name]-storetype JKS


* after running this command give the data asked in the terminal. after that it will save the jks file and display the location


### Replace the jks key

* replace the jks key details in file,

* <strong> Note : File Location "project/android/key.properties as given below" </strong>
	
```flutter
storePassword=password you entered while creating jks file

keyPassword=password you entered while creating jks file

keyAlias=alias name you given in the command for creating jks file

storeFile=jks file name with the location like ../../../jks
```


### Generate SHA-1 and SHA-256 Keys

To obtain the SHA-1 and SHA-256 keys from the project, follow one of the methods below:

1. **Using Terminal Commands**:
   - Navigate to the 'project/android/' folder in your terminal.
   - Run the command `./gradlew signinReport`.
   - This command will provide you with the debug and release SHA-1 and SHA-256 keys.

2. **Using Keytool Command**:
   - Run the following command in the terminal:
     ```sh
     keytool -genkey -v -keystore release.keystore -alias [your_alias_name] -keyalg RSA -keysize 2048 -validity 10000
     ```
   - Replace `[your_alias_name]` with the desired alias name.
   - This command will generate the release.keystore file containing the keys.

Ensure to use either of these methods to obtain the required SHA-1 and SHA-256 keys for your project.

<br>

* Finally copy that debug and release keys and paste those in Firebase where

* Click Settings icon (presented right on project overview ) -> project settings -> Your App section -> SHA certificate fingerprints click add button and paste & Submit.



<a name="blank-screen-issue"></a>
## Blank Screen While Running

* This issue comes due to mis configurations of firebase setup or base url mis configurations

* Please make sure the below steps

	* Make sure that you have done the firebase setup
	* Make sure that you have added the correct base url


