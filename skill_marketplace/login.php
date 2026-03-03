<?php
include 'config.php';

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $result = $conn->query("SELECT * FROM users WHERE email='$email'");
    
    if($result->num_rows > 0){
        $user = $result->fetch_assoc();
        
        if(password_verify($password, $user['password'])){
            $_SESSION['user_id'] = $user['id'];
            
            if($user['role'] == 'admin'){
                header("Location: admin_dashboard.php");
            } else {
                header("Location: dashboard.php");
            }
            exit();
        } else {
            $error = "Invalid Credentials";
        }
    } else {
        $error = "Invalid Credentials";
    }
}

include 'header.php';
?>

<div class="card auth-card">
    <h3 class="auth-title">Login to Your Account</h3>

    <?php if(isset($error)){ ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php } ?>

    <form method="POST">
        <input type="email" name="email" class="form-control mb-3" placeholder="Email Address" required>
        <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>
        <button class="btn btn-primary w-100" name="login">Login</button>
    </form>

    <div class="text-center mt-3">
        Don't have an account?
        <a href="register.php">Register</a>
    </div>
</div>

<?php include 'footer.php'; ?>