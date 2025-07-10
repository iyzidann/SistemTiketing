<?php
    function login() {
        include('./configs/database.php');

        // Capture Request Values
        $user_username = $_POST['user_username'];
        $user_password = $_POST['user_password'];

        // DB Query
        $query = 'SELECT * FROM users WHERE user_username = ?';
        $stmt = $db->prepare($query);
        $stmt->bind_param('s', $user_username);
        $stmt->execute();
        $result = $stmt->get_result();

        // Result Check
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            if (md5($user_password) === $row['user_password']) {
                $_SESSION['admin_loggedin'] = true;
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['username'] = $row['user_username'];
                header('Location: index.php?page=admin');
                exit;
            } else {
                echo '<script>alert("Gagal login! Username atau password anda salah");</script>';
            }
        } else {
            echo '<script>alert("Gagal login! Username atau password anda salah");</script>';
        }

        $stmt->close();
    }

    function logout() {
        session_unset();
        session_destroy();
        header('Location: index.php?page=login');
        exit;
    }
?>
