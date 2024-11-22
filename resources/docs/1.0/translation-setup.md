# Translation Setup

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

       * Translation Formula 
                =GOOGLETRANSLATE(B2,"en","fr")

            * In this formula B2 is the row number of english word.

        * Refer The below url to create short code for languages
            https://developers.google.com/admin-sdk/directory/v1/languages

3. After Added & Updated all the key words. you need to setup your server. & you can call our translation api which is created in our server app. so before trying to build an app from ios/android, pleaase complete the server app setup first.

4.  After setup the server app,

    * You can call the translation api which is "you-server-base-url/api/v1/translation/get"
    * You will get the json response from this api. which is updated json for the translation.
    * Replace the json file in this path "app -> res -> raw -> translations.json". of android app.
    * For Ios you don't need to replace the json. it will automatically fetch when the app opens.

    
Note : In Android app if you want to replace the json you need to update the translation api response to below path
"app -> res -> raw -> translations.json".

