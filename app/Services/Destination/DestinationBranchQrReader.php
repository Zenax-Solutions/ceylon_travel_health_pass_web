<?php

namespace App\Services\Destination;

use App\Models\DestinationQrScanRecord;
use App\Models\DestinationTicketStockHistory;
use App\Models\Ticket;
use Carbon\Carbon;

class DestinationBranchQrReader
{
    public function read($selection, Ticket $record)
    {
        $destinationList = $record->booking->destination_list;

        if ($destinationList != null) {
            if (in_array($selection, $destinationList)) {
                $existingRecord = DestinationQrScanRecord::where('destination_id', $selection)
                    ->where('ticket_id', $record->ticket_id)
                    ->first();

                if (!empty($record->expiry_date)) {
                    if (now()->greaterThan($record->expiry_date)) {
                        $record->update([
                            'status' => 'expired',
                        ]);
                        return 'expired';
                    }
                }

                if ($existingRecord) {
                    return 'used';
                } else {
                    // Check latest stock record
                    $latestStockRecord = DestinationTicketStockHistory::where('destination_id', $selection)
                        ->orderBy('date', 'desc')
                        ->first();

                    if ($latestStockRecord) {
                        // Check if selling ticket count is less than or equal to stock count
                        if ($latestStockRecord->selling_ticket_count <= $latestStockRecord->ticket_stock_count) {
                            // Create a new DestinationQrScanRecord
                            DestinationQrScanRecord::create([
                                'destination_id' => $selection,
                                'ticket_id' => $record->ticket_id,
                                'date' => now()
                            ]);

                            // Increment selling ticket count in the latest stock record
                            $latestStockRecord->increment('selling_ticket_count');
                        } else {
                            // Increment over selling count if selling ticket count exceeds stock count
                            $latestStockRecord->increment('over_selling');
                        }

                        $this->updateOtherTicketExpiryDates($record);

                        return 'valid';
                    } else {
                        // If no stock record exists, create one with over_selling incremented
                        DestinationTicketStockHistory::create([
                            'destination_id' => $selection,
                            'ticket_stock_count' => 0, // Assuming no stock available
                            'selling_ticket_count' => 0,
                            'over_selling' => 1,
                            'date' => now()
                        ]);

                        return 'valid';
                    }
                }
            } else {
                return 'invalid';
            }
        } else {
            return 'invalid';
        }
    }

    private function updateOtherTicketExpiryDates(Ticket $record)
    {
        $otherTickets = Ticket::where('booking_id', $record->booking_id)
            ->where('id', '!=', $record->ticket_id)
            ->get();

        $currentDate = Carbon::now();
        $expirationDate = $currentDate->addDays($record->booking->package->expire_days_count);
        $formattedExpirationDate = $expirationDate->toDateString();

        foreach ($otherTickets as $ticket) {
            if (empty($ticket->expiry_date)) {
                $ticket->expiry_date = $formattedExpirationDate;
                $ticket->save();
            }
        }
    }
}
