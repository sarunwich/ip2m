<!DOCTYPE html>
<html>
<head>
    <title>แจ้งสถานะการใช้ระบบ i2M</title>
</head>
<body>
<h3>{{ $SendMail['title'] }}</h3>
    <p>{{ $SendMail['body'] }}</p>
    {{-- {{ $SendMail['idip'] }}<br>
   {{ $SendMail['nameip'] }}<br> --}}
    
    <p>{{ $SendMail['URL'] }}</p>
    <p>Thank you</p>
    <p>*** Email เป็นการส่งอัตโนมัติ ไม่ต้องตอบกลับ</p>
</body>
</html>