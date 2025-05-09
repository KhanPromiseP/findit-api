<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Findit - Welcome</title>
  <link rel="stylesheet" href="findit-api/resources/css/welcome.css" />
</head>
<body>
  <div class="welcome-container">
    <div class="logo-section">
      <!--<img src="pic/1.jpg" alt="Findit Logo" class="logo"/>-->
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

  <script src="js/welcome.js"></script>
</body>
</html>