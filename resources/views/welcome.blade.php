<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Findit - Welcome</title>
  <link rel="stylesheet" href="{{ asset('css/welcome.css') }}" />

  <style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', sans-serif;
  }

  body {
    background: linear-gradient(to right, #3f51b5, rgb(6, 163, 195));
    color: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    animation: fadeIn 1s ease-in-out;
  }

  .welcome-container {
    text-align: center;
    padding: 20px;
  }



  .logo {
    width: 100px;
    height: 100px;
    margin-bottom: 15px;
    animation: popIn 1s ease-out;
  }

  .app-name {
    font-size: 7.5rem;
    font-weight: bold;
    span{
      color:rgb(6, 163, 195);
      animation: slide 1s ease-in;
      animation-delay: 0.6;
    }
  }
  .description{
    font-size:1.5rem;
    font-family: 'Segoe UI', sans-serif;
  }
  .tagline {
    font-size: 1rem;
    margin-top:-1.5rem;
    margin-bottom: 30px;
  }

  .button-section button {
    background-color: #fff;
    color:rgb(6, 163, 195);
    border: none;
    padding: 12px 25px;
    margin: 10px;
    border-radius: 25px;
    font-size: 1rem;
    cursor: pointer;
    transition: 0.3s ease;
    opacity: 0;
    transform: translateY(20px);
    animation: slideUp 0.6s forwards;
  }

  .button-section button:hover {
    background-color:rgb(6, 163, 195);
    color:white;
  }
  .button-section button:nth-child(1){
    animation-delay: 1s;
  }
  .button-section button:nth-child(2){
    animation-delay: 1.2s;
  }
  @keyframes slideUp{
    to{
        opacity: 1;
        transform: translateY(0);
    }
  }
  @keyframes fadeIn {
    from{
        opacity: 0;
        transform: translateY(20px);
    }
    to{
        opacity: 1;
        transform: translateY(0);
    }
  }
  @keyframes popIn{
    0%{
        transform: scale(0.7);
        opacity: 0;
    }
    100%{
        transform: scale(1);
        opacity: 1;
    }
  }
  @keyframes slide{
    0%{
      transform: scale(0.5);
      opacity:0;
    }
    100%{
        opacity: 1;
       transform: scale(1);
    }
  }
  </style>
</head>
<body>
  <div class="welcome-container">
    <div class="logo-section">
      <h1 class="app-name">Find<span>It</span></h1>
      <p class="tagline">Helping you reunite with your lost items.</p>
      <p class="description">More than just a repository for the forgotten, mending the fractured narratives
       <br>  caused by accidental seperation.We don't simply collect objects; we curate potential reunions,
       <br>   holding echoes of past moments until they can resonate with their rightful owners once more.
      </p>
    </div>

    <div class="button-section">
      <button onclick="goToLogin()">Login</button>
      <button onclick="goToSignup()">Sign Up</button>
    </div>
  </div>

  <script>
    function goToLogin() {
      window.location.href = "{{ route('login') }}";
    }

    function goToSignup() {
      window.location.href = "{{ route('register') }}";
    }
  </script>
</body>
</html>