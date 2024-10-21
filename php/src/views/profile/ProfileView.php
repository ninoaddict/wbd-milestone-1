<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/css/preflight.css">
    <link rel="stylesheet" href="/public/css/globals.css">
    <link rel="stylesheet" href="/public/css/navbar.css">
    <link rel="stylesheet" href="/public/css/comp-profile.css">
    <title>Company Profile - <?= htmlspecialchars($data['nama']) ?></title>
</head>
<body>
    <?php include dirname(__DIR__) . '/components/Navbar.php' ?>
    <div class="space"></div>

    <div class="box">
        <h1><?= htmlspecialchars($data['nama'])?></h1>
        <p class="location"><?= htmlspecialchars($data['lokasi'])?></p>
    </div>
    <div class="box">
        <h2>About</h2>
        <p><?= nl2br(htmlspecialchars($data['about']))?></p>
    </div>
</body>
</html>