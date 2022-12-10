<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Data</title>

    <link rel="stylesheet" href="http://localhost/laravel/blog/public/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/fontawesome.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <script src="http://localhost/laravel/blog/public/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="http://localhost/laravel/blog/public/style.css">


</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <!-- <div class="container-fluid"> -->
        <a class="navbar-brand" href="http://localhost/laravel/blog/public/Dashboard">Dashboard</a>
        <!-- </div> -->
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Academy
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        @if(session()->get('user.position') != 'Student')
                        <a class="dropdown-item" href="http://localhost/laravel/blog/public/Class">Class</a>

                        <a class="dropdown-item" href="http://localhost/laravel/blog/public/Subject">Subject</a>
                        @endif
                        <a class="dropdown-item" href="http://localhost/laravel/blog/public/Timetable">Timetable</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Students
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">

                        <a class="dropdown-item" href="http://localhost/laravel/blog/public/Home">Student</a>
                        @if(session()->get('user.position') != 'Student')
                        <a class="dropdown-item" href="http://localhost/laravel/blog/public/Attendance">Attendance</a>
                        @endif
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Teachers
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">

                        <a class="dropdown-item" href="http://localhost/laravel/blog/public/TeacherData">Teachers</a>

                    </div>
                </li>
            </ul>
        </div>
        <div class="container-fluid d-flex justify-content-end">
            <a class="navbar-brand" href="http://localhost/laravel/blog/public/Logout">Logout</a>
        </div>
    </nav>