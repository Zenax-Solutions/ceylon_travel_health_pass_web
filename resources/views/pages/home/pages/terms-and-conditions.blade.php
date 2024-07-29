@extends('layouts.app')
@section('content')
    <!-- Live Chat -->
    @include('pages.home.components.chatwidget')

    <main class="container mx-auto p-6 bg-white rounded mt-6">
        <div class="WordSection1" style="color: black;font-weight: 400;padding: 20px;">
            <div style="page-break-before:always; page-break-after:always">
                <div>
                    <p><b>CEYLON TRAVEL PASS <br />01]WHAT IS CEYLON TRAVEL PASS. <br /></b></p>
                    <p>Ceylon Travel Pass is a web-based application that provides a single QR code system for
                        <br />accessing
                        multiple attractions and enjoying various benefits across Sri Lanka. <br /></p>
                    <p><b>02]ACCEPTANCE OF TERMS <br /></b></p>
                    <p>By purchasing and using the Ceylon Travel Pass powered by Ceylon Travel and Health <br />(PVT) LTD
                        (&quot;Ceylon Travel Pass&quot;), you agree to be bound by these terms and conditions. <br /></p>
                    <p><b>USER</b>: Any individual who has purchased a Ceylon Travel Pass shall be considered a User. By
                        <br />purchasing and utilizing the Ceylon Travel Pass, the User affirms that all details provided
                        are
                        <br />accurate and legitimate. The User consents to the validity and use of this information as
                        necessary
                        <br />for the provision of services. <br />
                    </p>
                    <p><b>03]PRODUCT USED AND VALIDITY. <br /></b></p>
                    <p>a. When the Ceylon Travel Pass is purchased by an individual, it is strictly non-<br />transferable.
                        The
                        Ceylon Travel pass cannot be sold, shared, or used by any <br />person other than the original
                        purchaser.
                        Any attempt to transfer the pass to <br />another individual will render it invalid and thus
                        unlawful.
                        <br />
                    </p>
                    <p>b. The pass shall be valid only for the use the pass is purchased for i.e. For locations
                        <br />purchased by
                        the user and shall not be valid as an exclusive pass for all locations. <br /></p>
                    <p>c. In the case where the Ceylon Travel Pass is purchased by a registered. <br />Personal/agent of
                        Ceylon
                        travel pass, Ceylon travel and health pass will grant the <br />right to sell and transfer the pass
                        to their
                        clients. The authorized personnel/agent is <br />responsible for ensuring that all terms and
                        conditions of
                        the pass are <br />communicated to and adhered to by the end users. <br /></p>
                    <p>d. It must be used before its expiration date or within its stated validity period <br />mentioned in
                        the
                        pass at the time of issuance. <br /></p>
                    <p>e. Misusing, such as using it for multiple admissions or other unauthorized purposes, <br />is
                        considered
                        illegal. <br /></p>
                    <p>f. You accept responsibility for each Ceylon Travel Pass you purchase and agree to <br />have your
                        credit
                        card charged for any misuse. Misuse is defined as any unauthorized <br />sharing, reproduction, or
                        alteration of the QR code, providing false or misleading <br />information, using the pass for
                        fraudulent
                        activities, or violating any terms and <br />conditions set forth by Ceylon Travel and Health (Pvt)
                        Ltd.
                        <br />
                    </p>
                    <p>g. Any misuse may result in the Ceylon Travel Pass being void without a refund. <br />h. The Ceylon
                        Travel
                        Pass cannot be combined with other discounts unless <br /></p>
                    <p>specifically stated. <br />i. Individuals over the child age range, which is age 6 to 12, must
                        purchase an
                        adult <br /></p>
                    <p>pass, and attractions may deny entry to anyone over the child age range using a <br />child pass.
                        <br /></p>
                    <p> </p>

                </div>
            </div>
            <div style="page-break-before:always; page-break-after:always">
                <div>
                    <p><b>3.1.Group Pass. <br /></b></p>
                    <p>The Ceylon Travel Pass can also be issued as a Group Pass, allowing multiple individuals to
                        <br />benefit
                        from it under a single purchase. The Group Pass is designed for families, friends, or any
                        <br />group of
                        people who wish to explore attractions together. <br /></p>
                    <p>&#8226; <b>Issuance</b>: At the time of purchase, the primary purchaser must provide the names and
                        <br />relevant details of all individuals who will be using the Group Pass. This information
                        <br />must be
                        accurate and legitimate to ensure smooth access to the attractions. <br />
                    </p>
                    <p>&#8226; <b>Usage</b>: The Group Pass must be used collectively by the designated group members as
                        <br />specified at the time of issuance. All members of the group must be present at the time of
                        <br />entry
                        to any attraction or service to validate the Group Pass. Partial or individual use of <br />the
                        Group Pass
                        by non-designated members is strictly prohibited. <br />
                    </p>
                    <p>&#8226; <b>Responsibility</b>: The primary purchaser of the Group Pass assumes full responsibility
                        for
                        <br />its proper use. Any misuse, including unauthorized sharing, reproduction, or alteration of
                        <br />the
                        Group Pass, will result in the primary purchaser being held accountable and may <br />incur
                        additional
                        charges or penalties. <br />
                    </p>
                    <p>&#8226; <b>Validity</b>: The Group Pass is valid only for the duration and terms specified at the
                        time of
                        <br />purchase. Any changes to the designated group members must be reported to Ceylon <br />Travel
                        and
                        Health (Pvt) Ltd and approved in advance. <br />
                    </p>
                    <p>By purchasing a Group Pass, the primary purchaser and all designated group members agree to
                        <br />adhere to
                        these terms and conditions and any other rules set forth by Ceylon Travel and Health <br />(Pvt)
                        Ltd. <br />
                    </p>
                    <p><b>3.2. Complimentary Pass <br /></b></p>
                    <p>Ceylon Travel and Health (Pvt) Ltd (CTH) reserves the right to limit and adjust the products and
                        <br />services offered through complimentary passes. Complimentary passes are provided as a
                        <br />goodwill
                        gesture and may include access to selected attractions, discounts, or other benefits as
                        <br />determined by
                        CTH. <br />
                    </p>
                    <p>&#8226; <b>Issuance and Validity</b>: Complimentary passes are issued at the discretion of CTH and
                        <br />may
                        be subject to specific terms and conditions, including but not limited to expiration <br />dates,
                        limited
                        usage, and designated beneficiaries. The validity period and eligible <br />benefits will be clearly
                        communicated at the time of issuance. <br /></p>
                    <p>&#8226; <b>Limitations</b>: CTH holds the right to limit the number and type of attractions,
                        discounts,
                        <br />or services included in complimentary passes. This may vary based on promotional <br />offers,
                        partnerships, or seasonal adjustments. Complimentary passes may not include all <br />the benefits
                        available
                        to regular Ceylon Travel Pass holders. <br />
                    </p>
                    <p>&#8226; <b>Adjustments</b>: CTH may adjust the products and services offered through complimentary
                        <br />passes at any time without prior notice. Such adjustments may include adding, removing,
                        <br />or
                        substituting attractions, discounts, or services. These changes will be communicated to <br />the
                        pass
                        holders as soon as possible. <br />
                    </p>
                    <p>&#8226; <b>Non-Transferable</b>: Complimentary passes are non-transferable and must be used by the
                        <br />individual or group to whom they were issued. Any unauthorized use, sharing, or
                    </p>

                </div>
            </div>
            <div style="page-break-before:always; page-break-after:always">
                <div>
                    <p>reproduction of complimentary passes will be considered misuse and may result in <br />revocation of
                        the pass
                        and possible additional charges. <br /></p>
                    <p>By accepting a complimentary pass, the holder agrees to adhere to these terms and conditions
                        <br />and
                        acknowledges that CTH retains the right to make any necessary adjustments to the benefits
                        <br />provided.
                        <br />
                    </p>
                    <p><b>04]DISCOUNTS AND OFFERS <br /></b></p>
                    <p>&#8226; By purchasing, redeeming, and/or using the Ceylon Travel Pass powered by Ceylon Travel
                        <br />and
                        Health (PVT) LTD, you agree to the terms and conditions set forth by Ceylon Travel <br />and Health
                        (PVT)
                        LTD. The company reserves the right to limit the number of <br />shops/services eligible to offer
                        discounts
                        based on the packages offered. Each category of <br />shops/services may have specific limitations.
                        Once a
                        Ceylon Travel Pass QR code is used <br />at a shop/service, it cannot be used again at the same
                        shop/service. Partnered businesses <br />offer exclusive discounts to Ceylon Travel Pass holders,
                        which are
                        subject to change and <br />availability. Users must present their Ceylon Travel Pass (QR code) at
                        the time
                        of purchase <br />to redeem the discounts. <br /></p>
                    <p>&#8226; Discounts cannot be combined with other promotions or offers unless explicitly specified
                        <br />by the
                        partnered business. Some discounts may have specific conditions, such as minimum <br />purchase
                        requirements
                        or validity during certain periods. Users are encouraged to check <br />the Ceylon Travel Pass
                        platform
                        regularly for the latest discount information and terms. <br />Discounts are non-transferable and
                        applicable
                        only to the named Ceylon Travel Pass <br />holder. They do not cover taxes, gratuities, or
                        additional fees
                        unless specified otherwise by <br />the partnered business. Misuse of discounts, including
                        fraudulent
                        activities(define it), may <br />result in the forfeiture of the discount and cancellation of the
                        Ceylon
                        Travel Pass without <br />a refund. Partnered businesses reserve the right to refuse discounts if
                        any terms
                        and <br />conditions are violated. <br /></p>
                    <p><b>05]EXCLUSION OF LIABILITY:</b> <br /></p>
                    <p>To the fullest extent permitted by law, the Company, its directors, employees, and agents <br />shall
                        not be
                        liable for any direct, indirect, incidental, special, or consequential damages <br />arising out of
                        or in
                        connection with the use of the Ceylon Pass, including, but not limited <br />to, damages for loss of
                        profits, goodwill, use, data, or other intangible losses. <br /></p>
                    <p>The Company shall not be liable for any personal injury, property damage, or any other <br />harm or
                        damage
                        that may result from Users' use of the Ceylon Pass or from the conduct of <br />any third-party
                        attractions
                        or businesses. <br /></p>
                    <p><b>06]RETURN POLICY</b> <br /></p>
                    <p>This 90-Day Refund Policy (&quot;Policy&quot;) applies to all users (&quot;Users&quot;) of the Ceylon
                        Pass
                        <br />provided by Ceylon Travel and Health (Pvt) Ltd (&quot;Company&quot;). By purchasing and using
                        <br />the Ceylon Pass, Users agree to be bound by the terms and conditions outlined in this
                    </p>

                </div>
            </div>
            <div style="page-break-before:always; page-break-after:always">
                <div>
                    <p>Policy. If Users do not agree to these terms, they should not purchase or use the Ceylon <br />Pass.
                        <br />
                    </p>
                    <p>Users are eligible for a refund under this Policy if they have purchased the Ceylon Pass
                        <br />directly from
                        the Company and wish to cancel within 90 days of the purchase date. <br /></p>
                    <p> Refunds are only applicable to the original purchase amount paid by the User. Any <br />additional
                        costs
                        incurred by the User, such as transaction fees or charges, are non-<br />refundable. <br /></p>
                    <p>To request a refund, Users must contact the Company's customer service department <br />within 90
                        days of the
                        purchase date. Refund requests made after this period will not be <br />considered. <br /></p>
                    <p>Users can contact customer service via [contact details: phone number, email address]. <br /></p>
                    <p>The refund request must include the User's full name, contact information, date of <br />purchase,
                        and reason
                        for requesting a refund. <br /></p>
                    <p>Refunds will only be processed for Users who meet the eligibility criteria outlined in <br />section
                        2.
                        <br />
                    </p>
                    <p> The Company reserves the right to refuse refunds if it suspects fraudulent activity, <br />misuse of
                        the
                        Ceylon Pass, or if the User fails to provide necessary information as <br />requested. <br /></p>
                    <p>Once a refund request is received and approved, the Company will process the refund <br />within 14
                        business
                        days. <br /></p>
                    <p> Refunds will be issued using the same method of payment used for the original purchase. <br />If
                        this is not
                        possible, the Company will arrange an alternative method with the User. <br /></p>
                    <p>The Ceylon Pass and any associated benefits are non-transferable. Refunds are only <br />applicable
                        to the
                        original purchaser and cannot be transferred to another individual. <br /></p>
                    <p>The Company does not offer partial refunds for unused portions of the Ceylon Pass or for <br />any
                        period
                        beyond the initial 90 days from the purchase date. <br /></p>
                    <p>The Company reserves the right to amend this Refund Policy at any time without prior <br />notice.
                        Any
                        changes will be effective immediately upon being posted on the Company&#8217;s <br />website or
                        through
                        other communication channels. <br /></p>
                    <p><b>07] USE OF SERVICES</b> </p>

                </div>
            </div>
            <div style="page-break-before:always; page-break-after:always">
                <div>
                    <p>Users must be at least 18 years old or have reached the legal age of majority in their jurisdiction
                        <br />to
                        use the Company's services. By using the Company's services, Users represent and warrant <br />that
                        they
                        meet this requirement. <br /></p>
                    <p>Users agree to use the Company's services and products solely for lawful purposes and in
                        <br />accordance
                        with these Terms and any applicable laws and regulations. <br /></p>
                    <p>The Company reserves the right to refuse service, terminate accounts, or cancel orders at its
                        <br />discretion, including but not limited to cases of suspected fraud, misuse, or violation of
                        these
                        <br />Terms. <br />
                    </p>
                    <p><b>08] INTELLECTUAL PROPERTY</b> <br /></p>
                    <p>All intellectual property rights associated with the Company's services and products, including
                        <br />but not
                        limited to trademarks, logos, and content, are owned by the Company or its licensors. <br /></p>
                    <p>Users are granted a limited, non-exclusive, non-transferable license to use the Company's
                        <br />services and
                        products for personal and non-commercial purposes only. Users must not reproduce, <br />distribute,
                        modify,
                        or create derivative works of any content without prior written consent from <br />the Company.
                        <br /></p>
                    <p><b>09] PRIVACY AND DATA PROTECTION</b> <br /></p>
                    <p>The Company collects, uses, and processes personal information in accordance with its Privacy
                        <br />Policy,
                        available on the Company's website. <br /></p>
                    <p>By using the Company's services, Users consent to the collection, use, and processing of their
                        <br />personal
                        information as described in the Privacy Policy. <br /></p>
                    <p><b>10] LIMITATION OF LIABILITY</b> <br /></p>
                    <p>To the fullest extent permitted by law, the Company shall not be liable for any direct, indirect,
                        <br />incidental, special, or consequential damages arising out of or in connection with the use of
                        its
                        <br />services or products, including but not limited to damages for loss of profits, goodwill, use,
                        data,
                        <br />or other intangible losses. <br />
                    </p>
                    <p>The Company's liability under these Terms shall be limited to the amount paid by the User for
                        <br />the
                        services or products giving rise to the claim. <br /></p>
                    <p><b>11] INDEMNIFICATION</b> <br /></p>
                    <p>Users agree to indemnify and hold harmless the Company, its directors, employees, agents, and
                        <br />affiliates from and against any claims, damages, losses, liabilities, and expenses (including
                        <br />reasonable legal fees) arising out of or in connection with their use of the Company's
                        services or
                        <br />products, their violation of these Terms, or their violation of any rights of any third party.
                    </p>

                </div>
            </div>
            <div style="page-break-before:always; page-break-after:always">
                <div>
                    <p> <br /></p>
                    <p><b>12]CONTACT INFORMATION <br /></b></p>
                    <p>&#8226; For any questions or concerns regarding the Ceylon Travel Pass, please contact our
                        <br />customer
                        support team at marketing@ceylontp.com or 070-699-7999. <br /></p>
                    <p><b> </b></p>

                </div>
            </div>
        </div>
    </main>
@endsection
