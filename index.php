<?php
session_start();

// Security check: Prevent direct access without logging in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

include 'db.php';

// Check if a search query was submitted
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

if ($search !== '') {
    // Search filter across name, matric, subject name, and subject code
    $query = "SELECT * FROM results WHERE student_name LIKE ? OR matric_no LIKE ? OR subject_name LIKE ? OR subject_code LIKE ?";
    $stmt = $conn->prepare($query);
    $searchTerm = "%" . $search . "%";
    $stmt->bind_param("ssss", $searchTerm, $searchTerm, $searchTerm, $searchTerm);
} else {
    $query = "SELECT * FROM results";
    $stmt = $conn->prepare($query);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Grading System - MAHSA University</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- MAHSA Institutional Header Banner -->
    <div class="mahsa-header">
        <div style="display: flex; align-items: center; gap: 15px;">
            <img src="https://cdn.eduadvisor.my/institution/mahsa/ea-inst-logo-mahsa.png" alt="MAHSA University Logo" style="height: 42px; background: white; padding: 4px 10px; border-radius: 6px;">
            <h1 style="margin: 0; font-size: 20px; color: white; border: none; padding: 0;">Student Grading System</h1>
        </div>
        <div>
            <span style="font-size: 13px; background: rgba(255,255,255,0.15); padding: 6px 14px; border-radius: 20px; font-weight: 600; margin-right: 15px;">Admin: <?php echo htmlspecialchars($_SESSION['username']); ?></span>
            <a href="logout.php" style="background: #C41E3A; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-size: 14px; font-weight: 600;">Logout</a>
        </div>
    </div>

    <div class="container">
        
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2>Student Results Management</h2>
            <a href="add.php" class="btn" style="background: #002855; color: white; padding: 10px 18px; border-radius: 6px; text-decoration: none; font-weight: 600;">+ Add New Student Result</a>
        </div>

        <!-- Enhanced Modern Search Bar -->
        <form method="GET" action="index.php" style="display: flex; gap: 12px; align-items: center; background: #ffffff; padding: 12px 20px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; margin-bottom: 25px;">
            <span style="font-size: 16px; color: #64748b;">🔍</span>
            <input type="text" name="search" placeholder="Search by student name, matric number, subject name or code..." value="<?php echo htmlspecialchars($search); ?>" style="flex: 1; border: none; outline: none; font-size: 14px; background: transparent; color: #1e293b; padding: 4px; margin-bottom: 0;">
            <input type="submit" value="Search" style="background: #002855; color: white; padding: 10px 22px; border: none; border-radius: 6px; cursor: pointer; font-weight: 600; transition: background 0.2s;">
            
            <?php if ($search !== ''): ?>
                <a href="index.php" style="background: #ffeeef; color: #C41E3A; padding: 10px 16px; border-radius: 6px; text-decoration: none; font-size: 14px; font-weight: 600;">Clear Search</a>
            <?php else: ?>
                <a href="index.php" style="color: #64748b; font-size: 14px; text-decoration: none; padding: 10px 8px;">Show All</a>
            <?php endif; ?>
        </form>

        <table>
            <tr>
                <th>No</th>
                <th>Student Name</th>
                <th>Matrix Number</th>
                <th>Subject Name</th>
                <th>Subject Code</th>
                <th>Test 1 (20%)</th>
                <th>Test 2 (30%)</th>
                <th>Final (50%)</th>
                <th>Total (100)</th>
                <th>Grade</th>
                <th>Actions</th>
            </tr>
            <?php
            $no = 1;
            while ($row = $result->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo htmlspecialchars($row['student_name']); ?></td>
                <td><?php echo htmlspecialchars($row['matric_no']); ?></td>
                <td><?php echo htmlspecialchars($row['subject_name']); ?></td>
                <td><?php echo htmlspecialchars($row['subject_code']); ?></td>
                <td><?php echo number_format($row['test1'], 2); ?></td>
                <td><?php echo number_format($row['test2'], 2); ?></td>
                <td><?php echo number_format($row['final_exam'], 2); ?></td>
                <td><?php echo number_format($row['total_marks'], 2); ?></td>
                <td><?php echo htmlspecialchars($row['grade']); ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $row['result_id']; ?>" class="btn-edit">Edit</a>
                    <a href="delete.php?id=<?php echo $row['result_id']; ?>" onclick="return confirm('Are you sure you want to delete this record?')" class="btn-delete">Delete</a>
                </td>
            </tr>
            <?php
            }
            ?>
        </table>
    </div>

</body>
</html>