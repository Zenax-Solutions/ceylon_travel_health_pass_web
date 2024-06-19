<?php

namespace App\Services\Agents;

use App\Models\EsimQrScanRecord;
use App\Models\Ticket;

class EsimQrReader
{
    public function read($selection, Ticket $record)
    {

        $EsimList = $record->booking->package->esim_list;

        if ($EsimList != null) {

            // Check if the selection (shop_id) is in the discount_shop_list of the package
            if (in_array($selection, $EsimList)) {
                // Check if there's a DiscountShopQrRecord with the given shop_id and ticket_id
                $existingRecord = EsimQrScanRecord::where('esim_id', $selection)
                    ->where('ticket_id', $record->ticket_id)
                    ->first();

                if ($existingRecord) {
                    // Record already exists, return message indicating the ticket is used
                    return 'used';
                } else {
                    // Create a new DiscountShopQrRecord since it doesn't exist
                    EsimQrScanRecord::create([
                        'esim_id' => $selection,
                        'ticket_id' => $record->ticket_id,
                        'date' => now()
                    ]);

                    return 'valid'; // Return 'valid' if the operation succeeded
                }
            } else {
                return 'invalid'; // Return 'invalid' if the selection is not in the discount_shop_list
            }
        } else {
            return 'invalid';
        }
    }
}
