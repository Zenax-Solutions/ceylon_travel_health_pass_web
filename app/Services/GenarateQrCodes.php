<?php

namespace App\Services;

use App\Mail\SendTickets;
use App\Models\Ticket;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class GenarateQrCodes
{
    protected  $tickets = [];
    protected   $qrCodes = [];

    public function __construct()
    {
        // Initialization code...
    }

    public function genarate($data, $bookig, $customer,$regionality=null)
    {
        try {
            // Get the current date
            $currentDate = Carbon::now();

            // Add 60 days to the current date to get the expiration date
            $expirationDate = $currentDate->addDays($bookig->package->expire_days_count);

            // Format the expiration date if needed
            $formattedExpirationDate = $expirationDate->toDateString();

       
            Log::info($data->adult_pass_count);


            // Generate adult tickets
            for ($i = 0; $i < $data['adult_pass_count']; $i++) {
                $ticketNumber = Str::uuid()->toString();
                $ticket = Ticket::create([
                    'booking_id' => $bookig->id,
                    'ticket_id' => $ticketNumber,
                    'is_adult' => true,
                    'regionality' => $regionality,
                    //'expiry_date' => $formattedExpirationDate,
                    'status' => 'active'
                ]);

                $tickets[] = $ticket;

                $qrCode = QrCode::format('png')->size(200)->generate($ticketNumber);
                $qrCodePath = "tickets/{$ticketNumber}.png";
                Storage::disk('public')->put($qrCodePath, $qrCode);
            }

            // Generate child tickets
            for ($i = 0; $i < $data['child_pass_count']; $i++) {

                $ticketNumber = Str::uuid()->toString();
                $ticket = Ticket::create([
                    'booking_id' => $bookig->id,
                    'ticket_id' => $ticketNumber,
                    'is_adult' => false,
                    //'expiry_date' => $formattedExpirationDate,
                    'regionality' => $regionality,
                    'status' => 'active'
                ]);
                $tickets[] = $ticket;

                $qrCode = QrCode::format('png')->size(200)->generate($ticketNumber);
                $qrCodePath = "tickets/{$ticketNumber}.png";
                Storage::disk('public')->put($qrCodePath, $qrCode);
            }

            Mail::to($customer->email)->send(new SendTickets($bookig));
        } catch (\Exception $e) {
            // Log any exceptions thrown during QR code generation
            Log::error("Failed to send email: $ticketNumber. Error: {$e->getMessage()}");
        }
    }
}
