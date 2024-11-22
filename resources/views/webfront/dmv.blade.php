@extends('admin.layouts.web_header')

@section('title', 'Admin')

<style>
    .driver a.nav-link {
        display: block;
    }

    .nav-link.driver {
        background: var(--logo-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .nav-link.driver::before {
        content: "";
        position: absolute;
        left: .75rem;
        right: .75rem;
        bottom: .25rem;
        border-top: 2px solid #01f0ff;
    }
</style>

<div class="container pt-10 my-10">
    <div class="row">
        <div class="col-12 m-auto">
            @if($data)
                  {!! $data->dmv !!}   
            @endif
            <!--<h2 class="text-center">
                DMV check & background check consent
            </h2>
            <br><br>
            <h4>
                Consent to Request Driving Record
            </h4>
            <p>
                I understand that tyt, LLC. (‘Company’) will use Checkr., (‘Checkr, Inc.’) to obtain a motor vehicle record as part of the application process to be a driver on the tyt Platform (a ‘Driver’). I also understand that if accepted as a Driver, to the extent permitted by law, Company may obtain further Reports from Checkr Inc. so as to update, renew or extend my status as a Driver. I hereby give permission to tyt to obtain my state driving record (also known as my motor vehicle record or MVR) in accordance with the Federal Driver’s Privacy Protection Act (‘DPPA’) and applicable state law. I acknowledge and understand that my driving record is a consumer report that contains public record information. I authorize, without reservation any party or agency contacted by Company or Checkr Inc. to furnish Company a copy of my state driving record. This authorization shall remain on file by Company for the duration of my time as a Driver, and will serve as ongoing authorization for Company to procure my state driving record at any time while I am a Driver.
            </p>
            <h4>
                Consent to Request Consumer Report or Investigative Consumer Report Information
            </h4>
            <p>I understand that tyt, LLC. (‘Company’) will use Checkr Inc.,</p>
            <p>1 Montgomery St, Ste 2000, San Francisco, CA 94104</p>
            <p>to obtain a consumer report or investigative consumer report as part of the application process to be a driver on the tyt Platform (a ‘Driver’). I also understand that if accepted as a Driver, to the extent permitted by law, Company may obtain further Reports from Checkr so as to update, renew or extend my status as a Driver.</p>
            <p>I understand Checkr, Inc’s (“Checkr”) investigation may include obtaining information regarding my criminal record, subject to any limitations imposed by applicable federal and state law. I understand such information may be obtained through direct or indirect contact with public agencies or other persons who may have such knowledge.</p>
            <p>The nature and scope of the investigation sought will include a Criminal Background check and SSN Trace.</p>
            <p>I acknowledge receipt of the attached summary of my rights under the Fair Credit Reporting Act and, as required by law, any related state summary of rights (collectively “Summaries of Rights”).</p>
            <p>This consent will not affect my ability to question or dispute the accuracy of any information contained in a Report. I understand if Company makes a conditional decision to disqualify me based all or in part on my Report, I will be provided with a copy of the Report and another copy of the Summaries of Rights, and if I disagree with the accuracy of the purported disqualifying information in the Report, I must notify Company within five business days of my receipt of the Report that I am challenging the accuracy of such information with Checkr.</p>
            <p>I hereby consent to this investigation and authorize Company to procure a Report on my background.</p>
            <p>In order to verify my identity for the purposes of Report preparation, I am voluntarily releasing my date of birth, social security number and the other information and fully understand that all decisions are based on legitimate non-discriminatory reasons.</p>
            <p>The name, address and telephone number of the nearest unit of the consumer reporting agency designated to handle inquiries regarding the investigative consumer report is:</p>
            <p>
                <b>
                    Checkr, Inc. <br>
                    1 Montgomery St, Ste 2000, San Francisco, CA 94104 <br>
                    844-824-3257 <br><br>
                </b>
                <b>California, Maine, Massachusetts, Minnesota, New Jersey & Oklahoma Applicants Only:</b> I have the right to request a copy of any Report obtained by Company from Checkr by checking the box. (Check only if you wish to receive a copy)
            </p>
            <h4>New York Applicants Only</h4>
            <p>
                I also acknowledge that I have received the attached copy of Article 23A of New York’s Correction Law. I further understand that I may request a copy of any investigative consumer report by contacting Checkr. I further understand that I will be advised if any further checks are requested and provided the name and address of the consumer reporting agency.
            </p>
            <h4>California Applicants and Residents</h4>
            <p>
                If I am applying in California or reside in California, I understand I have the right to visually inspect the files concerning me maintained by an investigative consumer reporting agency during normal business hours and upon reasonable notice. The inspection can be done in person, and, if I appear in person and furnish proper identification; I am entitled to a copy of the file for a fee not to exceed the actual costs of duplication. I am entitled to be accompanied by one person of my choosing, who shall furnish reasonable identification. The inspection can also be done via certified mail if I make a written request, with proper identification, for copies to be sent to a specified addressee. I can also request a summary of the information to be provided by telephone if I make a written request, with proper identification for telephone disclosure, and the toll charge, if any, for the telephone call is prepaid by or directly charged to me. I further understand that the investigative consumer reporting agency shall provide trained personnel to explain to me any of the information furnished to me; I shall receive from the investigative consumer reporting agency a written explanation of any coded information contained in files maintained on me. “Proper identification” as used in this paragraph means information generally deemed sufficient to identify a person, including documents such as a valid driver’s license, social security account number, military identification card and credit cards. I understand that I can access the following website checkr.com privacy to view Checkr’s privacy practices, including information with respect to Checkr’s preparation and processing of investigative consumer reports and guidance as to whether my personal information will be sent outside the United States or its territories.
            </p>
            <h4>A Summary of Your Rights Under the Fair Credit Reporting Act</h4>
            <p>
                The federal Fair Credit Reporting Act (FCRA) promotes the accuracy, fairness, and privacy of information in the files of consumer reporting agencies. There are many types of consumer reporting agencies, including credit bureaus and specialty agencies (such as agencies that sell information about check writing histories, medical records, and rental history records). Here is a summary of your major rights under the FCRA. <b>For more information, including information about additional rights, go to www.consumerfinance.gov/learnmore or write to:</b>
            </p>
            <h4>
                Consumer Financial Protection Bureau <br>
                1700 G Street NW, Washington, DC 20552
            </h4>
            <p>
            <ul>
                <li class="pb-4">
                    You must be told if information in your file has been used against you. Anyone who uses a credit report or another type of consumer report to deny your application for credit, insurance, or employment – or to take another adverse action against you – must tell you, and must give you the name, address, and phone number of the agency that provided the information.
                </li>
                <li class="pb-4">
                    You have the right to know what is in your file. You may request and obtain all the information about you in the files of a consumer reporting agency (your “file disclosure”). You will be required to provide proper identification, which may include your Social Security number. In many cases, the disclosure will be free. You are entitled to a free file disclosure if:
                    <ol>
                        <li class="pb-2">
                            a person has taken adverse action against you because of information in your credit report;
                        </li>
                        <li class="pb-2">
                            you are the victim of identity theft and place a fraud alert in your file;
                        </li>
                        <li class="pb-2">
                            your file contains inaccurate information as a result of fraud;
                        </li>
                        <li class="pb-2">
                            you are on public assistance;
                        </li>
                        <li class="pb-2">
                            you are unemployed but expect to apply for employment within 60 days.
                        </li>
                    </ol>
                    In addition, all consumers are entitled to one free disclosure every 12 months upon request from each nationwide credit bureau and from nationwide specialty consumer reporting agencies. See www.consumerfinance.gov/learnmore for additional information.
                </li>
                <li class="pb-4">
                    You have the right to ask for a credit score. Credit scores are numerical summaries of your credit-worthiness based on information from credit bureaus. You may request a credit score from consumer reporting agencies that create scores or distribute scores used in residential real property loans, but you will have to pay for it. In some mortgage transactions, you will receive credit score information for free from the mortgage lender.
                </li>
                <li class="pb-4">
                    You have the right to dispute incomplete or inaccurate information. If you identify information in your file that is incomplete or inaccurate, and report it to the consumer reporting agency, the agency must investigate unless your dispute is frivolous. See www.consumerfinance.gov/learnmore for an explanation of dispute procedures.
                </li>
                <li class="pb-4">
                    Consumer reporting agencies must correct or delete inaccurate, incomplete, or unverifiable information. Inaccurate, incomplete or unverifiable information must be removed or corrected, usually within 30 days. However, a consumer reporting agency may continue to report information it has verified as accurate.
                </li>
                <li class="pb-4">
                    Consumer reporting agencies may not report outdated negative information. In most cases, a consumer reporting agency may not report negative information that is more than seven years old, or bankruptcies that are more than 10 years old.
                </li>
                <li class="pb-4">
                    Access to your file is limited. A consumer reporting agency may provide information about you only to people with a valid need – usually to consider an application with a creditor, insurer, employer, landlord, or other business. The FCRA specifies those with a valid need for access.
                </li>
                <li class="pb-4">
                    You must give your consent for reports to be provided to employers. A consumer reporting agency may not give out information about you to your employer, or a potential employer, without your written consent given to the employer. Written consent generally is not required in the trucking industry. For more information, go to www.consumerfinance.gov/learnmore
                </li>
                <li class="pb-4">
                    You may limit “prescreened” offers of credit and insurance you get based on information in your credit report. Unsolicited “prescreened” offers for credit and insurance must include a toll-free phone number you can call if you choose to remove your name and address from the lists these offers are based on. You may opt-out with the nationwide credit bureaus at 1-888-567-8688.
                </li>
                <li class="pb-4">
                    You may seek damages from violators. If a consumer reporting agency, or, in some cases, a user of consumer reports or a furnisher of information to a consumer reporting agency violates the FCRA, you may be able to sue in state or federal court.
                </li>
                <li class="pb-4">
                    Identity theft victims and active duty military personnel have additional rights. For more information, visit www.consumerfinance.gov/learnmore.
                </li>
            </ul>
            States may enforce the FCRA, and many states have their own consumer reporting laws. In some cases, you may have more rights under state law. For more information, contact your state or local consumer protection agency or your state Attorney General. For information about your federal rights, contact:
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table border">
                    <thead>
                        <tr class="text-center bg-light">
                            <th>
                                <h5>
                                    Type of business
                                </h5>
                            </th>
                            <th>
                                <h5>
                                    Contact
                                </h5>
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>
                                1.a. Banks, savings associations, and credit unions with total assets of over $10 billion and their affiliates.
                            </td>
                            <td>
                                a. Consumer Financial Protection Bureau
                                1700 G Street NW, Washington, DC 20552
                            </td>
                        </tr>

                        <tr>
                            <td>
                                1.b. Such affiliates that are not banks, savings associations, or credit unions also should list, in addition to the CFPB:
                            </td>
                            <td>
                                b. Federal Trade Commission: Consumer Response Center – FCRA
                                Washington, DC 20580
                                877-382-4357
                            </td>
                        </tr>

                    </tbody>

                    <tbody>
                        <tr class="bg-light">
                            <td colspan="2">
                                <h6 class="text-center">
                                    To the extent not included in item 1 above
                                </h6>
                            </td>
                        </tr>
                    </tbody>

                    <tbody>

                        <tr>
                            <td>
                                2.a. National banks, federal savings associations, and federal branches and federal agencies of foreign banks
                            </td>
                            <td>
                                a. Office of the Comptroller of the Currency Customer Assistance Group
                                1301 McKinney Street Suite 3450, Houston, TX 77010-9050
                            </td>
                        </tr>

                        <tr>
                            <td>
                                2.b. State member banks, branches and agencies of foreign banks (other than federal branches, federal agencies, and Insured State Branches of Foreign Banks), commercial lending companies owned or controlled by foreign banks, and organizations operating under section 25 or 25A of the Federal Reserve Act
                            </td>
                            <td>
                                b. Federal Reserve Consumer Help Center
                                P.O. Box 1200 Minneapolis, MN 55480
                            </td>
                        </tr>

                        <tr>
                            <td>
                                2.c. Nonmember Insured Banks, Insured State Branches of Foreign Banks, and insured state savings associations
                            </td>
                            <td>
                                c. FDIC Consumer Response Center
                                1100 Walnut Street Box #11, Kansas City, MO 64106
                            </td>
                        </tr>

                        <tr>
                            <td>
                                2.d. Federal Credit Unions
                            </td>
                            <td>
                                d. National Credit Union Administration Office of Consumer Protection (OCP), Division of Consumer Compliance and Outreach (DCCO)
                                1775 Duke Street, Alexandria, VA 22314
                            </td>
                        </tr>

                    </tbody>

                    <tbody>
                        <tr>
                            <td>
                                3. Air carriers
                            </td>
                            <td>
                                Asst. General Counsel for Aviation Enforcement & Proceedings Aviation Consumer Protection Division Department of Transportation 1200 New Jersey Avenue SE, Washington, DC 20590
                            </td>
                        </tr>
                    </tbody>

                    <tbody>
                        <tr>
                            <td>
                                4. Creditors Subject to Surface Transportation Board
                            </td>
                            <td>
                                Office of Proceedings, Surface Transportation Board, Department of Transportation 395 E Street SW, Washington, DC 20423
                            </td>
                        </tr>
                    </tbody>

                    <tbody>
                        <tr>
                            <td>
                                5. Creditors Subject to Packers and Stockyards Act, 1921
                            </td>
                            <td>
                                Nearest Packers and Stockyards Administration area supervisor
                            </td>
                        </tr>
                    </tbody>

                    <tbody>
                        <tr>
                            <td>
                                6. Small Business Investment Companies
                            </td>
                            <td>
                                Associate Deputy Administrator for Capital Access, United States Small Business Administration 409 Third Street SW 8th Floor, Washington, DC 20416
                            </td>
                        </tr>
                    </tbody>

                    <tbody>
                        <tr>
                            <td>
                                7. Brokers and Dealers
                            </td>
                            <td>
                                Securities and Exchange Commission 100 F St NE, Washington, DC 20549
                            </td>
                        </tr>
                    </tbody>

                    <tbody>
                        <tr>
                            <td>
                                8. Federal Land Banks, Federal Land Bank Associations, Federal Intermediate Credit Banks, and Production Credit Associations
                            </td>
                            <td>
                                Farm Credit Administration, 1501 Farm Credit Drive, McLean, VA 22102-5090
                            </td>
                        </tr>
                    </tbody>

                    <tbody>
                        <tr>
                            <td>
                                9. Retailers, Finance Companies, and All Other Creditors Not Listed Above
                            </td>
                            <td>
                                FTC Regional Office for region in which the creditor operates or Federal Trade Commission: Consumer Response Center – FCRA Washington, DC 20580 877-382-4357
                            </td>
                        </tr>
                    </tbody>

                </table>
            </div>-->
        </div>
    </div>

</div>

@extends('admin.layouts.web_footer')
