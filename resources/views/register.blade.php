<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/css/register.css') }}">
    <title>Registration Form</title>
</head>
<body>
    
    <div class="form-container">
        <form class="form" id="registration-form" method="POST" action="{{ url('register/store') }}">
            @csrf
            <p class="title">Register </p>
            <p class="message">Signup now and get full access to our app. </p>
                <div class="flex" style="gap: 28px">
                <label>
                    <input required name="first_name" type="text" class="input">
                    <span>Firstname</span>
                </label>

                <label>
                    <input required name="last_name" type="text" class="input">
                    <span>Lastname</span>
                </label>
            </div>  
                    
            <label>
                <input required name="email" type="email" id="user-email" class="input">
                <span>Email</span>
            </label> 
                
            <label>
                <input required name="password" id="user-password" type="password" class="input">
                <span>Password</span>
            </label>
            <label>
                <input required name="confirm_password" id="confirm-password" type="text" class="input">
                <span>Confirm password</span>
                
            </label>
            <span id="message" class="error"></span>
            <button class="submit" id="register-btn">Submit</button>
            <p class="signin">Already have an acount ? <a href="{{ url('/') }}">Signin</a> </p>
        </form>
    </div>

    <script>
        const password = document.getElementById('password');
const confirmPassword = document.getElementById('confirm_password');
const message = document.getElementById('message');

confirmPassword.addEventListener('keyup', () => {
  if (password.value === confirmPassword.value) {
    message.textContent = 'Passwords match';
    message.style.color = 'green';
  } else {
    message.textContent = 'Passwords do not match';
    message.style.color = 'red';
  }
});
    </script>

</body>
</html>