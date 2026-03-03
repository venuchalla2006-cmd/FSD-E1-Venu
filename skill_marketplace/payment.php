<?php
include 'config.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$course_id = $_GET['id'] ?? 0;

$course = $conn->query("SELECT * FROM courses WHERE id='$course_id'")->fetch_assoc();

if(!$course){
    die("Course not found");
}

include 'header.php';
?>

<div class="card p-4" style="max-width:500px; margin:auto;">

    <h3>Payment Details</h3>
    <hr>

    <h5><?php echo htmlspecialchars($course['title']); ?></h5>
    <p class="text-success fw-bold">Amount: ₹ <?php echo $course['price']; ?></p>

    <hr>

    <form method="POST" action="process_payment.php">
        <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">

        <label>Card Number</label>
        <input type="text" class="form-control mb-3" placeholder="1234 5678 9012 3456" required>

        <label>Expiry Date</label>
        <input type="text" class="form-control mb-3" placeholder="MM/YY" required>

        <label>CVV</label>
        <input type="text" class="form-control mb-3" placeholder="123" required>

        <button class="btn btn-success w-100" type="submit">
            Pay ₹ <?php echo $course['price']; ?>
        </button>
    </form>

</div>

<?php include 'footer.php'; ?>