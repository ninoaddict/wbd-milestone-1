<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/public/css/preflight.css">
  <link rel="stylesheet" href="/public/css/globals.css">
  <link rel="stylesheet" href="/public/css/login.css">

  <title>Login - Verlinkt</title>
</head>

<body>
  <header>
    <a href="">
      <img src="/public/images/logo.png" alt="">
    </a>
  </header>

  <main>
    <div class="card-layout">
      <div id="organic-div">
        <div class="header-content">
          <h1 class="header-content-title">Sign in</h1>
          <p class="header-content-desc">Stay updated on your professional world.</p>
        </div>
      </div>

      <form action="/login" method="post">
        <label for="email" class="input-label">Your Email</label>
        <div class="relative mb-6">
          <div class="icon-wrapper">
            <svg class="icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
              viewBox="0 0 20 16">
              <path d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z" />
              <path
                d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z" />
            </svg>
          </div>
          <input type="email" id="email" name="email" class="login-input" placeholder="user@email.com" required>
        </div>

        <label for="password" class="input-label">Your Password</label>
        <div class="relative mb-6">
          <div class="icon-wrapper">
            <svg class="icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
              viewBox="0 0 20 20">
              <path
                d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z" />
            </svg>
          </div>
          <input type="password" id="password" name="password" class="login-input" placeholder="Password" required>
        </div>
        <button class="login-button">
          Sign In
        </button>
      </form>
    </div>

    <div class="join-now">
        New to Verlinkt?
        <a href="/register" class="link">Join now</a>
    </div>
  </main>
</body>

</html>