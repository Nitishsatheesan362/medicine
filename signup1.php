<?php
// Database connection details
$host = 'localhost';
$dbname = 'doctor'; // Replace with your database name
$username = 'root'; // Replace with your MySQL username
$password = ''; // Replace with your MySQL password

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extracting doctor details from the form
   
    $demail = $_POST['demail'];
    $dname = $_POST['dname'];
    $daddress = $_POST['daddress'];
    $dph_no = $_POST['dph_no'];

    try {
        // Create a new PDO instance
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

        // Set the PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // SQL query to insert doctor details into the doctor table
        $sql = "INSERT INTO doctor (demail, dname, daddress, dph_no) VALUES (:demail, :dname, :daddress, :dph_no)";

        // Prepare the SQL statement
        $stmt = $pdo->prepare($sql);

        // Bind parameters
       
        $stmt->bindParam(':demail', $demail);
        $stmt->bindParam(':dname', $dname);
        $stmt->bindParam(':daddress', $daddress);
        $stmt->bindParam(':dph_no', $dph_no);

        // Execute the SQL statement
        $stmt->execute();

        $message = "Doctor registration successful!";

    } catch (PDOException $e) {
        $message = "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="signup1.css">
    <title>Doctor Sign Up</title>
    
</head>
<body>
    <h2>Doctor Sign Up</h2>
    <?php if (!empty($message)) : ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>
    <form action="" method="post">

        <label>Email:</label>
        <input type="email" name="demail" required><br><br>

        <label>Name:</label>
        <input type="text" name="dname" required><br><br>

        <label>Address:</label>
        <input type="text" name="daddress" required><br><br>

        <label>Phone Number:</label>
        <input type="text" name="dph_no" required><br><br>

        <input type="submit" value="Sign Up">
    </form>
</body>
</html>
