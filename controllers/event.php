<?php 
    function getEvents () {
        include('./configs/database.php');

        // DB Query
        $query = 'SELECT * FROM events';
        $stmt = $db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        $stmt->close();
        return $result;
    }

    function registerEvent () {
        include('./configs/database.php');

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'Daftar Event') {
            // Capture Request Values
            $event_id = $_POST['event_id'];
            $registrar_name = $_POST['registrar_name'];
            $registrar_email = $_POST['registrar_email'];

            // DB Query
            $query = 'INSERT INTO registrars (registrar_event_id, registrar_name, registrar_email) VALUES (?, ?, ?)';
            $stmt = $db->prepare($query);
            $stmt->bind_param('sss', $event_id, $registrar_name, $registrar_email);
            
            // Execute query
            if ($stmt->execute()) {
                echo '<script>alert("Berhasil mendaftar event.");</script>';
            } else {
                echo '<script>alert("Gagal mendaftar event. Ada kesalahan di sisi server :(");</script>';
            }
            
            // Close statement
            $stmt->close();
        }
    }
?>