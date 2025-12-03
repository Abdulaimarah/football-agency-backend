<?php
include 'db_connect.php'; 

// Fetch all users and their roles
$sql = "SELECT 
            u.first_name, u.last_name, u.email, r.role_name, u.club, u.position
        FROM 
            users u
        JOIN 
            roles r ON u.role_id = r.role_id
        ORDER BY 
            r.role_name, u.last_name";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Management Dashboard</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>
    <h1>System Users & Roles</h1>
    
    <?php if ($result && $result->num_rows > 0): ?>
    <table>
        <thead>
            <tr>
                <th>Role</th>
                <th>Name</th>
                <th>Email</th>
                <th>Club</th>
                <th>Position</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['role_name']); ?></td>
                <td><?php echo htmlspecialchars($row['first_name'] . ' ' . $row['last_name']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['club'] ?? 'N/A'); ?></td>
                <td><?php echo htmlspecialchars($row['position'] ?? 'N/A'); ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <?php else: ?>
    <p>No users found in the database.</p>
    <?php endif; ?>

    <?php $conn->close(); ?>
</body>
</html>