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
                    <div class="history-card">
                        <div class="history-content">
                            <p class="application-id">ID: <?= htmlspecialchars($historyItem['lamaran_id']); ?></p>
                            <h2 class="company-name"><?= htmlspecialchars($historyItem['nama']); ?></h2>
                            <p class="position"><?= htmlspecialchars($historyItem['posisi']); ?></p>
                        </div>
                        <div class="date-status">
                            <?= htmlspecialchars($historyItem['created_at']); ?>
                            <p class="status"> <?= htmlspecialchars($historyItem['status']); ?> </p>
                        </div>
                    </div>
                <?php } ?>
            <?php } else {?>
                <p class="empty-message">No application history available at the moment.</p>
            <?php } ?>


            <!-- <div class='background-list'>
                <div class="history-card">
                    <div class="history-content">
                        <p class="application-id">ID: #1</p>
                        <h2 class="company-name">Warja</h2>
                        <p class="position">Software Engineer</p>
                    </div>
                    <div class="date-status">
                        <p>08 - 06 - 2018</p>
                        <p class="status">Accepted</p>
                    </div>
                </div>
            
                <div class="history-card">
                    <div class="history-content">
                        <p class="application-id">ID: #2</p>
                        <h2 class="company-name">Sadikin</h2>
                        <p class="position">Data Analyst</p>
                    </div>
                    <div class="date-status">
                        <p>21 - 04 - 2018</p>
                    </div>
                </div>
            
                <div class="history-card">
                    <div class="history-content">
                        <p class="application-id">ID: #3</p>
                        <h2 class="company-name">Efzet Laundry</h2>
                        <p class="position">Machine Learning Engineer</p>
                    </div>
                    <div class="date-status">
                        <p>01 - 01 - 2018</p>
                    </div>
                </div>
            
                <div class="history-card">
                    <div class="history-content">
                        <p class="application-id">ID: #4</p>
                        <h2 class="company-name">Warbir</h2>
                        <p class="position">Reservoir Engineer</p>
                    </div>
                    <div class="date-status">
                        <p>05 - 12 - 2017</p>
                    </div>
                </div>
            
                <div class="history-card">
                    <div class="history-content">
                        <p class="application-id">ID: #5</p>
                        <h2 class="company-name">Ayam-Ayaman</h2>
                        <p class="position">Airport Researcher</p>
                    </div>
                    <div class="date-status">
                        <p>12 - 09 - 2017</p>
                    </div>
                </div>
            
                <div class="history-card">
                    <div class="history-content">
                        <p class="application-id">ID: #6</p>
                        <h2 class="company-name">Borma</h2>
                        <p class="position">Cloud Architect</p>
                    </div>
                    <div class="date-status">
                        <p>05 - 02 - 2016</p>
                    </div>
                </div>
            </div> -->
        </div>
    </div>


    <div class="space"></div>
    <script src="/public/js/history.js"></script>
</body>
</html>