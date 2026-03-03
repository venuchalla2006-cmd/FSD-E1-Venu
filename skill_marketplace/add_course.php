<?php
include 'config.php';

// Check admin login
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user = $conn->query("SELECT * FROM users WHERE id=".$_SESSION['user_id'])->fetch_assoc();
if($user['role'] != 'admin'){
    die("Access Denied");
}

if(isset($_POST['add'])){
    
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    
    // Image Upload
    $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    
    // Create unique name
    $new_image_name = time() . "_" . $image_name;
    
    move_uploaded_file($image_tmp, "images/" . $new_image_name);
    
    // Insert into DB
    $conn->query("INSERT INTO courses(title,description,price,image)
                  VALUES('$title','$description','$price','$new_image_name')");
    
    $success = "Course Added Successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Course</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="style.css">
</head>

<body>
<div class="container mt-5">

<h2>Add New Course</h2>
<hr>

<?php if(isset($success)){ ?>
    <div class="alert alert-success"><?php echo $success; ?></div>
<?php } ?>

<form method="POST" enctype="multipart/form-data">

    <input type="text" name="title" class="form-control mb-3" placeholder="Course Title" required>

    <textarea name="description" class="form-control mb-3" placeholder="Course Description" required></textarea>

    <input type="number" name="price" class="form-control mb-3" placeholder="Course Price" required>

    <label>Upload Course Image</label>
    <input type="file" name="image" class="form-control mb-3" accept="image/*" required>

    <button class="btn btn-primary" name="add">Add Course</button>
    <a href="admin_dashboard.php" class="btn btn-secondary">Back</a>

</form>

</div>
</body>
</html>