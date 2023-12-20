<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Sistem Informasi Geografis</title>
  <link rel="stylesheet" href="{{ asset('css/login-regist.css') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
  <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
      <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
    </symbol>
    <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
      <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
    </symbol>
    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
      <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
    </symbol>
  </svg>

  @if(session()->has('regist-success'))
  <div class="alert alert-success d-flex align-items-center" role="alert">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
    <div>
      Regist berhasil, silahkan login
    </div>
  </div>
  @endif

  @if(session()->has('login-fails'))
  <div class="alert alert-danger d-flex align-items-center" role="alert">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
    <div>
      Username atau Password anda salah
    </div>
  </div>
  @endif
  
  <div class="container" id="container">
    <div class="form-container sign-up-container">
      <form method="POST" action="{{ route('regist') }}">
        @csrf
        <h1>Buat Akun</h1>
        <label>
          <input type="text" name="regist_username" placeholder="Username" value="{{ old('regist_username') }}">
          @error('regist_username')<small>{{ $message }}</small>@enderror
        </label>
        <label>
          <input type="password" name="regist_password" placeholder="Password" value="{{ old('regist_password') }}">
          @error('regist_password')<small>{{ $message }}</small>@enderror
        </label>
        <label>
          <input type="text" name="regist_telp" placeholder="No Telp" value="{{ old('regist_telp') }}">
          @error('regist_telp')<small>{{ $message }}</small>@enderror
        </label>
        <button type="submit">Register</button>
      </form>
    </div>
    <div class="form-container sign-in-container">
      <form method="POST" action="{{ route('login') }}">
        @csrf
        <h1>Login</h1>
        <label>
          <input type="text" name="username" placeholder="Username" value="{{ old('username') }}">
          @error('username')<small>{{ $message }}</small>@enderror
        </label>
        <label>
          <input type="password" name="password" placeholder="Password" value="{{ old('password') }}">
          @error('password')<small>{{ $message }}</small>@enderror
        </label>
        <button type="submit">Login</button>
      </form>
    </div>
    <div class="overlay-container">
      <div class="overlay">
        <div class="overlay-panel overlay-left">
          <h1>Selamat Datang !</h1>
          <p>Sudah punya akun? Klik Login</p>
          <button class="ghost" id="Login">Login</button>
        </div>
        <div class="overlay-panel overlay-right">
          <h1>SIG Kelurahan Tanah Sereal</h1>
          <p>Belum punya akun? klik Register</p>
          <button class="ghost" id="Register">Register</button>
        </div>
      </div>
    </div>
  </div>

  @if(session()->has('regist-fails'))
    <script> container.classList.add("right-panel-active"); </script>
  @endif
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script> 
    const signUpButton = document.getElementById('Register');
    const signInButton = document.getElementById('Login');
    const container = document.getElementById('container');
    
    signUpButton.addEventListener('click', () => {
      container.classList.add("right-panel-active");
    });
    
    signInButton.addEventListener('click', () => {
      container.classList.remove("right-panel-active");
    })
  </script>
</body>
</html>