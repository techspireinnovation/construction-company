<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Contact Form Submission</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f4f6f8;
            color: #333333;
            margin: 0;
            padding: 0;
        }
        .email-wrapper {
            width: 100%;
            padding: 20px 0;
            background-color: #f4f6f8;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            overflow: hidden;
        }
        .email-header {
            background-color: #ff5e14;
            color: #ffffff;
            padding: 20px;
            text-align: center;
            font-size: 22px;
            font-weight: bold;
        }
        .email-body {
            padding: 20px;
            line-height: 1.6;
            font-size: 16px;
        }
        .label {
            font-weight: bold;
            color: #555555;
        }
        .message {
            background-color: #f9f9f9;
            padding: 15px;
            border-left: 4px solid #ff5e14;
            margin-top: 10px;
            border-radius: 4px;
            white-space: pre-wrap;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #999999;
            padding: 15px;
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-container">
            <div class="email-header">
                New Contact Form Submission
            </div>
            <div class="email-body">
                <p><span class="label">Name:</span> {{ $data['name'] }}</p>
                <p><span class="label">Email:</span> {{ $data['email'] }}</p>
                @if(!empty($data['mobile']))
                <p><span class="label">Mobile:</span> {{ $data['mobile'] }}</p>
                @endif
                <p><span class="label">Subject:</span> {{ $data['subject'] }}</p>
                <p><span class="label">Message:</span></p>
                <div class="message">{{ $data['message'] }}</div>
            </div>
            <div class="footer">
                &copy; {{ date('Y') }} Your Company. All rights reserved.
            </div>
        </div>
    </div>
</body>
</html>
