<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
        }
        .header img {
            max-width: 200px;
            height: auto;
        }
        .content {
            margin-bottom: 20px;
        }
        .button {
            display: inline-block;
            font-size: 16px;
            color: #ffffff;
            background-color: #007bff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            margin: 5px;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #666666;
            padding-top: 20px;
            border-top: 1px solid #dddddd;
        }
        .leave-details {
            margin-top: 20px;
            padding: 10px;
            background: #f9f9f9;
            border: 1px solid #e1e1e1;
            border-radius: 4px;
        }
        .leave-details p {
            margin: 0;
            padding: 5px 0;
        }
        .approved {
            color: green;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="content">
            <p>Dear {{ $employeeName }},</p>
            <p>We are pleased to inform you that your leave request has been <span class="approved">approved</span> for the following details:</p>
            <div class="leave-details">
                <p><strong>Leave Type:</strong> {{ $leaveType }}</p>
                <p><strong>Leave Dates:</strong> {{ $leaveDates }}</p>
                <p><strong>Duration:</strong> {{ $duration }}</p>
                <p><strong>Reason:</strong> {{ $leaveReason }}</p>
            </div>
            <p>Please ensure that you have completed or handed over your pending tasks before the leave starts.</p>
            <p>If you need any further assistance, feel free to contact the HR department.</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Leave Management System. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
