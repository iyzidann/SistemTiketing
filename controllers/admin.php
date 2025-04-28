<?php 
    function createEvent () {
        include('./configs/database.php');

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'Buat Event') {
            // Capture Request Values
            $event_name = $_POST['event_name'];
            $event_description = $_POST['event_description'];
            $event_price = $_POST['event_price'];

            // DB Query
            $query = 'INSERT INTO events (event_name, event_description, event_price) VALUES (?, ?, ?)';
            $stmt = $db->prepare($query);
            $stmt->bind_param('ssi', $event_name, $event_description, $event_price);
            
            // Execute query
            if ($stmt->execute()) {
                echo '<script>alert("Berhasil membuat event.");</script>';
            } else {
                echo '<script>alert("Gagal membuat event. Ada kesalahan di sisi server :(");</script>';
            }
            
            // Close statement
            $stmt->close();
        }
    }
?>