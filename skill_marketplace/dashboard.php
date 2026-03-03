<?php
include 'config.php';

// Check login
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

// Get user details
$user_id = $_SESSION['user_id'];
$user = $conn->query("SELECT * FROM users WHERE id='$user_id'")->fetch_assoc();

include 'header.php';
?>

<h2 class="mb-4">Welcome, <?php echo htmlspecialchars($user['name']); ?> 👋</h2>

<?php if(isset($_GET['enrolled'])){ ?>
    <div class="alert alert-success">
        Course Enrolled Successfully!
    </div>
<?php } ?>

<div class="row">

    <div class="col-md-12">
        <h4 class="mb-3">My Enrolled Courses</h4>

        <?php
        $enrolled = $conn->query("
            SELECT courses.* 
            FROM enrollments 
            JOIN courses ON enrollments.course_id = courses.id
            WHERE enrollments.user_id='$user_id'
        ");

        if($enrolled->num_rows > 0){

            while($row = $enrolled->fetch_assoc()){
        ?>

            <div class="card mb-4 p-3">
                <div class="row align-items-center">

                    <!-- Course Image -->
                    <div class="col-md-3">
                        <?php if(!empty($row['image'])){ ?>
                            <img src="images/<?php echo $row['image']; ?>" 
                                 class="img-fluid rounded"
                                 style="height:150px; object-fit:cover;">
                        <?php } ?>
                    </div>

                    <!-- Course Details -->
                    <div class="col-md-6">
                        <h5 class="fw-bold"><?php echo htmlspecialchars($row['title']); ?></h5>
                        <p class="text-muted"><?php echo htmlspecialchars($row['description']); ?></p>
                        <p class="text-success fw-bold">₹ <?php echo htmlspecialchars($row['price']); ?></p>
                    </div>

                    <!-- Action -->
                    <div class="col-md-3 text-end">
                        <span class="badge bg-success mb-2">Enrolled</span><br>

                        <a class="btn btn-danger btn-sm"
                           href="unenroll.php?id=<?php echo $row['id']; ?>"
                           onclick="return confirm('Are you sure you want to unenroll?');">
                           Unenroll
                        </a>
                    </div>

                </div>
            </div>

        <?php
            }

        } else {
            echo "<div class='alert alert-warning'>You have not enrolled in any courses yet.</div>";
        }
        ?>

    </div>

</div>

<div class="mt-4">
    <a class="btn btn-primary" href="courses.php">Browse More Courses</a>
</div>

<?php include 'footer.php'; ?>