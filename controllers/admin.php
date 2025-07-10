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

    function deleteEvent () {
        include('./configs/database.php');

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'Hapus Event') {
            // Capture Request Values
            $event_id = $_POST['event_id'];

            // First, delete related registrars
            $delete_registrars_query = 'DELETE FROM registrars WHERE registrar_event_id = ?';
            $delete_registrars_stmt = $db->prepare($delete_registrars_query);
            $delete_registrars_stmt->bind_param('s', $event_id);
            $delete_registrars_stmt->execute();
            $delete_registrars_stmt->close();

            // Then delete the event
            $query = 'DELETE FROM events WHERE event_id = ?';
            $stmt = $db->prepare($query);
            $stmt->bind_param('s', $event_id);
            
            // Execute query
            if ($stmt->execute()) {
                echo '<script>alert("Berhasil menghapus event.");</script>';
            } else {
                echo '<script>alert("Gagal menghapus event. Ada kesalahan di sisi server :(");</script>';
            }
            
            // Close statement
            $stmt->close();
        }
    }
?>