<?php 
    extract($data);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Profile company">
    <meta name="keywords" content="job, apply, vacancy, linkedin, Linkedin">
    <link rel="stylesheet" href="/public/css/preflight.css">
    <link rel="stylesheet" href="/public/css/globals.css">
    <link rel="stylesheet" href="/public/css/navbar.css">
    <link rel="stylesheet" href="/public/css/comp-profile.css">
    <title>Edit Company Profile</title>
</head>
<body>
    <?php include dirname(__DIR__) . '/components/Navbar.php' ?>
    <div class="space"></div>
    <div class="profile-container">
        <h1>Edit Company Profile</h1>
        <form action="/profile" method="POST">
            <div class="form-group">
                <label class="label">New Name</label>
                <input class='input-area' type="text" id="nama" name="nama" placeholder="Your new name here" required>
            </div>
            <div class="form-group">
                <label class="label">New Location</label>
                <input class='input-area' type="text" id="lokasi" name="lokasi" placeholder="Your new location here" required>
            </div>
            <div class="form-group">
                <label class="label">New Description</label>
                <textarea class='input-area' id="about" name="about" rows="8" placeholder="Your new company description here"></textarea>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>