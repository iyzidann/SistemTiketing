<?php 
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'Daftar Event') {
        registerEvent();
    }
?>

<!-- Event List -->
<section class="container">
    <div class="card card-full">
        <div class="card-body">
            <div class="flex justify-between items-center">
                <div class="flex flex-col">
                    <p class="text-title">Event</p>
                    <p class="text-subtitle">Cari event yang kamu suka dan ikuti eventnya sekarang juga.</p>
                </div>
                <a href="index.php?page=login" style="text-decoration: none; color: gray;">Login Admin</a>
            </div>
        </div>
    </div>
    <div class="flex flex-col margin-vertical-xl">
        <div class="flex justify-between items-center">
            <p class="text-title">Event List</p>
            <form action="" method="POST" class="form-groups">            
                <select name="event_price" id="filter-price" class="form-select">
                    <option value="">Filter Event Price</option>
                    <option value="50000-100000">50000 - 100000</option>
                    <option value="200000-300000">200000 - 300000</option>
                </select>
            </form>
        </div>
        <div class="grid grid-auto">
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
    </div>
</section>

<!-- Modal Event Detail & Register Event -->
<div class="modal" style="display: none;">
    <div class="card card-lg">
        <div class="card-header">
            <p class="card-title">Detail Event</p>
        </div>
        <div class="card-body">
            <div class="flex flex-col">
                <p class="detail-event-title"></p>
                <p class="detail-event-price"></p>
            </div>
            <div class="margin-vertical-lg">
                <div class="flex flex-col">
                    <p class="text-title">Daftar Sekarang Juga</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="form-groups">
                        <input type="hidden" name="event_id" id="event_id">
                        <div class="form-group">
                            <label for="registrar_name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-input" id="registrar_name" name="registrar_name" placeholder="Masukkan nama lengkap" required>
                        </div>
                        <div class="form-group">
                            <label for="registrar_email" class="form-label">Email</label>
                            <input type="email" class="form-input" id="registrar_email" name="registrar_email" placeholder="Masukkan email" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="action" value="Daftar Event">
                            <button class="btn btn-danger">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function showEventModal(eventData) {
        document.querySelector('.detail-event-title').textContent = eventData.name + ' - RP' + eventData.price;
        document.querySelector('.detail-event-price').textContent = eventData.description;
        document.querySelector('#event_id').value = eventData.id;

        document.querySelector('.modal').style.display = 'block';
    };

    document.querySelectorAll('.card.card-full').forEach((card) => {
        card.addEventListener('click', function () {
            let eventName = this.querySelector('.event-title').textContent;
            let eventPrice = this.querySelector('.event-price').textContent.replace('Price: Rp', '');
            let eventDescription = this.querySelector('.event-description-hidden').textContent;
            let eventId = this.querySelector('.event-id-hidden').textContent;

            let eventData = {
                id: eventId,
                name: eventName,
                price: eventPrice,
                description: eventDescription
            };

            showEventModal(eventData);
        });
    });

    document.querySelector('.modal .btn-danger').addEventListener('click', function() {
        document.querySelector('.modal').style.display = 'none';
    });
</script>

<script type="text/javascript">
    function setCookie(name, value, days) {
        let expires = "";

        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
        }

        document.cookie = name + "=" + (value || "") + expires + "; path=/";
    }

    function getCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');

        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
        }

        return null;
    }

    $(document).ready(function() {
        $('#filter-price').change(function() {
            let selectedRange = $(this).val();
            
            setCookie('priceFilter', selectedRange, 1);

            if (selectedRange === '') {
                $('.card.card-full.card-event').show();
            } else {
                let priceRange = selectedRange.split('-');
                let minPrice = parseInt(priceRange[0]);
                let maxPrice = parseInt(priceRange[1]);

                $('.card.card-full.card-event').each(function() {
                    let price = parseInt($(this).find('.event-price').text().replace('Price: Rp', '').trim());

                    if (price >= minPrice && price <= maxPrice) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            }
        });

        let savedPrice = getCookie('priceFilter');
        if (savedPrice !== '') {
            $('#filter-price').val(savedPrice).change();
        }
    });
</script>