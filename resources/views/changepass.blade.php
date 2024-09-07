<x-layout>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Change Password</title>
        <style>
            /* Reset some default browser styles */
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            /* Global styles */
            body {
                font-family: Arial, sans-serif;
                background-color: #f2f2f2;
            }

            /* Profile container styles */
            .profile-container {
                max-width: 600px;
                margin: 0 auto;
                padding: 20px;
                border-radius: 10px;
                background-color: #fff;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }

            /* Header styles */
            h3 {
                color: #333;
            }

            .profile-div{
                display: flex;
                align-items: start;
                justify-content: center;
                margin-top: 1rem;
                margin-bottom: 6rem;
            }

            .profile-picture > img{
                border-radius: 50%;
                width: 150px;
                height: 150px;
            }

            /* Profile info styles */
            .profile-info {
                margin-top: 15px;
            }

            .profile-info p {
                margin-bottom: 10px;
                line-height: 2;
                font-size: 1rem;
            }

            .profile-info p strong {
                font-weight: bold;
            }

            /* Profile action buttons styles */
            .profile-actions {
                margin-top: 20px;
                text-align: center;
            }

            .profile-actions a {
                display: inline-block;
                margin-right: 20px;
                padding: 10px 20px;
                background-color: #007BFF;
                color: #fff;
                text-decoration: none;
                border-radius: 5px;
                transition: background-color 0.3s ease;
            }

            .profile-actions a:hover {
                background-color: #0056b3;
            }

            /* Style the button group */
            .button-group {
                margin-top: 20px;
                text-align: center;
            }

            .button-group button {
                margin: 0 10px; /* Add margin to create spacing between buttons */
                padding: 10px 20px;
                background-color: #000000;
                color: #fff;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }

            .button-group button:hover {
                background-color: #545b62;
            }
        </style>
    </head>
    <body>
        <div class="profile-container">
            <h3 class="text-center mb-4 font-weight-bold">Change Password</h3>
            <!-- Display the user's profile picture -->
            <div class="profile-div">
            <div class="col-lg-7 ">
                <form action="/savePass" method="POST" id="password-form">
                  @csrf

                  <div class="form-group">
                    <label for="oldpassword" class="text-muted mb-1"><small>Old Password</small></label>
                    <input name="oldpassword" id="oldpassword" class="form-control" type="password" placeholder="Enter old password" />
                    @error('oldpassword')
                    <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="newpassword" class="text-muted mb-1"><small>New Password</small></label>
                    <input name="newpassword" id="newpassword" class="form-control" type="password" placeholder="New password" />
                    @error('newpassword')
                    <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="confirmpassword" class="text-muted mb-1"><small>Confirm Password</small></label>
                    <input name="confirmpassword" id="confirmpassword"  class="form-control" type="password" placeholder="Confirm password" />
                    @error('confirmpassword')
                    <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
                    @enderror
                  </div>

                  <button type="submit" class="mt-4 btn btn-sm btn-success btn-block">Change Password</button>
                  <a href="/profile" class="mt-4 btn btn-sm btn-primary btn-block">Go Back</a>
                </form>
              </div>
        </div>
            <!-- Button group container -->
            {{-- <div class="button-group">
                <form action="/goHome" method="POST" class="d-inline">
                    @csrf
                    <button>Go Home</button>
                </form>
            </div> --}}
        </div>
    </body>
    </html>

</x-layout>
