<?php 
    include('./controllers/event.php');
    include('./controllers/auth.php');
    include('./controllers/admin.php');
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event App</title>
    <link rel="stylesheet" href="./styles/styles.css">
    <link rel="stylesheet" href="./styles/event.css">
    <link rel="stylesheet" href="./styles/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body>
    <div>
        <?php
            if (isset($_GET['page'])) {
                if ($_GET['page'] === 'admin' && !isset($_SESSION['admin_loggedin'])) {
                    header('Location: index.php?page=event');
                    exit;
                }

                include('./pages/' . $_GET['page'] . '.php');
            } else {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if (isset($_POST['action']) && $_POST['action'] === 'Buat Event') {
                        include('./pages/admin.php');
                    } else if (isset($_POST['action']) && $_POST['action'] === 'Daftar Event') {
                        include('./pages/event.php');
                    } else if (isset($_POST['action']) && $_POST['action'] === 'Login') {
                        // Call the login function instead of including the page
                        login();
                        // If login fails, show the login page
                        if (!isset($_SESSION['admin_loggedin'])) {
                            include('./pages/login.php');
                        }
                    } else if (isset($_POST['action']) && $_POST['action'] === 'Logout') {
                        logout();
                    } else if (isset($_POST['action']) && $_POST['action'] === 'Hapus Event') {
                        include('./pages/admin.php');
                    }
                } else {
                    include('./pages/event.php');
                }
            }
        ?>
    </div>
</body>

</html>