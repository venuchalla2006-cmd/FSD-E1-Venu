<!DOCTYPE html>
<html>
<head>
    <title>Student Registration</title>
    <style>
        body {
            font-family: Arial;
            background: #f2f2f2;
        }
        .form-box {
            width: 400px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
        }
        input {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
        }
        button {
            width: 100%;
            padding: 10px;
            background: blue;
            color: white;
            border: none;
        }
    </style>
</head>
<body>

<div class="form-box">
    <h2>Student Registration</h2>
    <form method="POST" action="insert.php">
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="date" name="dob" required>
        <input type="text" name="department" placeholder="Department" required>
        <input type="text" name="phone" placeholder="Phone" required>
        <button type="submit">Register</button>
    </form>
</div>

</body>
</html>