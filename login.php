<?php
session_start();
include 'db.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MAHSA University Grading System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="login-body-wrapper">

<div class="auth-card">
    <!-- Left Sidebar with Official Logo & Navy Theme -->
    <div class="auth-sidebar">
        <div class="logo-container">
            <img src="https://cdn.eduadvisor.my/institution/mahsa/ea-inst-logo-mahsa.png" alt="MAHSA University Logo">
        </div>
        <div class="sidebar-content">
            <p style="font-size: 11px; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 8px; color: #94a3b8; font-weight: 600;">Faculty Portal</p>
            <h2>Secure Student Grading & Academic Management System</h2>
        </div>
        <div class="sidebar-footer">
            MAHSA University • DU044(B)
        </div>
    </div>

    <!-- Right Form Panel -->
    <div class="auth-form-container">
        <div class="form-header">
            <h1>Admin Login</h1>
            <p>Enter your institutional credentials to proceed.</p>
        </div>

        <form method="post">
            <div class="input-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="Enter admin username" required>
            </div>

            <div class="input-group">
                <label>Password</label>
                <div class="password-wrapper" style="position: relative;">
                    <input type="password" name="password" id="passwordField" placeholder="••••••••" required style="padding-right: 65px;">
                    <button type="button" id="toggleBtn" onclick="togglePassword()" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; color: #002855; font-weight: 600; font-size: 13px; cursor: pointer; padding: 4px 8px;">Show</button>
                </div>
            </div>

            <button type="submit" name="login" class="btn-submit">Login to Portal</button>
        </form>

        <?php
        if (isset($_POST['login'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $result = $conn->query("SELECT * FROM grading_system WHERE username='$username' AND password='$password'");

            if ($result->num_rows > 0) {
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['username'] = $username;
                header("Location: index.php");
                exit();
            } else {
                echo "<p class='error-msg'>Invalid username or password!</p>";
            }
        }
        ?>
    </div>
</div>

<script>
    function togglePassword() {
        const passwordField = document.getElementById('passwordField');
        const toggleBtn = document.getElementById('toggleBtn');
        
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            toggleBtn.textContent = 'Hide';
        } else {
            passwordField.type = 'password';
            toggleBtn.textContent = 'Show';
        }
    }
</script>

</body>
</html>