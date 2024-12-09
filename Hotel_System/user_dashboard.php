<?php
include ('db.php');
session_start();
    // if its not guest... it will return to log_in.php
    if (!isset($_SESSION['userID']) || $_SESSION['role'] !== 'Guest') {
        header('Location: login.php');
        exit();
    }

        $userID = $_SESSION['userID'];
        $sql = "SELECT * FROM Bookings INNER JOIN Rooms ON Bookings.RoomID =
        Rooms.RoomID WHERE UserID='$userID'";
        $bookings = $conn->query($sql);
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guest Dashboard</title>
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['name']; ?>!</h1>
    <h2>Your Bookings</h2>

    <table border="1">
        <tr>
            <th>Room Number</th>
            <th>Room Type</th>
            <th>Check-In</th>
            <th>Check-Out</th>
        </tr>
        <?php while ($row = $bookings->fetch(PDO::FETCH_ASSOC)) { ?>
        <tr>
            <td><?php echo $row['RoomNumber']; ?></td>
            <td><?php echo $row['RoomType']; ?></td>
            <td><?php echo $row['CheckInDate']; ?></td>
            <td><?php echo $row['CheckOutDate']; ?></td>
        </tr>
        <?php } ?>
    </table>
    <a href="user_search.php">Search for Rooms</a>
    <a href="logout.php">Log Out</a>
    
</body>
</html>