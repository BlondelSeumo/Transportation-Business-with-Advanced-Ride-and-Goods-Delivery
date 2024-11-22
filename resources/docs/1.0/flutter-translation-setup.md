# Flutter Translation Setup

---

- [Introduction](#section-1)
- [Setup Instructions](#section-2)



<a name="section-1"></a>
## Introduction
We are using google translation api to translation the key words from english to particular language. in this article we are going to see how we are using google api to translate the keywords.

<a name="section-2"></a>
## Setup Instructions

1. Find the translation.xlsx file from main-file folder & import into google sheet, 

2. If you want to add new language you can add new column as you prefered language short code
     Example of creating french language
       Create a new column named "fr" . & under fr use the below formula to translate all the keywords.
        
```excel
Translation Formula: =GOOGLETRANSLATE(B2, "en", "fr")
```
        
  In this formula B2 is the row number of english word.
 
 
Refer The below url to create short code for languages
 
https://developers.google.com/admin-sdk/directory/v1/languages


3. After Added & Updated all the data. you need to setup your server. & you can call our translation api which is created in our server app. so before trying to build an app from ios/android, please complete the server app setup first.

* you can copy the sheet_id from the updated google sheet link like below

  * https://docs.google.com/spreadsheets/d/1tQekGR1ViQeRdlFe7NsDFfrJX_Zb55H2UTMe01VRjso/edit#gid=0

  * <strong>Note:Your sheet should update the permission to see the sheet with anyone, please see the below reference image</strong>

  ![image](../../images/user-manual-docs/sharewithanyone.png)


* copy the sheet id & place it in to Configurations->System Settings->map Settings->Google Sheet Id  field.

<!-- ```php
GOOGLE_SHEET_ID='your-sheet-id'
GOOGLE_SHEET_KEY='your-sheet-key'
```  -->
  ![image](../../images/user-manual-docs/google_sheet_id.png)


4. After setup the server app,
You can call the translation api which is <strong>"you-server-base-url/api/v1/translation/get"</strong>

You will get the json response from this api. which is updated json for the translation.
copy the json and paste in <strong>project/lib/translations/translation.dart</strong>

```flutter


		Map<String, dynamic> languages = {

	

		"en": {

```
