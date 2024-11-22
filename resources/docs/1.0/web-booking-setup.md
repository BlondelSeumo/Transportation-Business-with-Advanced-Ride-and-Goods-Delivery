# Web Booking

---

- [Introduction](#section-1)
- [Firebase OTP setup](#section-2)
- [Twilio OTP setup](#section-3)
- [SMS ALA OTP setup](#section-4)
- [Msg91 OTP setup](#section-5)
- [Sparrow OTP setup](#section-6)
- [SMS India Hub OTP setup](#section-7)

<a name="section-1"></a>
## Introduction
In this article, we are going to configure the TYT App’s initial setup for Web-booking.
After Backend setup of firebase is implemented, verify if the google map key for web application stored in theMap settings has access to Distance matrix and Geocoding.

* Enable the gateway through which OTP is to be sent under SMS settings of configurations (default firebase)

<a name="section-2"></a>
## FireBase OTP setup

* Update web app configuration of your firebase project in the firebase settings in the admin panel

![image](../../images/user-manual-docs/firebase-setup.png)

* Enable the phone otp service provider provided by firebase accessed below sign-in methods within Authentication

![image](../../images/user-manual-docs/firebase-authenticate-provider.png)

* Navigate to settings under the Authentication and add your domain (if not present)

![image](../../images/user-manual-docs/firebase-authenticate-domain.png)

<a name="section-3"></a>
## Twilio OTP setup

* Enable the Twilio gateway and update the <b>Sender Id, Token and Mobile number</b>

<a name="section-4"></a>
## SMS ALA OTP setup

* Enable the SMS ALA gateway and update the <b>Api Key, Api Secret, Token and Mobile number</b>

<a name="section-5"></a>
## Msg91 OTP setup

* Enable the Msg91 gateway and update the <b>Template Id and Auth key</b>

<a name="section-6"></a>
## Sparrow OTP setup

* Enable the Sparrow gateway and update the <b>Sender Id and Token</b>

<a name="section-7"></a>
## SMS India Hub OTP setup

* Enable the SMS India Hub gateway and update the <b>Sender Id and API key</b>

