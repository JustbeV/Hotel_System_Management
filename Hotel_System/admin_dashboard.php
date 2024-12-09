<?php

include('db.php');
session_start();

    if (!isset($_SESSION['userID']) || $_SESSION['role'] !== 'Admin') {
        header('Location: login.php');
        exit();
    }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $checkInDate = $_POST['checkInDate'];
            $checkOutDate = $_POST['checkOutDate'];
            $sql = "SELECT * FROM Rooms
            WHERE RoomID NOT IN (
            SELECT RoomID FROM Bookings
            WHERE ('$checkInDate' BETWEEN CheckInDate AND CheckOutDate)
            OR ('$checkOutDate' BETWEEN CheckInDate AND CheckOutDate)
            )";
            $result = $conn->query($sql);
    }
    ?>
<!DOCTYPE html>
    <html>
    <head><title>Admin Dashboard</title></head>
        <body>
            <h1>Admin Dashboard</h1>
            <h2>Search Available Rooms</h2>
            <form method="POST">
            <label>Check-In Date:</label><input type="date" name="checkInDate" required><br>
            <label>Check-Out Date:</label><input type="date" name="checkOutDate" required><br>
            <button type="submit">Search</button>
            </form>
            <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') { ?>
            <h3>Available Rooms</h3>
            <table border="1">
            <tr>
            <th>Room Number</th>
            <th>Room Type</th>
            <th>Price</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
            <td><?php echo $row['RoomNumber']; ?></td>
            <td><?php echo $row['RoomType']; ?></td>
            <td><?php echo $row['Price']; ?></td>
            </tr>
            <?php } ?>
            </table>
            <?php } ?>
            <a href="logout.php">Log Out</a>
        </body>
</html>