# Working with Google API

Working wth Google API is a bit bothersome when starting a new app. 
To enable your app for Google Service APIs you need to follow these steps.

##1. Create a Google Account.

First you need to create a Google Account. If you don't have an account visit 
[https://accounts.google.com/signup](https://accounts.google.com/signup) to create one.

##2. Enable a Google Developer Account.

Login your Google Account and visit [console.developers.google.com](console.developers.google.com).

##3. Create a new project and select your APIs.

Once in your developer console you can create a new project to access the Google Analytics API. After creating your 
project you can select any API via the overview tab. You will need the 'Analytics Reporting API V4' to access your 
Analytics data.

##4. Create an OAuth2.0 Access.

###4.1 Create an OAuth2.0 Webclient.

You need to create an OAuth2.0 access for your app. First you will need to create an OAuth-client. Select the Webclient
and setup https://yourdomain.com for authorized JavaScript and https://yourdomain.com/googleApi/authenticate/callback 
and maybe https://yourdomain.com/app_dev.php/googleApi/authenticate/callback for debug-purpose as authorized callback path.
After creating the Webclient you will get a client id. You have to paste this id in your parameters.yml in client_id.


###4.2 Create an OAuth2.0 Access-Screen.

You need to create an access-screen which will be shown when requesting permissions. The appname is mandatory but 
all other fields are optional. You can setup your homepage-url and add an image for your product. There are also optional
link fields for your data agreements and terms of use.

###4.3 Confirm your domain.

You need to confirm your domain from step 4.1. You can add any domain you own, but you have to verify your ownership via
Google Webmasters.

##5. You have done well.

If everything went right you just created the access to Google API and linked your analytics app via client_id to the 
Google Developer Project.
