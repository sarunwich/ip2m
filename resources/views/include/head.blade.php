<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-sXoqV3eT08h/RuPIb2YiDwl2Pqe5grPItJ7zkrbaN5vRaR01sdV5gqo4g5Tv5K5ZCovqIvcg+CmPp/1ZYhDq5w==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}

    <link rel="icon" href="{{ asset('build/assets/favicon_io/favicon.ico') }}" type="image/x-icon">

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('build/assets/favicon_io/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ asset('build/assets/favicon_io/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset('build/assets/favicon_io/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('build/assets/favicon_io/site.webmanifest') }}">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
    @include('include.footercss')
<style>
    .eye-icon {
    color: gray;
}
    .custom-red-header {
        width: 100%;
  background-color: rgb(255, 3, 3);
  border-top-left-radius: 5px;
  border-top-right-radius: 5px;
  color: white;
  text-align: center;
    }
.left-side{
    background-color: rgb(255, 3, 3);
    /* border-radius: 10px; ขอบมุม */
    border-bottom-left-radius: 20px;
    border-top-left-radius: 20px;
    text-align: center;
    color: white;
            padding: 10px; /* ระยะห่างขอบ */
            box-shadow: inset 0 -3px 0 0 rgb(178, 179, 180);
}
.right-side{
    /* background-color: rgb(237, 234, 235); */
    /* border-radius: 10px; ขอบมุม */
    border-bottom-right-radius: 20px;
    border-top-right-radius: 20px;
            padding: 10px; /* ระยะห่างขอบ */
            box-shadow: inset -3px -3px 0 0 rgb(178, 179, 180);
}
  .category-menu {
            background-color: rgb(255, 3, 3); /* สีพื้นหลัง */
            border-radius: 10px; /* ขอบมุม */
            padding: 10px; /* ระยะห่างขอบ */
            position: fixed; /* ติดตั้งเมนู */
            top: 50%; /* ยืดให้ชิดด้านซ้ายและอยู่กึ่งกลางแนวตั้ง */
            transform: translateY(-50%); /* ย้ายเมนูให้อยู่กึ่งกลางแนวตั้ง */
        }

        .category-menu ul {
            list-style: none; /* เอา bullet point ออก */
            padding: 0;
        }

        .category-menu li a {
            color: white; /* สีข้อความ */
            text-decoration: none; /* เอา underline ออก */
        }

        .category-menu li {
            margin-bottom: 5px; /* ระยะห่างระหว่างรายการ */
        }

        .buttonred {
  background-color: #ff0303; /* red */
  border: none;
  color: white;
  padding: 10px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 2px 2px;
  cursor: pointer;
  border-radius: 50px;
}
.custom-checkbox:checked {
    background-color: #ff0303; /* Background color when checked */
}
.strong {
  font-weight:bold;
  font-size:40px;
  line-height:22px;
  /* border:1px solid #000000; */
}


        
</style>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>