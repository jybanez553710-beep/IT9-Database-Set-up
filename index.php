<?php

include "auth.php";
include "db.php";

$clients_result = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS c FROM clients"
);

$clients = mysqli_fetch_assoc($clients_result)['c'];


$services_result = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS c FROM services"
);

$services = mysqli_fetch_assoc($services_result)['c'];


$bookings_result = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS c FROM bookings"
);

$bookings = mysqli_fetch_assoc($bookings_result)['c'];


$revenue_result = mysqli_query(
    $conn,
    "SELECT IFNULL(SUM(amount_paid), 0) AS s FROM payments"
);

$revenue_row = mysqli_fetch_assoc($revenue_result);

$revenue = $revenue_row['s'];

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Assessment Dashboard</title>

</head>

<body>

<?php include "nav.php"; ?>

<h1>Assessment Dashboard</h1>

<h2>System Overview</h2>

<ul>

    <li>
        Total Clients:
        <strong><?php echo $clients; ?></strong>
    </li>

    <li>
        Total Services:
        <strong><?php echo $services; ?></strong>
    </li>

    <li>
        Total Bookings:
        <strong><?php echo $bookings; ?></strong>
    </li>

    <li>
        Total Revenue:
        <strong>
            ₱<?php echo number_format($revenue, 2); ?>
        </strong>
    </li>

</ul>

<h2>Quick Links</h2>

<p>

    <a href="<?php echo $base; ?>/pages/clients_add.php">
        Add Client
    </a>

</p>

<p>

    <a href="<?php echo $base; ?>/pages/bookings_create.php">
        Create Booking
    </a>

</p>

</body>

</html>