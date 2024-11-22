# Flutter IOS Setup

---

- [Introduction](#section-1)
- [Setup Instructions](#section-2)
- [Major things to Do](#section-3)



<a name="section-1"></a>
## Introduction
In this article, we are going to set up the Tagxi super bidding App’s initial setup for real-time use cases. 

<a name="section-2"></a>
## Setup Instructions

<strong> Note: Before ios setup, please complete all the server & firebase & code changes, map setup which is mentioned in android setup & server setup sections. </strong>

<strong> flutter version for this project is 'Channel beta, 3.3.0'</strong>


* change some details in given files,

      ```php
<strong>Note:</strong> File Location: "project/ios/Runner/Runner.xcodeproj/project.pbxproj"


```flutter
PRODUCT_BUNDLE_IDENTIFIER = 'your bundle id here';  (change in 3 places in same file)
```

*  <strong> Note : File Location : "project/ios/Runner/info.plist" </strong>

```flutter
<key>CFBundleDisplayName</key>

<string>project name here</string>


```

```flutter
        
			<array>
				<string>Encoded app id from firebasse</string>
			</array>


```

* Replace <b>"Encoded app id from firebasse"</b> with the encoded app id of Firebase project



![image](../../images/flutter-doc/encodedappid.png)




* Open your project File with the Xcode IDE which is used to create the project and also it is very powerful.


project file is in location, 

*  <strong> Note : File Location : "project/ios/runner.xcworkspace" </strong>

change map api key in file, <strong> Note : File Location :  project/ios/Runner/appDelegate.swift </strong>

```flutter
GMSServices.provideAPIKey("your map key here")

```
<a name="section-3"></a>
## Major things to Do 

1. Rename the project with your app name and bundle identifier

    in Xcode / Runner / General /

![image](../../images/flutter-doc/rename-project.png)


2. Create a bundle identifier for your app in developer account.


3. create development and distribution certificates.
    
    kindly refer this url for reference - https://medium.com/mobile-devops-ci-cd-ct/steps-to-create-ios-developer-and-distribution-certificates-with-and-without-a-mac-8449b973ef9d


4. Create provisioning profiles for both development and distribution.
    kindly refer this url for reference - https://clearbridgemobile.com/how-to-create-a-distribution-provisioning-profile-for-ios/

5. Create APNS auth key for push notification.


6. Register your bundle identifier in firebase project that you changed in xcode.


7. Firebase -: setup phone number authentication, cloud messaging and firebase database.


8. Download the googleservicePlist json from firebase.
    

9. Now open the project.


10. add googleservice-Info.plist in project/ios/Runner/ or from xcode right click Runner and click Add files to runner and choose googleserviceInfo.plist file as shown in image.
![image](../../images/flutter-doc/replace-google-services.png)



11. copy the reversed client id from googleserviceplist.json and paste it in url scheme in Xcode / Runner / Info / url types as shown in image

![image](../../images/flutter-doc/copy-google-info-id.png)

![image](../../images/flutter-doc/configure-google-info.png)




12. replace App Icon in assets in the folder in following size and names without alpha and transparent background


<strong>  project/ios/Runner/Assets.xcassets/AppIcon.appiconset/ </strong>

<br>
  
   	 Icon-App-20x20@1x.png - (20x20) x1 size - 20x20

     Icon-App-20x20@2x.png - (20x20) x2 size - 40x40

     Icon-App-20x20@3x.png - (20x20) x3 size - 60x60

     Icon-App-29x29@1x.png - (29x29) x1 size - 29x29

     Icon-App-29x29@2x.png - (29x29) x2 size - 58x58

     Icon-App-29x29@3x.png - (29x29) x3 size - 87x87

     Icon-App-40x40@1x.png - (40x40) x1 size - 40x40

     Icon-App-40x40@2x.png - (40x40) x2 size - 80x80

     Icon-App-40x40@3x.png - (40x40) x3 size - 120x120

     Icon-App-60x60@2x.png - (60x60) x2 size - 120x120

     Icon-App-60x60@3x.png - (60x60) x3 size - 180x180

     Icon-App-76x76@1x.png - (76x76) x1 size - 76x76

     Icon-App-76x76@2x.png - (76x76) x2 size - 152x152

     Icon-App-83.5x83.5@2x.png - (83.5x83.5) x2 size - 167x167

     Icon-App-1024x1024@1x.png - (1024x1024) x1 size - 1024x1024


13. in go to folder 'project/ios' and run command 'flutter build ios'


14. to create archive file to upload run command 'flutter build ipa' from folder 'project/ios'.

     

      you will find archive file in folder project/build/ios/archive/Runner.xcarchive




