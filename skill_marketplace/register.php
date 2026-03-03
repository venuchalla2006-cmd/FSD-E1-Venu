<?php
include 'config.php';

if(isset($_POST['register'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    $check = $conn->query("SELECT * FROM users WHERE email='$email'");
    
    if($check->num_rows > 0){
        $error = "Email already registered!";
    } else {
        $conn->query("INSERT INTO users(name,email,password,role)
                      VALUES('$name','$email','$password','user')");
        
        $_SESSION['user_id'] = $conn->insert_id;
        
        header("Location: dashboard.php");
        exit();
    }
}

include 'header.php';
?>

<div class="card auth-card">
    <h3 class="auth-title">Create Account</h3>

    <?php if(isset($error)){ ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php } ?>

    <form method="POST">
        <input type="text" name="name" class="form-control mb-3" placeholder="Full Name" required>
        <input type="email" name="email" class="form-control mb-3" placeholder="Email Address" required>
        <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>
        <button class="btn btn-success w-100" name="register">Create Account</button>
    </form>

    <div class="text-center mt-3">
        Already have an account?
        <a href="login.php">Login</a>
    </div>
</div>

<?php include 'footer.php'; ?>