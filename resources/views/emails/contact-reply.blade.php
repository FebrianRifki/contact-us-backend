<h2>Hello {{ $data->first_name }} {{ $data->last_name }},</h2>

<p>Thank you for contacting us.</p>

<p><strong>Your original message:</strong></p>
<p>{{ $data->message }}</p>

<hr>

<p><strong>Our reply:</strong></p>
<p>{{ $data->reply }}</p>

<p>Best regards,<br>Admin Team</p>
