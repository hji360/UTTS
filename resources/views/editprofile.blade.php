<x-layout>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Your Profile</title>
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
                justify-content: start;
                gap: 30px;
                margin-top: 1rem;
                margin-bottom: 6rem;
            }

            .profile-picture{
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: start;
                gap: 10px;
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
            <h3 class="text-center mb-4 font-weight-bold">Edit Profile</h3>
            <!-- Display the user's profile picture -->

            <form action="/saveProfile" method="post" id="profile-form" enctype="multipart/form-data">
            <div class="profile-div">
            <div class="profile-picture">
                <img src="/storage/user/{{ auth()->user()->avatar }}" alt="Profile Picture">
                <button type="button" class="btn btn-primary" onclick="changeImage()">Change Picture
                </button>
                <input type="file" accept="image/*" name="avatar" id="avatar" hidden/>
                @error('avatar')
                <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
                @enderror
            </div>

            <div class="col-lg-7 ">
                  @csrf
                  <div class="form-group">
                    <label for="username" class="text-muted mb-1"><small>Username</small></label>
                    <input value= "{{ auth()->user()->username }}" name="username" id="username" class="form-control" type="text" placeholder="Pick a username" autocomplete="off" />
                    @error('username')
                    <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="email" class="text-muted mb-1"><small>Email</small></label>
                    <input value= "{{ auth()->user()->email }}" name="email" id="email" class="form-control" type="text" placeholder="you@example.com" autocomplete="off" />
                    @error('email')
                    <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
                    @enderror
                  </div>

                  <button type="submit" class="mt-4 btn btn-sm btn-success btn-block">Save</button>
                  <a href="/profile" class="mt-4 btn btn-sm btn-primary btn-block">Go Back</a>
              </div>
        </div>
    </form>
        </div>
    </body>
    </html>

</x-layout>

<script>
function changeImage() {
  console.log('changeImage');
  document.getElementById('avatar').click();
}

document.getElementById('avatar').addEventListener('change', function() {
  var file = this.files[0];
  var reader = new FileReader();

  reader.onload = function(event) {
    var img = document.querySelector('.profile-picture img');
    img.src = event.target.result;
  }

  reader.readAsDataURL(file);
});
</script>


