<!DOCTYPE html>
<html>
<head>
    <title>New Contact Form Submission</title>
</head>
<body>
    <p>We would like to inform you that a consultation has been scheduled with <strong>{{ $data['name'] }}</strong> on <strong>{{ $data['meeting_time'] }}</strong>. Please find the details below: </p>
    <p><strong>Name:</strong> {{ $data['name'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    <p><strong>Phone:</strong> {{ $data['phone'] }}</p>
    <p><strong>Meeting Time:</strong> {{ $data['meeting_time'] }}</p>
    <p><strong>Subject:</strong> {{ $data['subject'] }}</p>
    <p><strong>Message:</strong> {{ $data['message'] }}</p>
    <p>Please take the necessary steps to follow up with the client.</p>
    <p>Thank you.</p>
    <p><strong>TransformBD</strong></p>
    <small><strong>This is an auto generated email. Please do not reply.</strong></small>
</body>
</html>
