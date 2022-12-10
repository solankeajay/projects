<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="http://localhost/laravel/blog/public/css/bootstrap.min.css" />
    <!-- <link rel="stylesheet" href="font/font-awesome-4.7.0/css/font-awesome.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/fontawesome.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="http://localhost/laravel/blog/public/style.css">
</head>

<body>
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems.
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div id="wrapper-admin" class="body-content">
        <div class="container">
            <div class="row">
                <div class="offset-md-4 col-md-4">

                    <h3 class="heading">Login</h3>
                    <!-- Form Start -->
                    <form action="./Login" id="form" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Username</label>
                            <input type="text" name="email" class="form-control" placeholder="username" required>
                        </div>
                        <div class="form-group mt-2">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="password" required>
                        </div>
                        <input type="submit" name="login" class="btn btn-primary mt-2" value="login" />
                    </form>
                    <!-- /Form  End -->
                </div>
            </div>
        </div>
    </div>
</body>

</html>