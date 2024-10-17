<?php
$currPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$currRole = $_SESSION['role'] ?? 'guest';
?>

<header id="global-nav" class="global-nav">
  <div class="global-nav-content">
    <a href="/">
      <div class="global-nav-branding-container">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" data-supported-dps="24x24" fill="currentColor"
          class="mercado-match" width="41" height="41" focusable="false">
          <path
            d="M20.5 2h-17A1.5 1.5 0 002 3.5v17A1.5 1.5 0 003.5 22h17a1.5 1.5 0 001.5-1.5v-17A1.5 1.5 0 0020.5 2zM8 19H5v-9h3zM6.5 8.25A1.75 1.75 0 118.3 6.5a1.78 1.78 0 01-1.8 1.75zM19 19h-3v-4.74c0-1.42-.6-1.93-1.38-1.93A1.74 1.74 0 0013 14.19a.66.66 0 000 .14V19h-3v-9h2.9v1.3a3.11 3.11 0 012.7-1.4c1.55 0 3.36.86 3.36 3.66z">
          </path>
        </svg>
      </div>
    </a>
    <nav class="global-nav-nav">
      <ul>
        <?php if (isset($_SESSION['role'])): ?>
          <li class="<?php if ($currPath == '/')
            echo 'selected' ?>">
              <a href="/" class="global-nav-nav-link">
                <div>
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" data-supported-dps="24x24" fill="currentColor"
                    class="mercado-match" width="24" height="24" focusable="false">
                    <path d="M23 9v2h-2v7a3 3 0 01-3 3h-4v-6h-4v6H6a3 3 0 01-3-3v-7H1V9l11-7 5 3.18V2h3v5.09z"></path>
                  </svg>
                </div>
                <span>Home</span>
              </a>
            </li>
          <?php if ($currRole == 'jobseeker'): ?>
            <li class="<?php if ($currPath == '/history')
              echo 'selected' ?>">
                <a href="/history" class="global-nav-nav-link">
                  <div>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" data-supported-dps="24x24" fill="currentColor"
                      class="mercado-match" width="24" height="24" focusable="false">
                      <g fill="none" fill-rule="evenodd" id="Page-1" stroke="none" stroke-width="1">
                        <g fill="currentColor" id="Core" opacity="0.9" transform="translate(-464.000000, -254.000000)">
                          <g id="history" transform="translate(465.000000, 256.5)">
                            <path
                              d="M10.5,0 C7,0 3.9,1.9 2.3,4.8 L0,2.5 L0,9 L6.5,9 L3.7,6.2 C5,3.7 7.5,2 10.5,2 C14.6,2 18,5.4 18,9.5 C18,13.6 14.6,17 10.5,17 C7.2,17 4.5,14.9 3.4,12 L1.3,12 C2.4,16 6.1,19 10.5,19 C15.8,19 20,14.7 20,9.5 C20,4.3 15.7,0 10.5,0 L10.5,0 Z M9,5 L9,10.1 L13.7,12.9 L14.5,11.6 L10.5,9.2 L10.5,5 L9,5 L9,5 Z"
                              id="Shape" />
                          </g>
                        </g>
                      </g>
                    </svg>
                  </div>
                  <span>History</span>
                </a>
              </li>
          <?php endif; ?>
          <li id="profile-toggle">
            <div class="global-nav-nav-link">
              <div>
                <img src="/public/images/user.png" alt="" width="24" height="24">
              </div>
              <span class="profile-span">Profile
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="12" height="12" viewBox="0 0 96 96">
                  <title />
                  <path
                    d="M81.8457,25.3876a6.0239,6.0239,0,0,0-8.45.7676L48,56.6257l-25.396-30.47a5.999,5.999,0,1,0-9.2114,7.6879L43.3943,69.8452a5.9969,5.9969,0,0,0,9.2114,0L82.6074,33.8431A6.0076,6.0076,0,0,0,81.8457,25.3876Z" />
                </svg>
              </span>
              <div class="profile-card hidden" id="profile-card">
                <div class="info-section">
                  <span class="info-section-name">
                    <?php echo $_SESSION['nama'] ?>
                  </span>
                  <span class="info-section-email">
                    <?php echo $_SESSION['email'] ?>
                  </span>
                  <?php if ($currRole === 'company'):?>
                    <a class="profile-card-view" href="/profile">
                    View Profile
                    </a>
                  <?php endif; ?>
                </div>
                <div class = "sign-out">
                  <form action="/logout" method="post">
                    <button type="submit">Sign Out</button>
                  </form>
                </div>
              </div>
            </div>
          </li>
        <?php else: ?>
          <li>
            <div class="btn-container">
              <div class="btn">
                <a href="/login">Sign in</a>
              </div>
            </div>
          </li>
          <li>
            <div class="btn-container">
              <div class="btn">
                <a href="/register">Register</a>
              </div>
            </div>
          </li>
        <?php endif; ?>
      </ul>
    </nav>
  </div>
</header>
<script src="/public/js/navbar.js"></script>