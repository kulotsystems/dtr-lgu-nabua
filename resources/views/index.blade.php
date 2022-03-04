<!DOCTYPE html>
<html lang="en">
<head>
    <title>DTR @ LGU Nabua</title>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name='description' content="A web portal hooked into the DTR machine of LGU Nabua, Camarines Sur that can be used by employees to monitor and print their Daily Time Records.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link href="{{ asset('img/dtr-lgu-nabua.png') }}" rel="icon" type="image/vnd.microsoft.icon" />

    <meta property="og:title" content="DTR @ LGU Nabua">
    <meta property="og:image" content="{{ asset('img/dtr-lgu-nabua-meta-og.png') }}">
    <meta property="og:description" content="A web portal hooked into the DTR machine of LGU Nabua, Camarines Sur that can be used by employees to monitor and print their Daily Time Records.">
    <meta property="og:url" content="https://www.kulotsystems.tech/dtr">

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v11.0" nonce="DKEEmSad"></script>
    <div id="dtr-lgu-nabua"></div>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
