<?php
session_start();
include "db.php";

$docroot = rtrim(str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']), '/');
$base = str_replace($docroot, '', str_replace('\\', '/', __DIR__));

// Already logged in -> go to dashboard
if (!empty($_SESSION['user_id'])) {
    header("Location: $base/index.php");
    exit;
}

// First run: create a default admin account if there are no users yet
$count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM users"))['c'];
if ($count == 0) {
    $hash = password_hash('admin123', PASSWORD_DEFAULT);
    mysqli_query($conn, "INSERT INTO users (username, password_hash, full_name)
        VALUES ('admin', '$hash', 'Administrator')");
}

$error = "";
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, trim($_POST['username']));
    $password = $_POST['password'];

    $u = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE username='$username'"));

    if ($u && password_verify($password, $u['password_hash'])) {
        session_regenerate_id(true);
        $_SESSION['user_id']  = $u['user_id'];
        $_SESSION['username'] = $u['username'];
        header("Location: $base/index.php");
        exit;
    }
    $error = "Invalid username or password.";
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Login</title><link rel="stylesheet" href="<?php echo $base; ?>/style.css"></head>
<body class="login-page">
<h2>🎀 Login 🎀</h2>

<?php if ($error) { ?>
  <p class="error"><?php echo $error; ?></p>
<?php } ?>

<form method="post">
  <label>Username</label><br>
  <input type="text" name="username" required autofocus><br><br>

  <label>Password</label><br>
  <input type="password" name="password" required><br><br>

  <button type="submit" name="login">Login</button>
</form>
</body>
</html>
