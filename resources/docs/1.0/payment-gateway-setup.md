# Payment Gateway Installation

---

- [Introduction](#section-1)
- [Payment Keys Setup](#section-2)


<a name="section-1"></a>
## Introduction

In this section, we are going to see how we should update our payment gateway keys for the application.

<a name="section-2"></a>
## Payment Keys Setup

* Since we are using 5 payment gateways, we should update our test & productions keys for server and flutter apps by the below admin app settings.

* Go To Admin app Configurations menu & Click System settings & Click Installation settings, you can see the screen like below.

![image](../../images/flutter-doc/payment-settings.png)

* You can update your test keys and production keys by this settings. <br>
<br><br>

<strong>Note: For Paystack payment gateway you need to add an additional setup that is you should update call back url in paystack settings</strong>

<h3> Paystack setup</h3>

* Once you have updated the keys in the admin settings. you should update your callback url in paystack settings section like below.

* Call back url example : "http://your-base-url/api/v1/payment/paystack/web-hook".

![image](../../images/flutter-doc/paystack-callback.jpeg)
