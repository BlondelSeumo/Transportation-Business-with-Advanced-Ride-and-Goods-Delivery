<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cms\FrontPage;


class FrontpageHeaderTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        $cms = FrontPage::first();

        if($cms){
            goto end;

        }
        
        \DB::table('landingpagecms')->insert(array (
            0 => 
            array (
                'id' => 19,
                'userid' => 1,
                'tabfaviconfile'=>'logo.png',
                'faviconfile' => 'logo.png',
                'bannerimage' => '7IyequYxO0s6wyIdAt80J0pQhzByxkV7LYjBSGlW.png',
                'description' => '<h2><strong>It&rsquo;s time to change your ride experience!<br />
Download the Tagxi app Today</strong></h2>',
                'playstoreicon1' => 'i14BWjhLnQmRNSBixfIUq0dFlvNUxjC5WDZmbkp7.svg',
                'playstoreicon2' => 'cng3OM9Dptnrrjc2JOhy7Qsx2RYSU6L4FIVAtVSW.svg',
                'firstrowimage1' => 'tc0hC6m3wb9tUrZ0WTn3QVrR2ikIIekKHQvcTsV7.svg',
                'firstrowheadtext1' => '<h2><strong>Tap a button, get a ride</strong></h2>',
                'firstrowsubtext1' => '<p>Choose your ride and set your location. You&#39;ll see your driver&#39;s picture and vehicle details, and can track their arrival on the map.</p>',
                'firstrowimage2' => 'nMGcH7Cdd8HlaeBXqAbO9eCDiiX5lyKnsay6YxGf.svg',
                'firstrowheadtext2' => '<h2><strong>Always on, always available</strong></h2>',
                'firstrowsubtext2' => '<p>No phone calls to make, no pick-ups to schedule. With 24/7 availability, request a ride any time of day, any day of the year</p>',
                'firstrowimage3' => 'Q1KRguEcisJ1kzQ9QkvWo1Gbp29SUIqbKS8YHP2R.svg',
                'firstrowheadtext3' => '<h2><strong>You rate, we listen</strong></h2>',
                'firstrowsubtext3' => '<p>Rate your driver and provide anonymous feedback about your trip. Your input helps us make every ride a 5-star experience.</p>',
                'secondrowimage1' => 'Kkk2hUMTBfzzhJKSFoKqzgAy3VzLHKto684wie9x.jpg',
                'secondrowheadtext1' => '<h2><strong>On-demand rides for in-</strong></h2>

<h2><strong>demand people</strong></h2>',
                'secondrowimage2' => '6ONOuxBnaUO7YHhKgL2W23SNpezkMCYWn3UCVuQc.jpg',
                'secondrowheadtext2' => '<h2><strong>Make your work commute</strong></h2>

<h2><strong>or business trip more</strong></h2>

<h2><strong>environmentally friendly</strong></h2>

<h2><strong>and cost effective.</strong></h2>',
                'secondrowimage3' => 'C1SWBNAeHBWth8o1xcHkK33XxuOXUZdz2ACl547N.jpg',
                'secondrowheadtext3' => '<h2><strong>Safe and easy rides</strong></h2>

<h2><strong>Througout North</strong></h2>

<h2><strong>Carolina</strong></h2>',
                'footertextsub' => '<p>Tagxi is a rideshare platform facilitating peer to peer ridesharing by means of connecting passengers who are in need of rides from drivers with available cars to get from point A to point B with the press of a button.</p>',
                'footercopytextsub' => '<p>&copy; 2021 Tagxi, LLC All rights reserved. <a href="http://localhost/taxiwebnew/index.php#" target="blank"> Powered By Tagxi </a></p>',
                'footerlogo'=>'logo.png',
                'footerinstagramlink'=>'footerinstalink',
                'footerfacebooklink'=>'footerfblink',
                'safety' => 'jIjFIDLtztvv6qaNXLo6NXP2NCQJra17K2xJQi3B.jpg',
                'safetytext' => '<p>Due to the COVID-19 pandemic, tyt has updated health safety guidelines to help keep drivers and passengers safe. Under the new guidelines, drivers and passengers must stay home if they have COVID-19 or related symptoms, wear a face covering, keep the front seat empty, and roll windows down when possible. Drivers or passengers who repeatedly violate these new guidelines will be suspended. If a driver ever has a health safety concern, like someone not wearing a face covering, they can cancel the ride without incurring a fee.</p>',
                'serviceheadtext' => '<h2><strong>Our Service Locations</strong></h2>',
                'servicesubtext' => '<p>We cover all major cities and surrounding areas in North Carolina. For every destination in life, we will connect you to a reliable driver in minutes. Let us take you there</p>',
                'serviceimage' => 'Fx14Mzje1kkGVzXnwC4H4XAnAnKQt8Ns0Lnya7DT.png,YI2xAmJ2WRpa89avWmoKJ3d5919c32oZia7aDnL5.png,8vYKhSvAcYQXiqFrEpUsqwJioFGad762yNZEYxgY.png,DGM0bkjr5HSFQnM7qalYTeGCFcE9J8hEf7LgfDbn.png,tT7PE5NqpaQSa2wrOZm8lq70xuvOkONJ1S2pBUqT.png',
                'privacy' => '<h2>Privacy Policy</h2>

<p>The Scope of This Policy</p>

<p>This policy applies to all tyt users, including Riders and Drivers (including Driver applicants), and to all tyt platforms and services, including our apps, websites, features, and other services (collectively, the &ldquo;tyt Platform&rdquo;). Please remember that your use of the tyt Platform is also subject to our Terms of Service.</p>

<p>The Information We Collect</p>

<p>When you use the tyt Platform, we collect the information you provide, usage information, and information about your device. We also collect information about you from other sources like third-party services, and optional programs in which you participate, which we may combine with other information we have about you. Here are the types of information we collect about you:</p>

<p>A. Information You Provide to Us</p>

<p>Account Registration. When you create an account with tyt, we collect the information you provide us, such as your name, email address, phone number, birth date, and payment information. You may choose to share additional info with us for your Rider profile, like your photo or saved addresses (e.g., home or work), and set up other preferences (such as your preferred pronouns).<br />
<br />
<strong>Driver Information.</strong> If you apply to be a Driver, we will collect the information you provide in your application, including your name, email address, phone number, birth date, profile photo, physical address, government identification number (such as social security number), driver&rsquo;s license information, vehicle information, and car insurance information. We collect the payment information you provide us, including your bank routing numbers, and tax information. Depending on where you want to drive, we may also ask for additional business license or permit information or other information to manage driving and programs relevant to that location. We may need additional information from you at some point after you become a Driver, including information to confirm your identity (like a photo).<br />
<br />
<strong>SOS Contact Information</strong> We will collect the contact list permission to list the contacts while adding the sos contacts for user & driver app<br />
<br />
<strong>Ratings and Feedback.</strong> When you rate and provide feedback about Riders or Drivers, we collect all of the information you provide in your feedback.<br />
<br />
<strong>Communications.</strong> When you contact us or we contact you, we collect any information that you provide, including the contents of the messages or attachments you send us.</p>

<p>B. Information We Collect When You Use the tyt Platform</p>

<p><strong>Location Information.</strong> Great rides start with an easy and accurate pickup. The tyt Platform collects location information (including GPS and WiFi data) differently depending on your tyt app settings and device permissions as well as whether you are using the platform as a Rider or Driver:</p>

<ul>
<li>Riders: We collect your device&rsquo;s precise location when you open and use the tyt app, including while the app is running in the background from the time you request a ride until it ends. tyt also tracks the precise location of scooters and e-bikes at all times.</li>
<li>Drivers: We collect your device&rsquo;s precise location when you open and use the app, including while the app is running in the background when it is in driver mode. We also collect precise location for a limited time after you exit driver mode in order to detect ride incidents, and continue collecting it until a reported or detected incident is no longer active.</li>
</ul>

<p><strong>Usage Information.</strong> We collect information about your use of the tyt Platform, including ride information like the date, time, destination, distance, route, payment, and whether you used a promotional or referral code. We also collect information about your interactions with the tyt Platform like our apps and websites, including the pages and content you view and the dates and times of your use.<br />
<br />
<strong>Device Information.</strong> We collect information about the devices you use to access the tyt Platform, including device model, IP address, type of browser, version of operating system, identity of carrier and manufacturer, radio type (such as 4G), preferences and settings (such as preferred language), application installations, device identifiers, advertising identifiers, and push notification tokens. If you are a Driver, we also collect mobile sensor data from your device (such as speed, direction, height, acceleration, deceleration, and other technical data).<br />
<br />
<strong>Communications Between Riders and Drivers.</strong> We work with a third party to facilitate phone calls and text messages between Riders and Drivers without sharing either party&rsquo;s actual phone number with the other. But while we use a third party to provide the communication service, we collect information about these communications, including the participants&rsquo; phone numbers, the date and time, and the contents of SMS messages. For security purposes, we may also monitor or record the contents of phone calls made through the tyt Platform, but we will always let you know we are about to do so before the call begins.<br />
<br />
<strong>Address Book Contacts.</strong> You may set your device permissions to grant tyt access to your contact lists and direct tyt to access your contact list, for example to help you refer friends to tyt. If you do this, we will access and store the names and contact information of the people in your address book.<br />
<br />
<strong>Cookies, Analytics, and Third-Party Technologies.</strong> We collect information through the use of &ldquo;cookies&rdquo;, tracking pixels, data analytics tools like Google Analytics, SDKs, and other third-party technologies to understand how you navigate through the tyt Platform and interact with tyt advertisements, to make your tyt experience safer, to learn what content is popular, to improve your site experience, to serve you better ads on other sites, and to save your preferences. Cookies are small text files that web servers place on your device; they are designed to store basic information and to help websites and apps recognize your browser. We may use both session cookies and persistent cookies. A session cookie disappears after you close your browser. A persistent cookie remains after you close your browser and may be accessed every time you use the tyt Platform. You should consult your web browser(s) to modify your cookie settings. Please note that if you delete or choose not to accept cookies from us, you may miss out on certain features of the tyt Platform.</p>

<p>C. Information We Collect from Third Parties</p>

<p><strong>Third-Party Services.</strong> Third-party services provide us with information needed for core aspects of the tyt Platform, as well as for additional services, programs, loyalty benefits, and promotions that can enhance your tyt experience. These third-party services include background check providers, insurance partners, financial service providers, marketing providers, and other businesses. We obtain the following information about you from these third-party services:</p>

<ul>
<li>Information to make the tyt Platform safer, like background check information for drivers;</li>
<li>Information about your participation in third-party programs that provide things like insurance coverage and financial instruments, such as insurance, payment, transaction, and fraud detection information;</li>
<li>Information to operationalize loyalty and promotional programs or applications, services, or features you choose to connect or link to your tyt account, such as information about your use of such programs, applications, services, or features; and</li>
<li>Information about you provided by specific services, such as demographic and market segment information.</li>
</ul>

<p><strong>Enterprise Programs.</strong> If you use tyt through your employer or other organization that participates in one of our tyt Business enterprise programs, we will collect information about you from those parties, such as your name and contact information.<br />
<br />
<strong>Concierge Service.</strong> Sometimes another business or entity may order you a tyt ride. If an organization has ordered a ride for you using our Concierge service, they will provide us your contact information and the pickup and drop-off location of your ride.<br />
<br />
<strong>Referral Programs.</strong> Friends help friends use the tyt Platform. If someone refers you to tyt, we will collect information about you from that referral including your name and contact information.<br />
<br />
<strong>Other Users and Sources.</strong> Other users or public or third-party sources such as law enforcement, insurers, media, or pedestrians may provide us information about you, for example as part of an investigation into an incident or to provide you support.</p>

<p>How We Use Your Information</p>

<p>We use your personal information to:</p>

<ul>
<li>Provide the tyt Platform;</li>
<li>Maintain the security and safety of the tyt Platform and its users;</li>
<li>Build and maintain the tyt community;</li>
<li>Provide customer support;</li>
<li>Improve the tyt Platform; and</li>
<li>Respond to legal proceedings and obligations.</li>
</ul>

<p><strong>Providing the tyt Platform.</strong> We use your personal information to provide an intuitive, useful, efficient, and worthwhile experience on our platform. To do this, we use your personal information to:</p>

<ul>
<li>Verify your identity and maintain your account, settings, and preferences;</li>
<li>Connect you to your rides and track their progress;</li>
<li>Calculate prices and process payments;</li>
<li>Allow Riders and Drivers to connect regarding their ride and to choose to share their location with others;</li>
<li>Communicate with you about your rides and experience;</li>
<li>Collect feedback regarding your experience;</li>
<li>Facilitate additional services and programs with third parties; and</li>
<li>Operate contests, sweepstakes, and other promotions.</li>
</ul>

<p><strong>Maintaining the Security and Safety of the tyt Platform and its Users.</strong> Providing you a secure and safe experience drives our platform, both on the road and on our apps. To do this, we use your personal information to:</p>

<ul>
<li>Authenticate users;</li>
<li>Verify that Drivers and their vehicles meet safety requirements;</li>
<li>Investigate and resolve incidents, accidents, and insurance claims;</li>
<li>Encourage safe driving behavior and avoid unsafe activities;</li>
<li>Find and prevent fraud; and</li>
<li>Block and remove unsafe or fraudulent users from the tyt Platform.</li>
</ul>

<p><strong>Building and Maintaining the tyt Community.</strong> tyt works to be a positive part of the community. We use your personal information to:</p>

<ul>
<li>Communicate with you about events, promotions, elections, and campaigns;</li>
<li>Personalize and provide content, experiences, communications, and advertising to promote and grow the tyt Platform; and</li>
<li>Help facilitate donations you choose to make through the tyt Platform.</li>
</ul>

<p><strong>Providing Customer Support.</strong> We work hard to provide the best experience possible, including supporting you when you need it. To do this, we use your personal information to:</p>

<ul>
<li>Investigate and assist you in resolving questions or issues you have regarding the tyt Platform; and</li>
<li>Provide you support or respond to you.</li>
</ul>

<p><strong>Improving the tyt Platform</strong>. We are always working to improve your experience and provide you with new and helpful features. To do this, we use your personal information to:</p>

<ul>
<li>Perform research, testing, and analysis;</li>
<li>Develop new products, features, partnerships, and services;</li>
<li>Prevent, find, and resolve software or hardware bugs and issues; and</li>
<li>Monitor and improve our operations and processes, including security practices, algorithms, and other modeling.</li>
</ul>

<p><strong>Responding to Legal Proceedings and Requirements.</strong> Sometimes the law, government entities, or other regulatory bodies impose demands and obligations on us with respect to the services we seek to provide. In such a circumstance, we may use your personal information to respond to those demands or obligations.</p>

<p>How We Share Your Information</p>

<p>We do not sell your personal information. To make the tyt Platform work, we may need to share your personal information with other users, third parties, and service providers. This section explains when and why we share your information.</p>

<p>A. Sharing Between tyt Users</p>

<p>Riders and Drivers.<br />
<br />
<strong>Rider information shared with Driver:</strong> Upon receiving a ride request, we share with the Driver the Rider&rsquo;s pickup location, name, profile photo, rating, Rider statistics (like approximate number of rides and years as a Rider), and information the Rider includes in their Rider profile (like preferred pronouns). Upon pickup and during the ride, we share with the Driver the Rider&rsquo;s destination and any additional stops the Rider inputs into the tyt app. Once the ride is finished, we also eventually share the Rider&rsquo;s rating and feedback with the Driver. (We remove the Rider&rsquo;s identity associated with ratings and feedback when we share it with Drivers, but a Driver may be able to identify the Rider that provided the rating or feedback.)<br />
<br />
<strong>Driver information shared with Rider:</strong> Upon a Driver accepting a requested ride, we will share with the Rider the Driver&rsquo;s name, profile photo, preferred pronouns, rating, real-time location, and the vehicle make, model, color, and license plate, as well as other information in the Driver&rsquo;s tyt profile, such as information Drivers choose to add (like country flag and why you drive) and Driver statistics (like approximate number of rides and years as a Driver).<br />
<br />
Although we help Riders and Drivers communicate with one another to arrange a pickup, we do not share your actual phone number or other contact information with other users. If you report a lost or found item to us, we will seek to connect you with the relevant Rider or Driver, including sharing actual contact information with your consent.<br />
<br />
<strong>Shared Ride Riders.</strong> When Riders use a tyt Shared ride, we share each Rider&rsquo;s name and profile picture to ensure safety. Riders may also see each other&rsquo;s pickup and drop-off locations as part of knowing the route while sharing the ride.<br />
<br />
<strong>Rides Requested or Paid For by Others.</strong> Some rides you take may be requested or paid for by others. If you take one of those rides using your tyt Business Profile account, a code or coupon, a subsidized program (e.g., transit or government), or a corporate credit card linked to another account, or another user otherwise requests or pays for a ride for you, we may share some or all of your ride details with that other party, including the date, time, charge, rating given, region of trip, and pick up and drop off location of your ride.<br />
<br />
<strong>Referral Programs.</strong> If you refer someone to the tyt Platform, we will let them know that you generated the referral. If another user referred you, we may share information about your use of the tyt Platform with that user. For example, a referral source may receive a bonus when you join the tyt Platform or complete a certain number of rides and would receive such information.</p>

<p>B. Sharing With Third-Party Service Providers for Business Purposes</p>

<p>Depending on whether you&rsquo;re a Rider or a Driver, tyt may share the following categories of your personal information for a business purpose to provide you with a variety of the tyt Platform&rsquo;s features and services:</p>

<ul>
<li>Personal identifiers, such as your name, address, email address, phone number, date of birth, government identification number (such as social security number), driver&rsquo;s license information, vehicle information, and car insurance information;</li>
<li>Financial information, such as bank routing numbers, tax information, and any other payment information you provide us;</li>
<li>Commercial information, such as ride information, Driver/Rider statistics and feedback, and Driver/Rider transaction history;</li>
<li>Internet or other electronic network activity information, such as your IP address, type of browser, version of operating system, carrier and/or manufacturer, device identifiers, and mobile advertising identifiers; and</li>
<li>Location data.</li>
</ul>

<p>We disclose those categories of personal information to service providers to fulfill the following business purposes:</p>

<ul>
<li>Maintaining and servicing your tyt account;</li>
<li>Processing or fulfilling rides;</li>
<li>Providing you customer service;</li>
<li>Processing Rider transactions;</li>
<li>Processing Driver applications and payments;</li>
<li>Verifying the identity of users;</li>
<li>Detecting and preventing fraud;</li>
<li>Processing insurance claims;</li>
<li>Providing Driver loyalty and promotional programs;</li>
<li>Providing marketing and advertising services to tyt;</li>
<li>Providing financing;</li>
<li>Providing requested emergency services;</li>
<li>Providing analytics services to tyt; and</li>
<li>Undertaking internal research to develop the tyt Platform.</li>
</ul>

<p>C. For Legal Reasons and to Protect the tyt Platform</p>

<ul>
<li>Comply with any applicable federal, state, or local law or regulation, civil, criminal or regulatory inquiry, investigation or legal process, or enforceable governmental request;</li>
<li>Respond to legal process (such as a search warrant, subpoena, summons, or court order);</li>
<li>Enforce our Terms of Service;</li>
<li>Cooperate with law enforcement agencies concerning conduct or activity that we reasonably and in good faith believe may violate federal, state, or local law; or</li>
<li>Exercise or defend legal claims, protect against harm to our rights, property, interests, or safety or the rights, property, interests, or safety of you, third parties, or the public as required or permitted by law.</li>
</ul>

<p>D. In Connection with Sale or Merger</p>

<p>We may share your personal information while negotiating or in relation to a change of corporate control such as a restructuring, merger, or sale of our assets.</p>

<p>E. Upon Your Further Direction</p>

<p>With your permission or upon your direction, we may disclose your personal information to interact with a third party or for other purposes.</p>

<p>How We Store and Protect Your Information</p>

<p>We retain your information for as long as necessary to provide you and our other users the tyt Platform. This means we keep your profile information for as long as you maintain an account. We retain transactional information such as rides and payments for at least seven years to ensure we can perform legitimate business functions, such as accounting for tax obligations. If you request account deletion, we will delete your information as set forth in the &ldquo;Deleting Your Account&rdquo; section below. We take reasonable and appropriate measures designed to protect your personal information. But no security measures can be 100% effective, and we cannot guarantee the security of your information, including against unauthorized intrusions or acts by third parties.</p>

<p>Your Rights And Choices Regarding Your Data</p>

<p>tyt provides ways for you to access and delete your personal information as well as exercise other data rights that give you certain control over your personal information.</p>

<p>A. All Users</p>

<p>Email Subscriptions. You can always unsubscribe from our commercial or promotional emails by clicking unsubscribe in those messages. We will still send you transactional and relational emails about your use of the tyt Platform.<br />
<br />
<strong>Text Messages.</strong> You can opt out of receiving commercial or promotional text. You may also opt out of receiving all texts from tyt (including transactional or relational messages. Note that opting out of receiving all texts may impact your use of the tyt Platform. Drivers can also opt out of driver-specific messages by texting STOP in response to a driver SMS. To re-enable texts you can text START in response to an unsubscribe confirmation SMS.<br />
<br />
<strong>Push Notifications.</strong> You can opt out of receiving push notifications through your device settings. Please note that opting out of receiving push notifications may impact your use of the tyt Platform (such as receiving a notification that your ride has arrived).<br />
<br />
<strong>Profile Information</strong>. You can review and edit certain account information you have chosen to add to your profile by logging in to your account settings and profile.<br />
<br />
<strong>Location Information.</strong> You can prevent your device from sharing location information through your device&rsquo;s system settings. But if you do, this may impact tyt&rsquo;s ability to provide you our full range of features and services.<br />
<br />
<strong>Cookie Tracking.</strong> You can modify your cookie settings on your browser, but if you delete or choose not to accept our cookies, you may be missing out on certain features of the tyt Platform.<br />
<br />
<strong>Do Not Track.</strong> Your browser may offer you a &ldquo;Do Not Track&rdquo; option, which allows you to signal to operators of websites and web applications and services that you do not want them to track your online activities. The tyt Platform does not currently support Do Not Track requests at this time.<br />
<br />
<strong>Deleting Your Account.</strong> If you would like to delete your tyt account, please visit our privacy homepage. In some cases, we will be unable to delete your account, such as if there is an issue with your account related to trust, safety, or fraud. When we delete your account, we may retain certain information for legitimate business purposes or to comply with legal or regulatory obligations. For example, we may retain your information to resolve open insurance claims, or we may be obligated to retain your information as part of an open legal claim. When we retain such data, we do so in ways designed to prevent its use for other purposes.<br />
<br />
<strong>Right to Know.</strong> You have the right to know and see what data we have collected about, including:</p>

<ul>
<li>The categories of personal information we have collected about you;</li>
<li>The categories of sources from which the personal information is collected;</li>
<li>The business or commercial purpose for collecting your personal information;</li>
<li>The categories of third parties with whom we have shared your personal information; and</li>
<li>The specific pieces of personal information we have collected about you.</li>
</ul>

<p><strong>Right to Delete.</strong> You have the right to request that we delete the personal information we have collected from you (and direct our service providers to do the same). There are a number of exceptions, however, that include, but are not limited to, when the information is necessary for us or a third party to do any of the following:</p>

<ul>
<li>Complete your transaction;</li>
<li>Provide you a good or service;</li>
<li>Perform a contract between us and you;</li>
<li>Protect your security and prosecute those responsible for breaching it;</li>
<li>Fix our system in the case of a bug;</li>
<li>Protect the free speech rights of you or other users;</li>
<li>Engage in public or peer-reviewed scientific, historical, or statistical research in the public interests that adheres to all other applicable ethics and privacy laws;</li>
<li>Comply with a legal obligation; or</li>
<li>Make other internal and lawful uses of the information that are compatible with the context in which you provided it.</li>
</ul>

<p><strong>Other Rights.</strong> You can request certain information about our disclosure of personal information to third parties for their own direct marketing purposes during the preceding calendar year. This request is free and may be made once a year. You also have the right not to be discriminated against for exercising any of the rights listed above.<br />
<br />
<strong>Website:</strong> You may visit our privacy homepage to authenticate and exercise rights via our website.<br />
<br />
<strong>Email webform:</strong> You may write to us to exercise rights. To respond to some rights we will need to verify your request either by asking you to log in and authenticate your account or otherwise verify your identity by providing information about yourself or your account. Authorized agents can make a request on your behalf if you have given them legal power of attorney or we are provided proof of signed permission, verification of your identity, and confirmation that you provided the agent permission to submit the request. Response Timing and Format. We aim to respond to a consumer request for access or deletion within 45 days of receiving that request. If we require more time, we will inform you of the reason and extension period in writing.</p>

<p>Children&rsquo;s Data</p>

<p>tyt is not directed to children, and we don&rsquo;t knowingly collect personal information from children under the age of 13. If we find out that a child under 13 has given us personal information, we will take steps to delete that information. If you believe that a child under the age of 13 has given us personal information, please contact us</p>

<p>Links to Third-Party Websites</p>

<p>The tyt Platform may contain links to third-party websites. Those websites may have privacy policies that differ from ours. We are not responsible for those websites, and we recommend that you review their policies. Please contact those websites directly if you have any questions about their privacy policies.</p>

<p>Changes to This Privacy Policy</p>

<p>We may update this policy from time to time as the tyt Platform changes and privacy law evolves. If we update it, we will do so online, and if we make material changes, we will let you know through the tyt Platform or by some other method of communication like email. When you use tyt, you are agreeing to the most recent terms of this policy.</p>

<p>Contact Us</p>

<p>If you have any questions or concerns about your privacy or anything in this policy, including if you need to access this policy in an alternative format, we encourage you to contact us.</p>',
                    'dmv' => '<h2><strong>DMV check &amp; background check consent</strong></h2>

<p>&nbsp;</p>

<p>Consent to Request Driving Record</p>

<p>I understand that tyt, LLC. (&lsquo;Company&rsquo;) will use Checkr., (&lsquo;Checkr, Inc.&rsquo;) to obtain a motor vehicle record as part of the application process to be a driver on the tyt Platform (a &lsquo;Driver&rsquo;). I also understand that if accepted as a Driver, to the extent permitted by law, Company may obtain further Reports from Checkr Inc. so as to update, renew or extend my status as a Driver. I hereby give permission to tyt to obtain my state driving record (also known as my motor vehicle record or MVR) in accordance with the Federal Driver&rsquo;s Privacy Protection Act (&lsquo;DPPA&rsquo;) and applicable state law. I acknowledge and understand that my driving record is a consumer report that contains public record information. I authorize, without reservation any party or agency contacted by Company or Checkr Inc. to furnish Company a copy of my state driving record. This authorization shall remain on file by Company for the duration of my time as a Driver, and will serve as ongoing authorization for Company to procure my state driving record at any time while I am a Driver.</p>

<p>Consent to Request Consumer Report or Investigative Consumer Report Information</p>

<p>I understand that tyt, LLC. (&lsquo;Company&rsquo;) will use Checkr Inc.,</p>

<p>1 Montgomery St, Ste 2000, San Francisco, CA 94104</p>

<p>to obtain a consumer report or investigative consumer report as part of the application process to be a driver on the tyt Platform (a &lsquo;Driver&rsquo;). I also understand that if accepted as a Driver, to the extent permitted by law, Company may obtain further Reports from Checkr so as to update, renew or extend my status as a Driver.</p>

<p>I understand Checkr, Inc&rsquo;s (&ldquo;Checkr&rdquo;) investigation may include obtaining information regarding my criminal record, subject to any limitations imposed by applicable federal and state law. I understand such information may be obtained through direct or indirect contact with public agencies or other persons who may have such knowledge.</p>

<p>The nature and scope of the investigation sought will include a Criminal Background check and SSN Trace.</p>

<p>I acknowledge receipt of the attached summary of my rights under the Fair Credit Reporting Act and, as required by law, any related state summary of rights (collectively &ldquo;Summaries of Rights&rdquo;).</p>

<p>This consent will not affect my ability to question or dispute the accuracy of any information contained in a Report. I understand if Company makes a conditional decision to disqualify me based all or in part on my Report, I will be provided with a copy of the Report and another copy of the Summaries of Rights, and if I disagree with the accuracy of the purported disqualifying information in the Report, I must notify Company within five business days of my receipt of the Report that I am challenging the accuracy of such information with Checkr.</p>

<p>I hereby consent to this investigation and authorize Company to procure a Report on my background.</p>

<p>In order to verify my identity for the purposes of Report preparation, I am voluntarily releasing my date of birth, social security number and the other information and fully understand that all decisions are based on legitimate non-discriminatory reasons.</p>

<p>The name, address and telephone number of the nearest unit of the consumer reporting agency designated to handle inquiries regarding the investigative consumer report is:</p>

<p><strong>Checkr, Inc.<br />
1 Montgomery St, Ste 2000, San Francisco, CA 94104<br />
844-824-3257 </strong><br />
<br />
<strong>California, Maine, Massachusetts, Minnesota, New Jersey &amp; Oklahoma Applicants Only:</strong> I have the right to request a copy of any Report obtained by Company from Checkr by checking the box. (Check only if you wish to receive a copy)</p>

<p>New York Applicants Only</p>

<p>I also acknowledge that I have received the attached copy of Article 23A of New York&rsquo;s Correction Law. I further understand that I may request a copy of any investigative consumer report by contacting Checkr. I further understand that I will be advised if any further checks are requested and provided the name and address of the consumer reporting agency.</p>

<p>California Applicants and Residents</p>

<p>If I am applying in California or reside in California, I understand I have the right to visually inspect the files concerning me maintained by an investigative consumer reporting agency during normal business hours and upon reasonable notice. The inspection can be done in person, and, if I appear in person and furnish proper identification; I am entitled to a copy of the file for a fee not to exceed the actual costs of duplication. I am entitled to be accompanied by one person of my choosing, who shall furnish reasonable identification. The inspection can also be done via certified mail if I make a written request, with proper identification, for copies to be sent to a specified addressee. I can also request a summary of the information to be provided by telephone if I make a written request, with proper identification for telephone disclosure, and the toll charge, if any, for the telephone call is prepaid by or directly charged to me. I further understand that the investigative consumer reporting agency shall provide trained personnel to explain to me any of the information furnished to me; I shall receive from the investigative consumer reporting agency a written explanation of any coded information contained in files maintained on me. &ldquo;Proper identification&rdquo; as used in this paragraph means information generally deemed sufficient to identify a person, including documents such as a valid driver&rsquo;s license, social security account number, military identification card and credit cards. I understand that I can access the following website checkr.com privacy to view Checkr&rsquo;s privacy practices, including information with respect to Checkr&rsquo;s preparation and processing of investigative consumer reports and guidance as to whether my personal information will be sent outside the United States or its territories.</p>

<p>A Summary of Your Rights Under the Fair Credit Reporting Act</p>

<p>The federal Fair Credit Reporting Act (FCRA) promotes the accuracy, fairness, and privacy of information in the files of consumer reporting agencies. There are many types of consumer reporting agencies, including credit bureaus and specialty agencies (such as agencies that sell information about check writing histories, medical records, and rental history records). Here is a summary of your major rights under the FCRA. <strong>For more information, including information about additional rights, go to www.consumerfinance.gov/learnmore or write to:</strong></p>

<p>Consumer Financial Protection Bureau<br />
1700 G Street NW, Washington, DC 20552</p>

<p>&nbsp;</p>

<ul>
<li>You must be told if information in your file has been used against you. Anyone who uses a credit report or another type of consumer report to deny your application for credit, insurance, or employment &ndash; or to take another adverse action against you &ndash; must tell you, and must give you the name, address, and phone number of the agency that provided the information.</li>
<li>You have the right to know what is in your file. You may request and obtain all the information about you in the files of a consumer reporting agency (your &ldquo;file disclosure&rdquo;). You will be required to provide proper identification, which may include your Social Security number. In many cases, the disclosure will be free. You are entitled to a free file disclosure if:
<ol>
<li>a person has taken adverse action against you because of information in your credit report;</li>
<li>you are the victim of identity theft and place a fraud alert in your file;</li>
<li>your file contains inaccurate information as a result of fraud;</li>
<li>you are on public assistance;</li>
<li>you are unemployed but expect to apply for employment within 60 days.</li>
</ol>
In addition, all consumers are entitled to one free disclosure every 12 months upon request from each nationwide credit bureau and from nationwide specialty consumer reporting agencies. See www.consumerfinance.gov/learnmore for additional information.</li>
<li>You have the right to ask for a credit score. Credit scores are numerical summaries of your credit-worthiness based on information from credit bureaus. You may request a credit score from consumer reporting agencies that create scores or distribute scores used in residential real property loans, but you will have to pay for it. In some mortgage transactions, you will receive credit score information for free from the mortgage lender.</li>
<li>You have the right to dispute incomplete or inaccurate information. If you identify information in your file that is incomplete or inaccurate, and report it to the consumer reporting agency, the agency must investigate unless your dispute is frivolous. See www.consumerfinance.gov/learnmore for an explanation of dispute procedures.</li>
<li>Consumer reporting agencies must correct or delete inaccurate, incomplete, or unverifiable information. Inaccurate, incomplete or unverifiable information must be removed or corrected, usually within 30 days. However, a consumer reporting agency may continue to report information it has verified as accurate.</li>
<li>Consumer reporting agencies may not report outdated negative information. In most cases, a consumer reporting agency may not report negative information that is more than seven years old, or bankruptcies that are more than 10 years old.</li>
<li>Access to your file is limited. A consumer reporting agency may provide information about you only to people with a valid need &ndash; usually to consider an application with a creditor, insurer, employer, landlord, or other business. The FCRA specifies those with a valid need for access.</li>
<li>You must give your consent for reports to be provided to employers. A consumer reporting agency may not give out information about you to your employer, or a potential employer, without your written consent given to the employer. Written consent generally is not required in the trucking industry. For more information, go to www.consumerfinance.gov/learnmore</li>
<li>You may limit &ldquo;prescreened&rdquo; offers of credit and insurance you get based on information in your credit report. Unsolicited &ldquo;prescreened&rdquo; offers for credit and insurance must include a toll-free phone number you can call if you choose to remove your name and address from the lists these offers are based on. You may opt-out with the nationwide credit bureaus at 1-888-567-8688.</li>
<li>You may seek damages from violators. If a consumer reporting agency, or, in some cases, a user of consumer reports or a furnisher of information to a consumer reporting agency violates the FCRA, you may be able to sue in state or federal court.</li>
<li>Identity theft victims and active duty military personnel have additional rights. For more information, visit www.consumerfinance.gov/learnmore.</li>
</ul>

<p>States may enforce the FCRA, and many states have their own consumer reporting laws. In some cases, you may have more rights under state law. For more information, contact your state or local consumer protection agency or your state Attorney General. For information about your federal rights, contact:</p>

<p>&nbsp;</p>

<table>
<thead>
<tr>
<th>
<p>Type of business</p>
</th>
<th>
<p>Contact</p>
</th>
</tr>
</thead>
<tbody>
<tr>
<td>1.a. Banks, savings associations, and credit unions with total assets of over $10 billion and their affiliates.</td>
<td>a. Consumer Financial Protection Bureau 1700 G Street NW, Washington, DC 20552</td>
</tr>
<tr>
<td>1.b. Such affiliates that are not banks, savings associations, or credit unions also should list, in addition to the CFPB:</td>
<td>b. Federal Trade Commission: Consumer Response Center &ndash; FCRA Washington, DC 20580 877-382-4357</td>
</tr>
</tbody>
<tbody>
<tr>
<td colspan="2">
<p>To the extent not included in item 1 above</p>
</td>
</tr>
</tbody>
<tbody>
<tr>
<td>2.a. National banks, federal savings associations, and federal branches and federal agencies of foreign banks</td>
<td>a. Office of the Comptroller of the Currency Customer Assistance Group 1301 McKinney Street Suite 3450, Houston, TX 77010-9050</td>
</tr>
<tr>
<td>2.b. State member banks, branches and agencies of foreign banks (other than federal branches, federal agencies, and Insured State Branches of Foreign Banks), commercial lending companies owned or controlled by foreign banks, and organizations operating under section 25 or 25A of the Federal Reserve Act</td>
<td>b. Federal Reserve Consumer Help Center P.O. Box 1200 Minneapolis, MN 55480</td>
</tr>
<tr>
<td>2.c. Nonmember Insured Banks, Insured State Branches of Foreign Banks, and insured state savings associations</td>
<td>c. FDIC Consumer Response Center 1100 Walnut Street Box #11, Kansas City, MO 64106</td>
</tr>
<tr>
<td>2.d. Federal Credit Unions</td>
<td>d. National Credit Union Administration Office of Consumer Protection (OCP), Division of Consumer Compliance and Outreach (DCCO) 1775 Duke Street, Alexandria, VA 22314</td>
</tr>
</tbody>
<tbody>
<tr>
<td>3. Air carriers</td>
<td>Asst. General Counsel for Aviation Enforcement &amp; Proceedings Aviation Consumer Protection Division Department of Transportation 1200 New Jersey Avenue SE, Washington, DC 20590</td>
</tr>
</tbody>
<tbody>
<tr>
<td>4. Creditors Subject to Surface Transportation Board</td>
<td>Office of Proceedings, Surface Transportation Board, Department of Transportation 395 E Street SW, Washington, DC 20423</td>
</tr>
</tbody>
<tbody>
<tr>
<td>5. Creditors Subject to Packers and Stockyards Act, 1921</td>
<td>Nearest Packers and Stockyards Administration area supervisor</td>
</tr>
</tbody>
<tbody>
<tr>
<td>6. Small Business Investment Companies</td>
<td>Associate Deputy Administrator for Capital Access, United States Small Business Administration 409 Third Street SW 8th Floor, Washington, DC 20416</td>
</tr>
</tbody>
<tbody>
<tr>
<td>7. Brokers and Dealers</td>
<td>Securities and Exchange Commission 100 F St NE, Washington, DC 20549</td>
</tr>
</tbody>
<tbody>
<tr>
<td>8. Federal Land Banks, Federal Land Bank Associations, Federal Intermediate Credit Banks, and Production Credit Associations</td>
<td>Farm Credit Administration, 1501 Farm Credit Drive, McLean, VA 22102-5090</td>
</tr>
</tbody>
<tbody>
<tr>
<td>9. Retailers, Finance Companies, and All Other Creditors Not Listed Above</td>
<td>FTC Regional Office for region in which the creditor operates or Federal Trade Commission: Consumer Response Center &ndash; FCRA Washington, DC 20580 877-382-4357</td>
</tr>
</tbody>
</table>',
                    'complaince' => '<h3><strong>Equal Employment Opportunity and Non-Discrimination Policy</strong></h3>

<h3>I. OVERVIEW &amp; SCOPE</h3>

<p>tyt, LLC of 6255 TownCenter Drive Ste 819, Clemmons, North Carolina 27012, has established a Non-Discrimination and Equal Employment Opportunity Policy (&quot;EEO&quot;). This EEO policy applies to all aspects of the relationship between tyt, LLC and its employees, including, but not limited to, employment, recruitment, advertisements for employment, hiring and firing, compensation, assignment, classification of employees, termination, upgrading, promotions, transfer, training, working conditions, wages and salary administration, and employee benefits and application of policies. These policies apply to independent contractors, temporary employees, all personnel working on the premises, and any other persons or firms doing business for or with tyt, LLC. Any user found to have violated this prohibition will lose access to the tyt, LLC platform. Applicable laws in certain jurisdictions may require and/or allow the provision of services by and for the benefit of a specific category of persons. In such jurisdictions, services provided in compliance with these laws and the relevant applicable terms are permissible under this policy.</p>

<h3>II. POLICIES</h3>

<p>1. DISCRIMINATION.</p>

<p>tyt, LLC shall not tolerate, under any circumstances, without exception, any form of discrimination based on race, creed, religion, color, age, disability, pregnancy, marital status, parental status, sexual orientation, gender expression, gender identity, veteran status, military status, domestic violence victim status, national origin, political affiliation, sex, predisposing genetic characteristics, or geographic location and any other status protected by the law. This list is not exhaustive. For qualified people with disabilities, tyt, LLC will make every effort to provide reasonable workplace accommodations that comply with applicable laws.</p>

<p>Discrimination in providing transportation services is strictly prohibited</p>

<p>Associated drivers and employees are required to know the non-discrimination prohibitions. tyt, LLC will not tolerate as to public accommodations, which includes taxicab services unlawful discriminatory practice to deny, directly or indirectly, any person the full and equal enjoyment of the goods, services, facilities, privileges, advantages, and accommodations of any place of public accommodations (including taxicab services) wholly or partially for a discriminatory reason based on place of residence or business.</p>

<p>Prohibited Discriminatory Conduct:</p>

<p>tyt, LLC recognizes that associated drivers should never discriminate against certain customers by not picking them up, not taking them where they wish to go or by treating them with less respect based on the protected characteristics or traits listed above. Specific examples of discriminatory conduct, include the following:<br />
<br />
Not picking up a passenger on the basis of any protected characteristic or trait, including not picking up a passenger with a service animal&middot; Requesting that a passenger get out of a taxicab on the basis of a protected characteristic or trait &middot; Using derogatory or harassing language on the basis of a protected characteristic or trait &middot; Refusing a pickup in a specific geographic area.</p>

<p>Geographic Discrimination:</p>

<p>tyt, LLC does not tolerate geographic discrimination and recognizes how important it is to take the customer to the requested destination without discriminating against that customer based on where he or she wishes to go. All associated drivers, employees, managers, stakeholders, and agents at tyt, LLC will comply with these anti-discrimination policies. In some cases, local laws and regulations may provide greater protections than those described in this policy.</p>

<p>2. HARASSMENT</p>

<p>tyt, LLC is committed to providing a work environment that is free from harassment. Any behavior that is unwanted and offensive to the recipient, which creates an intimidating, hostile, or humiliating work environment for that person violates tyt, LLC&#39;s policy. Harassment can occur between members of the opposite sex or the same sex. Harassment, verbal or non-verbal, explicit or implicit, based on an individual&#39;s sex, race, ethnicity, national origin, age, religion or any other legally protected characteristics will not be tolerated. All employees, including supervisors, other management personnel, and independent contractors, are required to abide by this policy. No person will be adversely affected in employment with tyt, LLC as a result of bringing complaints of harassment.</p>

<p>3. SEXUAL HARASSMENT</p>

<p>Unwelcome sexual advances, requests for sexual favors, and other verbal or physical conduct of a sexual nature constitute harassment when (1) submission to such conduct is made either explicitly or implicitly a term or condition of employment; (2) submission to or rejection of such conduct by an individual is used as a basis for employment decisions, promotion, transfer, selection for training, performance evaluations, benefits, or other terms and conditions of employment; or (3) such conduct has the purpose or effect of creating an intimidating, hostile, or offensive work environment or substantially interferes with an employee&#39;s work performance . tyt, LLC prohibits inappropriate conduct that is sexual in nature at work, on Company business, or at Company-sponsored events including the following: comments, jokes, degrading language, sexually suggestive objects, books, or any form of media electronic or in print form. Sexual harassment is prohibited whether it is between members of the opposite sex or members of the same sex.</p>

<p>4. STATEMENT ON AFFIRMATIVE ACTION</p>

<p>An affirmative action program has been developed where tyt, LLC seeks to increase the representation and participation of minorities</p>

<p>5. REPORTING DISCRIMINATION &amp; HARASSMENT</p>

<p>If an employee feels that he or she has been harassed as described in this policy, they should immediately file grievance with: Grievance Department, 6255 TownCenter Drive, Ste 819, Clemmons NC 27012, or by email at compliance@tyt.us. Once the matter has been reported it will be promptly investigated and any corrective action will be taken when deemed appropriate. All complaints or unlawful harassment under this policy or otherwise will be handled in as confidential a manner as possible. Timely reporting is encouraged to prevent the re-occurrence of, or otherwise address, the behavior that violates this policy or law. Delays in reporting a complaint can limit the type of effectiveness of a response by tyt, LLC. The procedure for reporting incidents of discriminatory or harassing behavior is not intended to prevent the right of any employee to seek a remedy under available state or federal law by immediately reporting the matter to the appropriate state or federal agency.</p>

<p>6. RETALIATION</p>

<p>Retaliation against any person associated with tyt, LLC who reports instances of harassment - whether he or she is directly or indirectly involved - is in violation of tyt, LLC&#39;s policies. All reported incidents are assumed to be made in good faith. Any allegations that are proven false will be treated as a serious matter.</p>

<p>7. DISCIPLINARY MEASURES FOR HARASSMENT</p>

<p>Any employee engaging in behavior that violates this policy will be subject to disciplinary action, including the possible termination of employment, whether or not an actual law has been violated.</p>

<p>8. REMEDIES</p>

<p>Remedies for any instances of verified employment discrimination, whether caused intentionally or by actions that have a discriminatory effect, may include back pay, hiring, promotion, reinstatement, front pay, reasonable accommodation, or other actions deemed appropriate by tyt, LLC. Remedies can also include payment of attorney&#39;s fees, expert witness fees, court costs and other applicable legal fees.</p>

<p>9. POLICY IMPLEMENTATION</p>

<p>tyt&rsquo;s CEO, Lynn Graham, fully supports the implementation of this Policy effective as of April 19, 2021.</p>',
                    'terms' => '<h2><strong>Terms and Conditions</strong></h2>

<p>END USER LICENSE AGREEMENT</p>

<p>Last updated May 16, 2021</p>

<p>tyt,LLC is licensed to You (End-User) by tyt, LLC, located at 6255 Towncenter Drive Ste 819, Clemmons, North Carolina 27012, United States (hereinafter: Licensor), for use only under the terms of this License Agreement.<br />
<br />
By downloading the Application from the Apple AppStore and Google Play, and any update thereto (as permitted by this License Agreement), You indicate that You agree to be bound by all of the terms and conditions of this License Agreement, and that You accept this License Agreement.<br />
<br />
The parties of this License Agreement acknowledge that Apple and/or Google Play is not a Party to this License Agreement and is not bound by any provisions or obligations with regard to the Application, such as warranty, liability, maintenance and support thereof. tyt, LLC, not Apple or Google Play, is solely responsible for the licensed Application and the content thereof.<br />
<br />
This License Agreement may not provide for usage rules for the Application that are in conflict with the latest App Store Terms of Service. tyt, LLC acknowledges that it had the opportunity to review said terms and this License Agreement is not conflicting with them.<br />
<br />
All rights not expressly granted to You are reserved.</p>

<p>1. THE APPLICATION</p>

<p>tyt (hereinafter: Application) is a piece of software is a Rideshare platform - and customized for Apple and Android mobile devices. It is used to Connecting riders to drivers to get to point A to B by a push of a button.<br />
<br />
The Application is not tailored to comply with industry-specific regulations (Health Insurance Portability and Accountability Act (HIPAA), Federal Information Security Management Act (FISMA), etc.), so if your interactions would be subjected to such laws, you may not use this Application. You may not use the Application in a way that would violate the Gramm-Leach-Bliley Act (GLBA).</p>

<p>2. SCOPE OF LICENSE</p>

<p>2.1 You are given a non-transferable, non-exclusive, non-sublicensable license to install and use the Licensed Application on any Apple-branded or Google Products that You (End-User) own or control and as permitted by the Usage Rules set forth in this section and the App Store Terms of Service, with the exception that such licensed Application may be accessed and used by other accounts associated with You (End-User, The Purchaser) via Family Sharing or volume purchasing.<br />
<br />
2.2 This license will also govern any updates of the Application provided by Licensor that replace, repair, and/or supplement the first Application, unless a separate license is provided for such update in which case the terms of that new license will govern.<br />
<br />
2.3 You may not share or make the Application available to third parties (unless to the degree allowed by the Apple Terms and Conditions, and with tyt, LLC&#39;s prior written consent), sell, rent, lend, lease or otherwise redistribute the Application.<br />
<br />
2.4 You may not reverse engineer, translate, disassemble, integrate, decompile, integrate, remove, modify, combine, create derivative works or updates of, adapt, or attempt to derive the source code of the Application, or any part thereof (except with tyt, LLC&#39;s prior written consent).<br />
<br />
2.5 You may not copy (excluding when expressly authorized by this license and the Usage Rules) or alter the Application or portions thereof. You may create and store copies only on devices that You own or control for backup keeping under the terms of this license, the App Store Terms of Service, and any other terms and conditions that apply to the device or software used. You may not remove any intellectual property notices. You acknowledge that no unauthorized third parties may gain access to these copies at any time.<br />
<br />
2.6 Violations of the obligations mentioned above, as well as the attempt of such infringement, may be subject to prosecution and damages.<br />
<br />
2.7 Licensor reserves the right to modify the terms and conditions of licensing.<br />
<br />
2.8 Nothing in this license should be interpreted to restrict third-party terms. When using the Application, You must ensure that You comply with applicable third-party terms and conditions.</p>

<p>3. TECHNICAL REQUIREMENTS</p>

<p>3.1 Licensor attempts to keep the Application updated so that it complies with modified/new versions of the firmware and new hardware. You are not granted rights to claim such an update.<br />
<br />
3.2 You acknowledge that it is Your responsibility to confirm and determine that the app end-user device on which You intend to use the Application satisfies the technical specifications mentioned above.<br />
<br />
3.3 Licensor reserves the right to modify the technical specifications as it sees appropriate at any time.</p>

<p>4. MAINTENANCE AND SUPPORT</p>

<p>4.1 The Licensor is solely responsible for providing any maintenance and support services for this licensed Application. You can reach the Licensor at the email address listed in the App Store or Google Play Overview for this licensed Application.<br />
<br />
4.2 tyt, LLC and the End-User acknowledge that Apple and or Google Play has no obligation whatsoever to furnish any maintenance and support services with respect to the licensed Application.</p>

<p>5. USE OF DATA</p>

<p>You acknowledge that Licensor will be able to access and adjust Your downloaded licensed Application content and Your personal information, and that Licensor&#39;s use of such material and information is subject to Your legal agreements with Licensor and Licensor&#39;s privacy policy: http://www.tyt.us/privacy.</p>

<p>6. USER GENERATED CONTRIBUTIONS</p>

<p>The Application may invite you to chat, contribute to, or participate in blogs, message boards, online forums, and other functionality, and may provide you with the opportunity to create, submit, post, display, transmit, perform, publish, distribute, or broadcast content and materials to us or in the Application, including but not limited to text, writings, video, audio, photographs, graphics, comments, suggestions, or personal information or other material (collectively, &quot;Contributions&quot;). Contributions may be viewable by other users of the Application and through third-party websites or applications. As such, any Contributions you transmit may be treated as non-confidential and non-proprietary. When you create or make available any Contributions, you thereby represent and warrant that:<br />
<br />
1. The creation, distribution, transmission, public display, or performance, and the accessing, downloading, or copying of your Contributions do not and will not infringe the proprietary rights, including but not limited to the copyright, patent, trademark, trade secret, or moral rights of any third party.<br />
<br />
2. You are the creator and owner of or have the necessary licenses, rights, consents, releases, and permissions to use and to authorize us, the Application, and other users of the Application to use your Contributions in any manner contemplated by the Application and these Terms of Use.<br />
<br />
3. You have the written consent, release, and/or permission of each and every identifiable individual person in your Contributions to use the name or likeness or each and every such identifiable individual person to enable inclusion and use of your Contributions in any manner contemplated by the Application and these Terms of Use.<br />
<br />
4. Your Contributions are not false, inaccurate, or misleading.<br />
<br />
5. Your Contributions are not unsolicited or unauthorized advertising, promotional materials, pyramid schemes, chain letters, spam, mass mailings, or other forms of solicitation.<br />
<br />
6. Your Contributions are not obscene, lewd, lascivious, filthy, violent, harassing, libelous, slanderous, or otherwise objectionable (as determined by us).<br />
<br />
7. Your Contributions do not ridicule, mock, disparage, intimidate, or abuse anyone.<br />
<br />
8. Your Contributions are not used to harass or threaten (in the legal sense of those terms) any other person and to promote violence against a specific person or class of people.<br />
<br />
9. Your Contributions do not violate any applicable law, regulation, or rule.<br />
<br />
10. Your Contributions do not violate the privacy or publicity rights of any third party.<br />
<br />
11. Your Contributions do not contain any material that solicits personal information from anyone under the age of 18 or exploits people under the age of 18 in a sexual or violent manner.<br />
<br />
12. Your Contributions do not violate any applicable law concerning child pornography, or otherwise intended to protect the health or well-being of minors.<br />
<br />
13. Your Contributions do not include any offensive comments that are connected to race, national origin, gender, sexual preference, or physical handicap.<br />
<br />
14. Your Contributions do not otherwise violate, or link to material that violates, any provision of these Terms of Use, or any applicable law or regulation.<br />
<br />
Any use of the Application in violation of the foregoing violates these Terms of Use and may result in, among other things, termination or suspension of your rights to use the Application.</p>

<p>7. CONTRIBUTION LICENSE</p>

<p>By posting your Contributions to any part of the Application or making Contributions accessible to the Application by linking your account from the Application to any of your social networking accounts, you automatically grant, and you represent and warrant that you have the right to grant, to us an unrestricted, unlimited, irrevocable, perpetual, non-exclusive, transferable, royalty-free, fully-paid, worldwide right, and license to host, use copy, reproduce, disclose, sell, resell, publish, broad cast, retitle, archive, store, cache, publicly display, reformat, translate, transmit, excerpt (in whole or in part), and distribute such Contributions (including, without limitation, your image and voice) for any purpose, commercial advertising, or otherwise, and to prepare derivative works of, or incorporate in other works, such as Contributions, and grant and authorize sublicenses of the foregoing. The use and distribution may occur in any media formats and through any media channels.<br />
<br />
This license will apply to any form, media, or technology now known or hereafter developed, and includes our use of your name, company name, and franchise name, as applicable, and any of the trademarks, service marks, trade names, logos, and personal and commercial images you provide. You waive all moral rights in your Contributions, and you warrant that moral rights have not otherwise been asserted in your Contributions.<br />
<br />
We do not assert any ownership over your Contributions. You retain full ownership of all of your Contributions and any intellectual property rights or other proprietary rights associated with your Contributions. We are not liable for any statements or representations in your Contributions provided by you in any area in the Application. You are solely responsible for your Contributions to the Application and you expressly agree to exonerate us from any and all responsibility and to refrain from any legal action against us regarding your Contributions.<br />
<br />
We have the right, in our sole and absolute discretion, (1) to edit, redact, or otherwise change any Contributions; (2) to re-categorize any Contributions to place them in more appropriate locations in the Application; and (3) to pre-screen or delete any Contributions at any time and for any reason, without notice. We have no obligation to monitor your Contributions.</p>

<p>8. LIABILITY</p>

<p>8.1 Licensor&#39;s responsibility in the case of violation of obligations and tort shall be limited to intent and gross negligence. Only in case of a breach of essential contractual duties (cardinal obligations), Licensor shall also be liable in case of slight negligence. In any case, liability shall be limited to the foreseeable, contractually typical damages. The limitation mentioned above does not apply to injuries to life, limb, or health.<br />
<br />
8.2 Licensor takes no accountability or responsibility for any damages caused due to a breach of duties according to Section 2 of this Agreement. To avoid data loss, You are required to make use of backup functions of the Application to the extent allowed by applicable third-party terms and conditions of use. You are aware that in case of alterations or manipulations of the Application, You will not have access to licensed Application.</p>

<p>9. WARRANTY</p>

<p>9.1 Licensor warrants that the Application is free of spyware, trojan horses, viruses, or any other malware at the time of Your download. Licensor warrants that the Application works as described in the user documentation.<br />
<br />
9.2 No warranty is provided for the Application that is not executable on the device, that has been unauthorizedly modified, handled inappropriately or culpably, combined or installed with inappropriate hardware or software, used with inappropriate accessories, regardless if by Yourself or by third parties, or if there are any other reasons outside of tyt, LLC&#39;s sphere of influence that affect the executability of the Application.<br />
<br />
9.3 You are required to inspect the Application immediately after installing it and notify tyt, LLC about issues discovered without delay by e-mail provided in Product Claims. The defect report will be taken into consideration and further investigated if it has been mailed within a period of ninety (90) days after discovery.<br />
<br />
9.4 If we confirm that the Application is defective, tyt, LLC reserves a choice to remedy the situation either by means of solving the defect or substitute delivery.<br />
<br />
9.5 In the event of any failure of the Application to conform to any applicable warranty, You may notify the App-Store-Operator, and Your Application purchase price will be refunded to You. To the maximum extent permitted by applicable law, the App-Store-Operator will have no other warranty obligation whatsoever with respect to the App, and any other losses, claims, damages, liabilities, expenses and costs attributable to any negligence to adhere to any warranty.<br />
<br />
9.6 If the user is an entrepreneur, any claim based on faults expires after a statutory period of limitation amounting to twelve (12) months after the Application was made available to the user. The statutory periods of limitation given by law apply for users who are consumers.</p>

<p>10. PRODUCT CLAIMS</p>

<p>tyt, LLC and the End-User acknowledge that tyt, LLC, and not Apple, is responsible for addressing any claims of the End-User or any third party relating to the licensed Application or the End-User&rsquo;s possession and/or use of that licensed Application, including, but not limited to:<br />
<br />
(i) product liability claims;<br />
<br />
(ii) any claim that the licensed Application fails to conform to any applicable legal or regulatory requirement; and<br />
<br />
(iii) claims arising under consumer protection, privacy, or similar legislation, including in connection with Your Licensed Application&rsquo;s use.</p>

<p>11. LEGAL COMPLIANCE</p>

<p>You represent and warrant that You are not located in a country that is subject to a U.S. Government embargo, or that has been designated by the U.S. Government as a &quot;terrorist supporting&quot; country; and that You are not listed on any U.S. Government list of prohibited or restricted parties.</p>

<p>12. CONTACT INFORMATION</p>

<p>For general inquiries, complaints, questions or claims concerning the licensed Application, please contact:<br />
<br />
<strong>tyt, LLC<br />
6255 Towncenter Drive Ste 819<br />
Clemmons, NC 27012<br />
United States<br />
support@tyt.us </strong></p>

<p>13. TERMINATION</p>

<p>The license is valid until terminated by tyt, LLC or by You. Your rights under this license will terminate automatically and without notice from tyt, LLC if You fail to adhere to any term(s) of this license. Upon License termination, You shall stop all use of the Application, and destroy all copies, full or partial, of the Application.</p>

<p>14. THIRD-PARTY TERMS OF AGREEMENTS AND BENEFICIARY</p>

<p>tyt, LLC represents and warrants that tyt, LLC will comply with applicable third-party terms of agreement when using licensed Application.<br />
<br />
In Accordance with Section 9 of the &quot;Instructions for Minimum Terms of Developer&#39;s End-User License Agreement,&quot; Apple and Apple&#39;s subsidiaries shall be third-party beneficiaries of this End User License Agreement and - upon Your acceptance of the terms and conditions of this license agreement, Apple will have the right (and will be deemed to have accepted the right) to enforce this End User License Agreement against You as a third-party beneficiary thereof.</p>

<p>15. INTELLECTUAL PROPERTY RIGHTS</p>

<p>tyt, LLC and the End-User acknowledge that, in the event of any third-party claim that the licensed Application or the End-User&#39;s possession and use of that licensed Application infringes on the third party&#39;s intellectual property rights, tyt, LLC, and not Apple, will be solely responsible for the investigation, defense, settlement and discharge or any such intellectual property infringement claims.</p>

<p>16. APPLICABLE LAW</p>

<p>This license agreement is governed by the laws of the State of North Carolina excluding its conflicts of law rules.</p>

<p>17. MISCELLANEOUS</p>

<p>17.1 If any of the terms of this agreement should be or become invalid, the validity of the remaining provisions shall not be affected. Invalid terms will be replaced by valid ones formulated in a way that will achieve the primary purpose.<br />
<br />
17.2 Collateral agreements, changes and amendments are only valid if laid down in writing. The preceding clause can only be waived in writing.</p>',
                    'frimage' => 'xo6KnllBLUnJgI5fmRUxls8XepKjgA42fAXnbsdx.jpg',
                    'frtext' => '<h2>What you will need to apply with us</h2>

<ul>
<li>You must have a valid driver&rsquo;s license - Temporary or out-of-state licenses are also acceptable.</li>
<li>You must be 25 years or older to drive.</li>
<li>You must have a clean driving record with auto insurance.</li>
<li>You consent to our driver screening and background check.</li>
<li>You must own an iPhone or Android smartphone that can download and run the tyt Driver app.</li>
</ul>',
                    'srimage' => 'jVaKZ7cmFBp1uAuvjgn5sjxpeOEgSmMw8zduGTaf.jpg',
                    'srtext' => '<h2>Vehicle Requirements</h2>

<ul>
<li>2008 or newer**</li>
<li>4 doors</li>
<li>5-8 seats, including the driver&rsquo;s</li>
<li>North Carolina plates</li>
<li><strong>**Car year may vary by region </strong></li>
</ul>',
                    'trimage' => '1RexFkyPOi1BErCFKU8uYwMm9mL5VzuysTWRaxaJ.jpg',
                    'trtext' => '<h3>Document requirements</h3>

<ul>
<li>Driver profile photo</li>
<li>Vehicle registration</li>
<li>Personal vehicle insurance</li>
<li>North Carolina vehicle inspection</li>
</ul>',
                    'afrimage' => '9z3dVmaWgwUAtOQv4neyEfu5Oe58IZYfdfsCY5ZA.jpg',
                    'afrhtext' => '<h1><strong>Download the Driver Tagxi app Today</strong></h1>',
                    'afrstext' => '<p><strong>Good things happen when people can move, whether across town or toward their dreams. Opportunities </strong></p>

<p><strong>appear, open up, become reality.</strong></p>',
                    'asrtext' => '<h1><strong>Be your own boss</strong></h1>

<h3>Hours are completely flexible. Drive mornings, evenings, weekdays, or weekends.</h3>',
                    'asrimage1' => 'pOzcct0XNSuOSmSuWTDfP8ePmLMhZliODdQFwWTX.svg',
                    'asrhtext1' => '<h2><strong>Download</strong></h2>',
                    'asrstext1' => '<p>Download the Tagxi Driver App from the Google Play or App Store on your smartphone.</p>',
                    'asrimage2' => '5rNx2yDAFIbo90GugqyGWQ7UdpU9s0HPIDpZVmH2.svg',
                    'asrhtext2' => '<h2><strong>Upload</strong></h2>',
                    'asrstext2' => '<p>Upload your driver required documents in the app. Get Approved</p>',
                    'asrimage3' => 'OPx6uFwmzO5u99oNFgB9zXPRMkskpD491gmqPTAQ.svg',
                    'asrhtext3' => '<h2><strong>Drive!</strong></h2>',
                    'asrstext3' => '<p>Drive and earn as much as you want. Get paid weekly for the time and distance of a trip plus tips.</p>',
                    'atrhtext' => '<h2><strong>Why Drive with Tagxi</strong></h2>',
                    'atrthtext1' => '<p><strong>About us</strong></p>',
                    'atrtimage1' => 'CkXGI95QRqqefSia0gxn3CVeHxiALzoZgWFbaOJO.png',
                    'atrtstext1' => '<p>Tagxi is a rideshare platform facilitating peer to peer ridesharing by means of connecting passengers who are in need of rides from drivers with available cars to get from point A to point B with the press of a button. tyt is a clever 4 letter word that sounds like &quot;easy&quot; a fantastic connotation of effortless ease and accessibility to get you to your destination. tyt welcomes applicants year-round - summer, winter, fall, spring, and holiday work seekers.</p>',
                    'atrthtext2' => '<p>Our Mission</p>',
                    'atrtimage2' => 'wxZlB9jU3D51XbnxyhbeQMFXqNLgyHMUKIJ2WXx4.png',
                    'atrtstext2' => '<p>It&rsquo;s our goal to create a flexible working environment that is inclusive and reflects the diversity of the cities we serve&mdash;where everyone can be their authentic self, and where that authenticity is celebrated as a strength. By creating an environment where people from every background can thrive, we&rsquo;ll make tyt a better company&mdash;for our drivers and our customers.</p>',
                    'atrthtext3' => '<p>Driver Commitment</p>',
                    'atrtimage3' => 'laHGbcRZ8YbrFYXQcWq1HebYW4HhdnuvTOtD3CKH.png',
                    'atrtstext3' => '<p>We promise to provide the technology and the support needed to empower you to be your own boss, deciding on when and how often you drive. Let us take you places. Through our software, we take the guesswork and hassle out of securing your fare. We will always seek to apply technological advancements to the current process in order that the driver is fully equipped to operate in the given climate.</p>',
                    'afrbimage' => 'J47s4D1AxvdoB7YWbARxCpEexbT1puAR8NVHRUgr.jpg',
                    'afrlimage' => 'JIaEaUVL7Q5BpRHwxL3KbclM44BcYmsyIXvDdL7i.png',
                    'afrheadtext' => '<p><strong>Download the Driver App</strong></p>',
                    'afrstext1' => '<p><strong>Real-Time ETA Prediction</strong></p>',
                    'afrstext2' => '<p><strong>Customer Referral</strong></p>',
                    'afrstext3' => '<p><strong>In-App Chat</strong></p>',
                    'afrstext4' => '<p><strong>Emergency SOS Button</strong></p>',
                    'howbannerimage' => 'PNAhDhAI8UxQ21JUDxkm0ZAoRwjSMStz8Amg41aU.jpg',
                    'hfrht1' => '<h3>Get the app</h3>',
                    'hfrcimage1' => 'yJp1Givor2pcQZjmKHpwVObJPlN8gGFonIyM3bOy.png',
                    'hfrht2' => '<p>Get the app on Apple App Store or Google Play</p>',
                    'hsrht1' => '<p>You can complete the application in the tyt Driver App</p>',
                    'hsrcimage1' => '8EmDtFUTSOfgNddshqJksMDaKdjhdljkQtocoUXJ.png',
                    'hsrht2' => '<h3>Apply to drive</h3>',
                    'htrht1' => '<h3>Get Approved</h3>',
                    'htrcimage1' => '1v9jBpYjpsBxP0krKKN4eo16nGqotzQbCOViIEWV.png',
                    'htrht2' => '<p>After uploading your required documents and passing the background checks, you&rsquo;re ready to hit the road and start earning.</p>',
                    'hforht1' => '<p>Open the app and turn on driver mode</p>',
                    'hforcimage1' => 'LJPfXEJzwSDoebFVLyG3ye02Eu1EmUNdM2LzmdSA.png',
                    'hforht2' => '<p>Open the app</p>',
                    'hfirht1' => '<h3>Accept a passenger</h3>',
                    'hfircimage1' => '4xTQJVd9MJSQiQgsPrkxmWco5lfnKgPMTa0oS9Iu.png',
                    'hfirht2' => '<p>Accept a passenger ride request</p>',
                    'hsirht1' => '<p>Pick up your passenger at their location</p>',
                    'hsircimage1' => 'vzgfJTndfgLAHJZToPd2LgJ8NSshNW5jR3yasY52.png',
                    'hsirht2' => '<h3>Pick up</h3>',
                    'hserht1' => '<h3>Drop off</h3>',
                    'hsercimage1' => 'SH4JqHAeVXj9Mkz78giGIjxGqyob02kpjMk1fhFq.png',
                    'hserht2' => '<p>Drop off your passenger at their destination</p>',
                    'contactbanner' => 'INAO5d4sUN0rFwuobaHoRVwiof9c5So89YaxnaND.jpg',                    
                    'contacttext' => '<p>Get In Touch With Us</p>

<p>Have a question, inquiry or comment? Feel free to contact us. Simply fill in the contact form or just select your preferred channel and send us a message. We&rsquo;ll do everything we can to respond quickly.</p>

<p>&nbsp;</p>

<p><strong>Address: </strong><br />
60A/6A, Vilangurichi Road,Ramakrishnapuram, Saravanampatti,Coimbatore-641006.</p>

<p>&nbsp;</p>

<p><strong>Email: </strong><br />
Media Inquiries: <a href="mailto:media@tyt.us">media@tyt.us</a><br />
Partnership Inquiries: <a href="mailto:partner@tyt.us"> partner@tyt.us</a><br />
File a complaint: <a href="mailto:compliance@tyt.us"> compliance@tyt.us</a><br />
General Inquiries: <a href="mailto:info@tyt.us"> info@tyt.us</a></p>',                    
                    'contactmap' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3915.8124423896343!2d76.99306681417376!3d11.052684457057428!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ba85c1faf9dbe73%3A0x68dc9947d4882eff!2sTaxi%20Dispatch%20Software%2FSystem%20%7C%20White%20Label%20Taxi%20App%20-%20TagYourTaxi!5e0!3m2!1sen!2sin!4v1616142939290!5m2!1sen!2sin',                    
                    'driverioslink' => 'https://apps.apple.com/in/app/tagxi-driver/id1608868990',
                    'driverandroidlink' => 'https://play.google.com/store/apps/details?id=com.tagxi.operator"',
                    'userioslink' => 'https://apps.apple.com/in/app/tagxi/id1608868419',
                    'userandroidlink' => 'https://play.google.com/store/apps/details?id=com.tagxi.user',    
                    'menucolor'=>'#ffffff',
                    'menutextcolor'=>'#111',
                    'menutexthover'=>'#111',
                    'firstrowbgcolor'=>'#5cd7b1',
                    'hdriverdownloadcolor'=>'#111',
                    'hownumberbgcolor'=>'#31c1df',
                    'footerbgcolor'=>'#4f4f4f',
                    'created_at' => '0000-00-00',
                    'updated_at' => '2022-08-12',
                ),
            ));
        
        
        end:

    }
}