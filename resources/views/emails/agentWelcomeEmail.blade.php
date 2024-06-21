<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            padding: 10px 0;
        }

        .content {
            margin: 20px 0;
            text-align: center;
        }

        .content h1 {
            color: #333333;
        }

        .content p {
            color: #666666;
            line-height: 1.5;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            margin: 20px 0;
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            border-radius: 4px;
        }

        .footer {
            text-align: center;
            padding: 10px 0;
            color: #999999;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img style="width: 350px" src="{{ asset('images/logo.png') }}" alt="Company Logo">
        </div>
        <div class="content">
            <h1>Welcome to Ceylon Travel & Health Pass Agent Program</h1>
            <p>Hi {{ $name }},</p>

            <br>

            <img src="{{ asset('images/pending.png') }}">

            <br>
            <hr>
            <p style="color:rgb(19, 214, 19); font-bold:700">"Thanks for your registering with us! Please hang tight
                while we wait for
                admin
                approval. We'll let you
                know as soon as it's approved."</p>
        </div>

    </div>
</body>

</html>
