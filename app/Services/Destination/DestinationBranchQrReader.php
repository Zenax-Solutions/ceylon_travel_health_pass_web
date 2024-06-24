<?php

namespace App\Services\Destination;

use App\Models\DestinationQrScanRecord;
use App\Models\Ticket;
use Carbon\Carbon;

class DestinationBranchQrReader
{
    public function read($selection, Ticket $record)
    {

        $destinationList = $record->booking->destination_list;

        if ($destinationList != null) {

            // Check if the selection (shop_id) is in the discount_shop_list of the package
            if (in_array($selection, $destinationList)) {
                // Check if there's a DiscountShopQrRecord with the given shop_id and ticket_id
                $existingRecord = DestinationQrScanRecord::where('destination_id', $selection)
                    ->where('ticket_id', $record->ticket_id)
                    ->first();

                // Check if the ticket expiry date is set
                if (!empty($record->expiry_date)) {
                    // Check if the ticket is expired
                    if (now()->greaterThan($record->expiry_date)) {

                        $record->update([
                            'status' => 'expired',
                        ]);

                        return 'expired'; // Return 'expired' if the ticket is expired
                    }
                }

                if ($existingRecord) {
                    // Record already exists, return message indicating the ticket is used
                    return 'used';
                } else {
                    // Create a new DiscountShopQrRecord since it doesn't exist
                    DestinationQrScanRecord::create([
                        'destination_id' => $selection,
                        'ticket_id' => $record->ticket_id,
                        'date' => now()
                    ]);

                    // Update expiry dates for other tickets associated with the same booking ID
                    $this->updateOtherTicketExpiryDates($record);

                    return 'valid'; // Return 'valid' if the operation succeeded
                }
            } else {
                return 'invalid'; // Return 'invalid' if the selection is not in the discount_shop_list
            }
        } else {
            return 'invalid';
        }
    }

    private function updateOtherTicketExpiryDates(Ticket $record)
    {
        // Find all tickets related to the same booking ID
        $otherTickets = Ticket::where('booking_id', $record->booking_id)
            ->where('id', '!=', $record->ticket_id) // Exclude the current ticket
            ->get();


        $currentDate = Carbon::now();

        // Add 60 days to the current date to get the expiration date
        $expirationDate = $currentDate->addDays($record->booking->package->expire_days_count);

        // Format the expiration date if needed
        $formattedExpirationDate = $expirationDate->toDateString();

        // Update expiry date for each ticket if it's not already set
        foreach ($otherTickets as $ticket) {
            if (empty($ticket->expiry_date)) { // Check if expiry date is not already set
                // Example of updating expiry date (you need to define your expiry update logic)
                $ticket->expiry_date =  $formattedExpirationDate; // Set expiry date to package expiry date
                $ticket->save();
            }
        }
    }
}
