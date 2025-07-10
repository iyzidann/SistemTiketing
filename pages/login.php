<?php 
    // Login function is now handled in index.php
?>

<section class="login-container">
    <div class="card card-sm">
        <div class="card-header">
            <p class="card-title">Event - Admin Login</p>
        </div>
        <div class="card-body">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="form-groups">
                <div class="form-group">
                    <label for="user_username" class="form-label">Username</label>
                    <input type="text" class="form-input" id="user_username" name="user_username" placeholder="Input your username" required>
                </div>
                <div class="form-group">
                    <label for="user_password" class="form-label">Password</label>
                    <input type="password" class="form-input" id="user_password" name="user_password" placeholder="Input your password" required>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="action" value="Login">
                </div>
            </form>
            <div class="form-group" style="margin-top: 20px; text-align: center;">
                <a href="index.php" class="btn btn-outline">← Back to Events</a>
            </div>
        </div>
    </div>
</section>