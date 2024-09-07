<x-layout>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Management System</title>
    <link rel="stylesheet" href="/app.css" />
</head>
<body >
    <div class="container" style="margin-bottom: 5rem">
    <header >
        <div class="row d-flex align-items-center">
            <div class="col-md-6 max-width-50">
                <h1 >Hello <strong>{{auth()->user()->username}}</strong>,</h1> <p>Welcome to Universal Task Tracking System</p>
            </div>
            <div class="col-md-6 max-width-50">
                <img src="hero.png" width="100%" height="400px" alt="hero-pic">
            </div>
          </div>

    </header>

    <nav>
        <div class="row d-flex justify-content-center ">
            <a class="no-text-style" href="/tasks"><button  type="button" class="btn btn-light m-4 color-blue-button width-200">Individual</button></a>
            <a class="no-text-style" href="/orgTasks"><button  type="button" class="btn btn-light m-4 color-blue-button width-200">Organization</button></a>
        </div>
    </nav>
    </div>

</body>
</html>
</x-layout>

