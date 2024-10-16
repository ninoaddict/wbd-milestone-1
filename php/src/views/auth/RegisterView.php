<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/public/css/preflight.css">
  <link rel="stylesheet" href="/public/css/globals.css">
  <link rel="stylesheet" href="/public/css/register.css">

  <title>Register - Verlinkt</title>
</head>

<body>
  <header>
    <a href="">
      <img src="/public/images/logo.png" alt="">
    </a>
  </header>

  <main>
    <h1 class="register-title">Make the most of your professional life</h1>
    <div class="card-layout">
      <form id="register-form">
        <input type="checkbox" class="hidden" id="reg-type" name="reg-type" value="company">
        <label class="reg-type" for="reg-type">
          <ul>
            <li id="jobskr-nav" class="selected"><span>Job Seeker</span></li>
            <li id="comp-nav"><span>Company</span></li>
          </ul>
        </label>

        <label for="name" class="input-label">Name</label>
        <div class="mb-4">
          <div class="relative">
            <div class="icon-wrapper">
              <svg class="icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                  d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z" />
              </svg>
            </div>
            <input type="text" id="name" name="name" class="reg-input normal-border" placeholder="John Doe">
          </div>
          <p class="error-msg" id="name-error"></p>
        </div>

        <label for="email" class="input-label">Email</label>
        <div class="mb-4">
          <div class="relative">
            <div class="icon-wrapper">
              <svg class="icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 16">
                <path d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z" />
                <path
                  d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z" />
              </svg>
            </div>
            <input type="email" id="email" name="email" class="reg-input normal-border" placeholder="user@email.com">
          </div>
          <p class="error-msg" id="email-error"></p>
        </div>

        <div id="company-form" class="hidden">
          <label for="location" class="input-label">Location</label>
          <div class="mb-4">
            <div class="relative">
              <div class="icon-wrapper">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="icon" fill="currentColor">
                  <path
                    d="m172.268 501.67c-145.298-210.639-172.268-232.257-172.268-309.67 0-106.039 85.961-192 192-192s192 85.961 192 192c0 77.413-26.97 99.031-172.268 309.67-9.535 13.774-29.93 13.773-39.464 0zm19.732-229.67c44.183 0 80-35.817 80-80s-35.817-80-80-80-80 35.817-80 80 35.817 80 80 80z" />
                </svg>
              </div>
              <input type="text" id="location" name="location" class="reg-input normal-border"
                placeholder="San Diego, California">
            </div>
            <p class="error-msg" id="location-error"></p>
          </div>

          <label for="about" class="input-label">About</label>
          <div class="mb-4">
            <div class="relative">
              <div class="icon-wrapper">
                <svg class="icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                  fill="currentColor" viewBox="0 0 416.979 416.979" xml:space="preserve">
                  <g>
                    <path
                      d="M356.004,61.156c-81.37-81.47-213.377-81.551-294.848-0.182c-81.47,81.371-81.552,213.379-0.181,294.85   c81.369,81.47,213.378,81.551,294.849,0.181C437.293,274.636,437.375,142.626,356.004,61.156z M237.6,340.786   c0,3.217-2.607,5.822-5.822,5.822h-46.576c-3.215,0-5.822-2.605-5.822-5.822V167.885c0-3.217,2.607-5.822,5.822-5.822h46.576   c3.215,0,5.822,2.604,5.822,5.822V340.786z M208.49,137.901c-18.618,0-33.766-15.146-33.766-33.765   c0-18.617,15.147-33.766,33.766-33.766c18.619,0,33.766,15.148,33.766,33.766C242.256,122.755,227.107,137.901,208.49,137.901z" />
                  </g>
                </svg>
              </div>
              <input type="text" id="about" name="about" class="reg-input normal-border"
                placeholder="An IT Company based in Bali">
            </div>
            <p class="error-msg" id="about-error"></p>
          </div>
        </div>

        <label for="password" class="input-label">Password</label>
        <div class="mb-4">
          <div class="relative">
            <div class="icon-wrapper">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="icon" fill="currentColor">
                <path
                  d="m400 224h-24v-72c0-83.8-68.2-152-152-152s-152 68.2-152 152v72h-24c-26.5 0-48 21.5-48 48v192c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-192c0-26.5-21.5-48-48-48zm-104 0h-144v-72c0-39.7 32.3-72 72-72s72 32.3 72 72z" />
              </svg>
            </div>
            <input type="password" id="password" name="password" class="reg-input normal-border" placeholder="Password">
          </div>
          <p class="error-msg" id="password-error"></p>
        </div>

        <label for="confirm-password" class="input-label">Confirm Password</label>
        <div class="mb-6">
          <div class="relative">
            <div class="icon-wrapper">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="icon" fill="currentColor">
                <path
                  d="m12 1c-6.074 0-11 4.926-11 11s4.926 11 11 11 11-4.926 11-11-4.926-11-11-11zm-1.5 15.5-4.5-4.5 1.5-1.5 3 3 5.956-5.956 1.5 1.413z" />
              </svg>
            </div>
            <input type="password" id="confirm-password" name="confirm-password" class="reg-input normal-border"
              placeholder="Password">
          </div>
          <p class="error-msg" id="confirm-password-error"></p>
        </div>

        <button class="login-button" type="submit" id="submit-button">
          Register
        </button>
      </form>
    </div>

    <div class="join-now">
      Already on Verlinkt?
      <a href="/login" class="link">Sign in</a>
    </div>
  </main>
  <script src="/public/js/register.js"></script>
</body>

</html>