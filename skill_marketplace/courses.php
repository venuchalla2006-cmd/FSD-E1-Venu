<?php
include 'config.php';
include 'header.php';

$result = $conn->query("SELECT * FROM courses");

while($row = $result->fetch_assoc()){
    ?>
    <div class="card mb-3 p-3">
        <div class="row">
            <div class="col-md-4">
                <img src="images/<?php echo $row['image']; ?>" 
                     class="img-fluid" 
                     style="height:200px; object-fit:cover;">
            </div>
           <div class="col-md-8">
    <h4><?php echo $row['title']; ?></h4>
    <p><?php echo $row['description']; ?></p>
    <p><b>Price:</b> ₹<?php echo $row['price']; ?></p>

    <a class="btn btn-warning"
       href="payment.php?id=<?php echo $row['id']; ?>">
       Enroll
    </a>
</div>
        </div>
    </div>
<?php
}
include 'footer.php';
?>