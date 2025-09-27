<?php
require_once __DIR__ . '/config/database.php';

$email = $new_password = $confirm_password = "";
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $new_password = trim($_POST["new_password"]);
    $confirm_password = trim($_POST["confirm_password"]);

    if (!empty($email) && !empty($new_password) && !empty($confirm_password)) {
        if ($new_password !== $confirm_password) {
            $message = '<div class="alert alert-danger">Passwords do not match!</div>';
        } else {
            // Check if email exists
            $sql = "SELECT id FROM users WHERE email = ?";
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $stmt->store_result();

                if ($stmt->num_rows == 1) {
                    // Hash password
                    $hashedPassword = password_hash($new_password, PASSWORD_BCRYPT);

                    // Update DB
                    $update_sql = "UPDATE users SET password=? WHERE email=?";
                    if ($update_stmt = $conn->prepare($update_sql)) {
                        $update_stmt->bind_param("ss", $hashedPassword, $email);
                        if ($update_stmt->execute()) {
                            $message = '<div class="alert alert-info">Password updated successfully! <a href="login.php">Login now</a></div>';
                        } else {
                            $message = '<div class="alert alert-danger">Error updating password.</div>';
                        }
                        $update_stmt->close();
                    }
                } else {
                    $message = '<div class="alert alert-danger">No account found with that email.</div>';
                }
                $stmt->close();
            }
        }
    } else {
        $message = '<div class="alert alert-danger">All fields are required.</div>';
    }
}

include __DIR__ . '/includes/header.php';
?>

<div class="form-container">
    <h2>Reset Password</h2>
    <p>Please enter your email and new password.</p>
    <?php echo $message; ?>
    <form method="post">
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
        </div>
        <div class="form-group">
            <label>New Password</label>
            <input type="password" name="new_password" required>
        </div>
        <div class="form-group">
            <label>Confirm New Password</label>
            <input type="password" name="confirm_password" required>
        </div>
        <div class="form-group">
            <input type="submit" class="btn" value="Reset Password">
        </div>
    </form>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
