<!DOCTYPE html>
<html>
<head>
    <title>Welcome to Csi</title>
</head>
<body>
<h1>Hello {{ $employee->prenom }} {{ $employee->nom }},</h1>
<p>Welcome to Csi! We are excited to have you on board.</p>
<p>Your default password is: {{ $password }}</p>
<p>Please log in and change your password as soon as possible.</p>
<p>Best regards,<br>Csi/p>
</body>
</html>
