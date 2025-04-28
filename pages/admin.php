<?php 
    if (!isset($_SESSION['admin_loggedin']) && $_SESSION['admin_loggedin'] !== true) {
        header('Location: index.php?page=event');
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'Buat Event') {
        createEvent();
    } else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'Logout') {
        logout();
    }
?>

<section>
    <header>
        <section class="navbar">
            <p class="navbar-title">Admin Event</p>
            <ul class="navbar-left-items">
            </ul>
            <ul class="navbar-right-items">
                <li>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <input type="submit" name="action" value="Logout" class="btn btn-danger btn-sm">
                    </form>
                </li>
            </ul>
        </section>
    </header>

    <main class="container">
        <section class="margin-vertical-xl flex justify-between gap-xl">
            <div class="grid grid-auto" style="width: 100%; height: fit-content;">
                <?php
                    $events = getEvents();

                    while ($event = mysqli_fetch_array($events)) {
                ?>
                    <div class="card card-full card-event">
                        <div class="card-body">
                            <div class="flex flex-col">
                                <p class="event-title"><?php echo $event['event_name'] ?></p>
                                <p class="event-price">Price: Rp<?php echo $event['event_price'] ?></p>
                                <p class="event-description-hidden"><?php echo $event['event_description'] ?></p>
                                <p class="event-id-hidden"><?php echo $event['event_id'] ?></p>
                            </div>
                        </div>
                    </div>
                <?php
                    }
                ?>
            </div>
            <div class="card card-full" style="height: fit-content;">
                <div class="card-body">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="form-groups">
                        <div class="form-group">
                            <label for="event_name" class="form-label">Nama Event</label>
                            <input type="text" class="form-input" id="event_name" name="event_name" placeholder="Masukkan nama event" required>
                        </div>
                        <div class="form-group">
                            <label for="event_description" class="form-label">Deskripsi Event</label>
                            <input type="text" class="form-input" id="event_description" name="event_description" placeholder="Masukkan deskripsi" required>
                        </div>
                        <div class="form-group">
                            <label for="event_price" class="form-label">Harga Event</label>
                            <input type="text" class="form-input" id="event_price" name="event_price" placeholder="Masukkan harga" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="action" value="Buat Event">
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
</section>