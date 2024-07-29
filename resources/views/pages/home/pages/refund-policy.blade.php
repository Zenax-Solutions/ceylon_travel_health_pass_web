@extends('layouts.app')
@section('content')
    <!-- Live Chat -->
    @include('pages.home.components.chatwidget')

    <main class="container mx-auto p-6 bg-white rounded mt-6">
        <div class="WordSection1" style="color: black;font-weight: 400;padding: 20px;">
            <h1 class="text-2xl font-bold text-gray-900 mb-4">Ceylon Travel and Health (Pvt) Ltd.</h1>
            <h2 class="text-xl font-semibold text-gray-800 mb-3">Cancellation and Refund Policy</h2>
            <p class="mb-4">At Ceylon Travel and Health (PVT) LTD, we strive to provide our customers with the best
                possible
                experience. We understand that plans can change, so we've designed a cancellation and refund policy to
                address
                these changes fairly and transparently. This policy outlines the terms and conditions under which you can
                cancel
                your Ceylon Travel Pass and the associated refunds or fees.</p>
            <p class="mb-4">This policy is applicable to all Ceylon Travel Pass purchases made via our website or approved
                partners.</p>

            <h3 class="text-lg font-semibold text-gray-700 mb-2">Cancellation Timeframes and Refunds</h3>
            <ul class="list-disc pl-6 mb-4">
                <li>Cancellation of the pass can be made by the user at any time before the said pass is first used.</li>
                <li>Cancellation shall not be allowed when the user uses the QR code at any instance.</li>
            </ul>

            <h3 class="text-lg font-semibold text-gray-700 mb-2">How to Cancel</h3>
            <p class="mb-4">To cancel your Ceylon Travel Pass, please contact our customer service team at <a
                    href="mailto:marketing@ceylontp.com" class="text-blue-500 underline">marketing@ceylontp.com</a>.</p>

            <h3 class="text-lg font-semibold text-gray-700 mb-2">Modification of Pass</h3>
            <p class="mb-4">Modifications to your Ceylon Travel Pass, such as changing the dates or adding additional
                attractions, are allowed up to 2 weeks before the first attraction visit. A modification fee would be
                charged.
            </p>

            <h3 class="text-lg font-semibold text-gray-700 mb-2">Special Circumstances</h3>
            <p class="mb-4">In the event of unforeseen circumstances such as natural disasters or emergencies, please
                contact
                our customer service team. We will review each case individually to determine the best course of action,
                which
                may include offering a full or partial refund or rescheduling your visit.</p>

            <h3 class="text-lg font-semibold text-gray-700 mb-2">Rescheduling Policy</h3>
            <p class="mb-4">Reservations may be rescheduled if notice is provided at least one week prior to the scheduled
                date. A rescheduling fee of $5 will apply.</p>

            <h3 class="text-lg font-semibold text-gray-700 mb-2">Policy Changes</h3>
            <p class="mb-4">We reserve the right to modify this cancellation policy at any time. Any changes will be
                communicated to customers through email or an announcement on our website. The revised policy will apply to
                purchases made after the date of the change.</p>

            <h3 class="text-lg font-semibold text-gray-700 mb-2">Refunds</h3>
            <h4 class="text-md font-semibold text-gray-600 mb-2">Eligibility for Refunds</h4>
            <ul class="list-disc pl-6 mb-4">
                <li>Unused Ceylon Travel Passes: Full refunds are available for Ceylon Travel Passes that have not been
                    activated or used.</li>
                <li>Medical Emergencies: Full refunds are available for tourists who are unable to use their Ceylon Travel
                    Pass
                    due to medical emergencies, upon providing appropriate documentation.</li>
                <li>Cancellation: Cancellations made in accordance with the cancellation policy above.</li>
            </ul>

            <h4 class="text-md font-semibold text-gray-600 mb-2">Lost or Stolen Passes</h4>
            <p class="mb-4">Ceylon Travel Passes that have been lost or stolen are not eligible for refunds. However,
                Ceylon
                Travel and Health (Pvt) Ltd (CTH) may issue a replacement Ceylon Travel Pass upon successful verification of
                the
                pass holder's identity and the validity of the claim. The pass holder must promptly report the loss or theft
                to
                CTH and provide any requested proof of purchase or identification. The issuance of a replacement pass is
                subject
                to CTH's discretion and may involve an administrative fee. CTH is not liable for any unauthorized use of the
                lost or stolen pass prior to it being reported.</p>

            <h4 class="text-md font-semibold text-gray-600 mb-2">Time Frame for Refund Requests</h4>
            <ul class="list-disc pl-6 mb-4">
                <li>Unused Ceylon Travel Passes: Refund requests must be submitted within 45 days of the purchase date.</li>
                <li>Medical Emergencies: Refund requests due to medical emergencies must also be submitted within 30 days of
                    the
                    incident, along with the necessary medical documentation.</li>
            </ul>

            <h4 class="text-md font-semibold text-gray-600 mb-2">Non-Refundable Situations</h4>
            <ul class="list-disc pl-6 mb-4">
                <li>Expired Ceylon Travel Passes: Ceylon Travel Passes that have expired are not eligible for refunds.</li>
                <li>Lost or Stolen Ceylon Travel Passes: Ceylon Travel Passes that have been lost or stolen are not eligible
                    for
                    refunds. However, we may issue a replacement Ceylon Pass upon verification.</li>
                <li>Attraction Closures: Refunds are not available for attractions that are closed due to unforeseen
                    circumstances. However, we will make every effort to offer alternative options or extend the validity of
                    the
                    Ceylon Travel Pass.</li>
            </ul>

            <h4 class="text-md font-semibold text-gray-600 mb-2">How to Claim</h4>
            <ol class="list-decimal pl-6 mb-4">
                <li>Submit a Request: Reach out to our customer support team via email at <a
                        href="mailto:marketing@ceylontp.com" class="text-blue-500 underline">marketing@ceylontp.com</a> or
                    through our web-based platform. Please include your purchase details and the reason for your refund
                    request.
                </li>
                <li>Documentation: If your refund request is due to a medical emergency, attach the necessary medical
                    documentation.</li>
                <li>Review: Our team will review your request and respond within 3 business days.</li>
                <li>Approval and Processing: If approved, refunds will be processed within 30 business days to the original
                    method of payment.</li>
            </ol>
        </div>
    </main>
@endsection
