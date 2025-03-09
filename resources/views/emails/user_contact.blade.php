<!DOCTYPE html>
<html>
<head>
    <title>Consultation Confirmation</title>
</head>
<body>
    <p>Dear {{ $data['name'] }},</p>

    <p>We are pleased to confirm your consultation with one of our expert consultants on <strong>{{ $data['meeting_time'] }}</strong>.</p>
    
    <p>You will receive further details regarding the meeting shortly.</p>

    <p>Should you need to reschedule or have any questions, please do not hesitate to contact us.</p>

    <p>We look forward to assisting you.</p>

    <p>Sincerely,</p>
    <p><strong>TransformBD</strong></p>
    <small><strong>This is an auto generated email. Please do not reply.</strong></small>
</body>
</html>
