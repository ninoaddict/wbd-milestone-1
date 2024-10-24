<?php 
    extract($data);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Profile company">
    <meta name="keywords" content="job, apply, vacancy, LinkinPurry">
    <link rel="stylesheet" href="/public/css/preflight.css">
    <link rel="stylesheet" href="/public/css/globals.css">
    <link rel="stylesheet" href="/public/css/navbar.css">
    <link rel="stylesheet" href="/public/css/comp-profile.css">
    <link rel="stylesheet" href="/public/css/toast.css">
    <link rel="stylesheet" href="/public/css/footer.css">
    <title>Company Profile</title>
</head>
<body>
    <?php include dirname(__DIR__) . '/components/Navbar.php' ?>
    <main class="main">
        <div class="profile-container">
            <h1 class="head">Company Profile</h1>
            <form action="/profile" method="POST">
                <div class="form-group">
                    <label class="label">Company Name</label>
                    <input class='input-area' type="text" id="nama" name="nama" value="<?php echo $companyProfile['nama'] ?>" required>
                </div>
                <div class="form-group">
                    <label class="label">Location</label>
                    <input class='input-area' type="text" id="lokasi" name="lokasi" value="<?php echo $companyProfile['lokasi'] ?>" required>
                </div>
                <div class="form-group">
                    <label class="label">Description</label>
                    <textarea class='input-area' id="about" name="about" rows="5"><?php echo $companyProfile['about'] ?></textarea>
                </div>
                <button class="submit-button" type="submit">Submit</button>
            </form>
        </div>
    </main>
    <?php include dirname(__DIR__) . '/components/Footer.php' ?>
    <ul class="notifications"></ul>
</body>
<script src="/public/js/toast.js" defer></script>
<?php if (isset($errorMessage)): ?>
    <script defer>
        window.addEventListener('load', (event) => {
            createToast('error', '<?php echo $errorMessage ?>')
        });
    </script>
<?php endif; ?>
<?php if (isset($successMessage)): ?>
    <script defer>
        window.addEventListener('load', (event) => {
            createToast('success', '<?php echo $successMessage ?>')
        });
    </script>
<?php endif; ?>
</html>