<?php

namespace App\Services\Agents;

use App\Models\ServiceQrScanRecord;
use App\Models\Ticket;

class DiscountServicesQrReader
{
    public function read($selection, Ticket $record)
    {

        $discountShopList = $record->booking->package->discount_service_list;

        // Check if the selection (shop_id) is in the discount_shop_list of the package
        if (in_array($selection, $discountShopList)) {
            // Check if there's a DiscountShopQrRecord with the given shop_id and ticket_id
            $existingRecord = ServiceQrScanRecord::where('service_id', $selection)
                ->where('ticket_id', $record->ticket_id)
                ->first();

            if ($existingRecord) {
                // Record already exists, return message indicating the ticket is used
                return 'used';
            } else {
                // Create a new DiscountShopQrRecord since it doesn't exist
                ServiceQrScanRecord::create([
                    'service_id' => $selection,
                    'ticket_id' => $record->ticket_id,
                    'date' => now()
                ]);

                return 'valid'; // Return 'valid' if the operation succeeded
            }
        } else {
            return 'invalid'; // Return 'invalid' if the selection is not in the discount_shop_list
        }
    }
}
