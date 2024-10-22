<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Not found page">
  <meta name="keywords" content="job, apply, vacancy, linkedin, verlinkt">
  <title>Page Not Found</title>
  <link rel="stylesheet" href="/public/css/preflight.css">
  <link rel="stylesheet" href="/public/css/globals.css">
  <link rel="stylesheet" href="/public/css/navbar.css">
  <link rel="stylesheet" href="/public/css/notfound.css">
</head>

<body>
<?php include dirname(__DIR__) . '/components/Navbar.php' ?>
  <div class="container">
    <main>
      <h1>Page not found</h1>
      <p>Uh oh, we can't seem to find the page you're looking for. Try going back to the previous page.</p>
      <button class="button" onclick="handleClick()">Go to your feed</button>
    </main>
  </div>
</body>
<script>
  function handleClick() {
    window.location.href = '/';
  }
</script>

</html>