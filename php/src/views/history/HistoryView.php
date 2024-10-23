<?php 
    extract($data);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/css/preflight.css">
    <link rel="stylesheet" href="/public/css/globals.css">
    <link rel="stylesheet" href="/public/css/navbar.css">
    <link rel="stylesheet" href="/public/css/history.css">
    <title>History</title>
</head>
<body>
    <?php include dirname(__DIR__) . '/components/Navbar.php' ?>
    <div class="space"></div>
    <h1>Application History</h1>

    <div class="button-and-list">
        <div class="filter-buttons">
            <button id="all-button" class="filter-button <?= $selectedStatus === 'all' ? 'active' : '' ?>" data-status="all">All</button>
            <button id="accepted-button" class="filter-button <?= $selectedStatus === 'accepted' ? 'active' : '' ?>" data-status="accepted">Accepted</button>
            <button id="waiting-button" class="filter-button <?= $selectedStatus === 'waiting' ? 'active' : '' ?>" data-status="waiting">Waiting</button>
            <button id="rejected-button" class="filter-button <?= $selectedStatus === 'rejected' ? 'active' : '' ?>" data-status="rejected">Rejected</button>
        </div>
        
        <div id="application-list">
            <?php if (!empty($historyList)) {?>
                <?php foreach ($historyList as $historyItem){ ?>
                    <div class="history-card" data-id="<?= $historyItem['lowongan_id'] ?>">
                        <div class="history-content">
                            <p class="vacancy-id">ID: <?= htmlspecialchars($historyItem['lowongan_id']); ?></p>
                            <h2 class="company-name"><?= htmlspecialchars($historyItem['nama']); ?></h2>
                            <p class="position"><?= htmlspecialchars($historyItem['posisi']); ?></p>
                        </div>
                        <div class="date-status">
                            <?= htmlspecialchars($historyItem['created_time']); ?>
                            <p class="status"> <?= htmlspecialchars($historyItem['status']); ?> </p>
                        </div>
                    </div>
                <?php } ?>
            <?php } else {?>
                <p class="empty-message">No application history available at the moment.</p>
            <?php } ?>
        </div>
    </div>


    <div class="space"></div>
    <script src="/public/js/history.js"></script>
</body>
</html>