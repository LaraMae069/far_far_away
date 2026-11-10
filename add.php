<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

include 'db.php';

if (isset($_POST['save'])) {
    $student_name = $_POST['student_name'];
    $matric_no    = $_POST['matric_no'];
    $subject_name = $_POST['subject_name'];
    $subject_code = $_POST['subject_code'];
    
    $test1      = floatval($_POST['test1']);
    $test2      = floatval($_POST['test2']);
    $final_exam = floatval($_POST['final_exam']);

    $total_marks = $test1 + $test2 + $final_exam;

    if ($total_marks >= 80 && $total_marks <= 100) {
        $grade = 'A';
    } elseif ($total_marks >= 65 && $total_marks <= 79) {
        $grade = 'B';
    } elseif ($total_marks >= 50 && $total_marks <= 64) {
        $grade = 'C';
    } elseif ($total_marks >= 40 && $total_marks <= 49) {
        $grade = 'D';
    } else {
        $grade = 'E';
    }

    $stmt = $conn->prepare("INSERT INTO results (student_name, matric_no, subject_name, subject_code, test1, test2, final_exam, total_marks, grade) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssdddds", $student_name, $matric_no, $subject_name, $subject_code, $test1, $test2, $final_exam, $total_marks, $grade);
    
    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        $error = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student Result - MAHSA University</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

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

    <div class="container" style="max-width: 700px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2>Add New Student Result</h2>
            <a href="index.php" style="color: #002855; font-weight: 600; text-decoration: none;">&larr; Back to Home</a>
        </div>

        <?php if (isset($error)) { echo "<p style='color:#C41E3A; font-weight:600; margin-bottom: 15px;'>$error</p>"; } ?>

        <form method="POST" style="max-width: 100%; background: #ffffff; padding: 35px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; border-top: 4px solid #002855;">
            
            <div class="input-group" style="margin-bottom: 18px;">
                <label style="display: block; font-size: 13px; font-weight: 600; color: #1e293b; margin-bottom: 6px;">Student Name:</label>
                <input type="text" name="student_name" placeholder="Enter student full name" required style="width: 100%; padding: 11px 14px; border: 1px solid #cbd5e1; border-radius: 6px; background: #f8fafc; font-size: 14px;">
            </div>

            <div class="input-group" style="margin-bottom: 18px;">
                <label style="display: block; font-size: 13px; font-weight: 600; color: #1e293b; margin-bottom: 6px;">Matrix Number:</label>
                <input type="text" name="matric_no" placeholder="e.g. MAHSA01" required style="width: 100%; padding: 11px 14px; border: 1px solid #cbd5e1; border-radius: 6px; background: #f8fafc; font-size: 14px;">
            </div>

            <div class="input-group" style="margin-bottom: 18px;">
                <label style="display: block; font-size: 13px; font-weight: 600; color: #1e293b; margin-bottom: 6px;">Subject Name:</label>
                <input type="text" name="subject_name" placeholder="e.g. Pengaturcaraan Web" required style="width: 100%; padding: 11px 14px; border: 1px solid #cbd5e1; border-radius: 6px; background: #f8fafc; font-size: 14px;">
            </div>

            <div class="input-group" style="margin-bottom: 18px;">
                <label style="display: block; font-size: 13px; font-weight: 600; color: #1e293b; margin-bottom: 6px;">Subject Code:</label>
                <input type="text" name="subject_code" placeholder="e.g. WEB2101" required style="width: 100%; padding: 11px 14px; border: 1px solid #cbd5e1; border-radius: 6px; background: #f8fafc; font-size: 14px;">
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px;">
                <div class="input-group" style="margin-bottom: 18px;">
                    <label style="display: block; font-size: 13px; font-weight: 600; color: #1e293b; margin-bottom: 6px;">Test 1 (Max 20):</label>
                    <input type="number" step="0.01" name="test1" placeholder="0.00" required style="width: 100%; padding: 11px 14px; border: 1px solid #cbd5e1; border-radius: 6px; background: #f8fafc; font-size: 14px;">
                </div>

                <div class="input-group" style="margin-bottom: 18px;">
                    <label style="display: block; font-size: 13px; font-weight: 600; color: #1e293b; margin-bottom: 6px;">Test 2 (Max 30):</label>
                    <input type="number" step="0.01" name="test2" placeholder="0.00" required style="width: 100%; padding: 11px 14px; border: 1px solid #cbd5e1; border-radius: 6px; background: #f8fafc; font-size: 14px;">
                </div>

                <div class="input-group" style="margin-bottom: 18px;">
                    <label style="display: block; font-size: 13px; font-weight: 600; color: #1e293b; margin-bottom: 6px;">Final (Max 50):</label>
                    <input type="number" step="0.01" name="final_exam" placeholder="0.00" required style="width: 100%; padding: 11px 14px; border: 1px solid #cbd5e1; border-radius: 6px; background: #f8fafc; font-size: 14px;">
                </div>
            </div>

            <input type="submit" name="save" value="Save Result" style="width: 100%; background: #002855; color: white; padding: 12px; border: none; border-radius: 6px; cursor: pointer; font-size: 15px; font-weight: 600; margin-top: 10px; transition: background 0.2s;">
        </form>
    </div>

</body>
</html>