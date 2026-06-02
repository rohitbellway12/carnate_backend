<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('assets/css/carnet.css') }}">

    <title>Document</title>
</head>

<body class="bg-light">
    <div class="container">
        <div class="row row-cols-1  row-cols-lg-2" style="height:100vh;">
            <div class="col mx-auto h-100 d-flex align-items-center justify-content-center">
                <div class="card bg-white" id="welcomefile">
                    <div class="card-body text-center p-5 armsicon">
                        <div class="login_header">
                            <div class="text-center">
                                <div class="text-center mb-3">
                                    <img src="{{ asset('assets/images/carnatebg.png') }}" style="width:200px;"
                                        class="img-fluid logologin">
                                </div>
                            </div>
                        </div>

                        <a class="btn btn-sm btn-primary m-md-2 rounded-1 px-3" href="{{ route('admin.login') }}">
                            Admin</a>
                        <a class="btn btn-sm btn-primary m-md-2 my-md-0 my-2 px-3 rounded-1"
                            href="{{ route('unified.login') }}">
                            Vendor Login
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
