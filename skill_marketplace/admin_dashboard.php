<?php
include 'config.php';

// Check login
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

// Get current user
$user = $conn->query("SELECT * FROM users WHERE id=".$_SESSION['user_id'])->fetch_assoc();

// Check admin role
if($user['role'] != 'admin'){
    die("Access Denied");
}

// Dashboard statistics
$total_users = $conn->query("SELECT COUNT(*) as count FROM users WHERE role='user'")->fetch_assoc()['count'];
$total_courses = $conn->query("SELECT COUNT(*) as count FROM courses")->fetch_assoc()['count'];
$total_enrollments = $conn->query("SELECT COUNT(*) as count FROM enrollments")->fetch_assoc()['count'];

include 'header.php';
?>

<h2>Admin Dashboard</h2>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card p-3 bg-primary text-white">
            <h5>Total Users</h5>
            <h3><?php echo $total_users; ?></h3>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-3 bg-success text-white">
            <h5>Total Courses</h5>
            <h3><?php echo $total_courses; ?></h3>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-3 bg-dark text-white">
            <h5>Total Enrollments</h5>
            <h3><?php echo $total_enrollments; ?></h3>
        </div>
    </div>
</div>

<div class="mb-3">
    <a class="btn btn-primary" href="add_course.php">Add Course</a>
    <a class="btn btn-success" href="admin_users.php">View Users</a>
    <a class="btn btn-danger" href="logout.php">Logout</a>
</div>

<h4>All Courses</h4>

<?php
$result = $conn->query("SELECT * FROM courses");

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
?>

    <div class="card p-3 mb-3">
        <div class="row align-items-center">

            <!-- Image -->
            <div class="col-md-3">
                <?php if(!empty($row['image'])){ ?>
                    <img src="images/<?php echo $row['image']; ?>" 
                         class="img-fluid"
                         style="height:120px; object-fit:cover;">
                <?php } ?>
            </div>

            <!-- Details -->
            <div class="col-md-6">
                <h5><?php echo htmlspecialchars($row['title']); ?></h5>
                <p><?php echo htmlspecialchars($row['description']); ?></p>
                <p><strong>₹ <?php echo htmlspecialchars($row['price']); ?></strong></p>
            </div>

            <!-- Actions -->
            <div class="col-md-3">
                <a class="btn btn-danger"
                   href="delete_course.php?id=<?php echo $row['id']; ?>"
                   onclick="return confirm('Delete this course?');">
                   Delete
                </a>
            </div>

        </div>
    </div>

<?php
    }
} else {
    echo "<div class='alert alert-warning'>No courses available</div>";
}

include 'footer.php';
?>