<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Ticket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        .ticket {
            max-width: 300px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
        }

        .qr-code {
            margin: 0 auto 20px auto;
            align-items: center;
            justify-content: center;
        }

        .ticket-info {
            margin: 0;
            padding: 0;
            list-style-type: none;
        }

        .ticket-info li {
            margin: 10px 0;
            font-size: 16px;
            color: #333333;
        }

        .value-style {
            color: #1fe192;
            font-weight: 800;
        }
    </style>
</head>

<body style="background-color:#88ef88;">

    <div style="padding: 20px; display: grid;
    gap: 30px;">

        {{-- @forelse ($tickets as $ticket)
            <div class="ticket">
                <div class="qr-code">
                    <img src="{{ asset('storage/tickets/' . $ticket->ticket_id . '.png') }}" alt="QR Code">
                </div>

                <ul class="ticket-info">
                    <li><strong>Ticket Number:<br></strong><span class="value-style">{{ $ticket['ticket_id'] }}</span>
                    </li>
                    <li><strong>Booking Number:<br></strong><span
                            class="value-style">#{{ $ticket['booking_id'] }}</span>
                    </li>
                    <li><strong>Expiry Date:<br></strong><span
                            class="value-style">{{ date('Y-m-d', strtotime($ticket['expiry_date'])) }}</span></li>
                    <li><strong>Category:<br></strong><span
                            class="value-style">{{ $ticket['is_adult'] == '1' ? 'Adult Pass' : 'Child Pass' }}</span>
                    </li>
                </ul>
            </div>
            <br>
        @empty
        @endforelse --}}

    </div>
</body>

</html>
