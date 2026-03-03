<?php
include 'config.php';
include 'header.php';

if(isset($_POST['add'])){
    $title=$_POST['title'];
    $description=$_POST['description'];
    $price=$_POST['price'];
    $image=$_POST['image'];

    $conn->query("INSERT INTO courses(title,description,price,image)
    VALUES('$title','$description','$price','$image')");

    echo "<div class='alert alert-success'>Course Added</div>";
}
?>

<h3>Add Course</h3>

<form method="POST">
<input class="form-control mb-2" name="title" placeholder="Title" required>
<textarea class="form-control mb-2" name="description" placeholder="Description"></textarea>
<input class="form-control mb-2" name="price" placeholder="Price" required>
<input class="form-control mb-2" name="image" placeholder="Image Name (example: php.jpg)" required>
<button class="btn btn-primary" name="add">Add Course</button>
</form>

<?php include 'footer.php'; ?>