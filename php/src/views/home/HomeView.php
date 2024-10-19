<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/public/css/preflight.css">
  <link rel="stylesheet" href="/public/css/globals.css">
  <link rel="stylesheet" href="/public/css/navbar.css">
  <link rel="stylesheet" href="/public/css/home.css">
  <link rel="stylesheet" href="/public/css/toast.css">

  <title>Home</title>
</head>

<body>
  <?php include dirname(__DIR__) . '/components/Navbar.php' ?>
  <h1>Selamat Datang</h1>
  <ul class="notifications"></ul>
</body>

<script src="/public/js/toast.js" defer></script>
<?php if (isset($successMessage)): ?>
  <script defer>
    window.addEventListener('load', (event) => {
      createToast('success', '<?php echo $successMessage ?>')
    });
  </script>
<?php endif; ?>

</html>