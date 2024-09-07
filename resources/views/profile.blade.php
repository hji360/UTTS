<x-layout>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Your Profile</title>
        <style>
            /* Reset some default browser styles */
            * {
                margin: 5;
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
                padding: 20px 40px;
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
                justify-content: start;
                gap: 30px;
                margin-top: 2rem;
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
                display: flex;
                justify-content: center;
                gap: 5rem;
            }

        </style>
    </head>
    <body>
        <div class="profile-container">
            <h3 class="text-center mb-4 font-weight-bold">Your Profile</h3>
            <!-- Display the user's profile picture -->
            <div class="profile-div">
                <div class="profile-picture">
                    <img src="/storage/user/{{ auth()->user()->avatar }}"  alt="Profile Picture" >
                </div>
                <div class="profile-info">
                    <p><strong>Name:</strong> {{ auth()->user()->username }}</p>
                    <p><strong>Email:</strong> {{ auth()->user()->email}}</p>
                    <!-- Add more profile information as needed -->
                </div>
            </div>
            <div class="profile-actions">
                <!-- Add profile action buttons or links here -->
                <a class="btn btn-primary" href="/editprofile">Edit Profile</a>
                <a class="btn btn-info" href="/editpass">Change Password</a>
            </div>
        </div>
    </body>
    </html>

    </x-layout>
