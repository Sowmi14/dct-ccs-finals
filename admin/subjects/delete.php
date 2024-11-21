<?php
ob_start(); // Start output buffering
include('../partials/header.php'); 
include('../partials/side-bar.php'); 
include('../../functions.php');

// Validate `subject_code` and `subject_name` passed via GET
$subject_code = isset($_GET['subject_code']) ? htmlspecialchars($_GET['subject_code']) : null;
$subject_name = isset($_GET['subject_name']) ? htmlspecialchars($_GET['subject_name']) : null;

// Handle deletion when the delete button is clicked
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_subject'])) {
    $subject_code = $_POST['subject_code'];

    if (deleteSubject($subject_code)) {
        header('Location: add.php?message=Subject+deleted+successfully');
        exit;
    } else {
        header('Location: add.php?error=Failed+to+delete+subject');
        exit;
    }
}

ob_end_flush(); // End output buffering
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Subject</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .breadcrumb {
            margin-bottom: 20px;
        }
        .breadcrumb a {
            color: #007bff;
            text-decoration: none;
            margin-right: 5px;
        }
        .breadcrumb a:hover {
            text-decoration: underline;
        }
        .breadcrumb span {
            margin-right: 5px;
        }
        .confirmation-box {
            border: 1px solid #e0e0e0;
            padding: 20px;
            border-radius: 5px;
        }
        .confirmation-box p {
            font-size: 16px;
            margin-bottom: 20px;
        }
        .confirmation-box ul {
            list-style-type: none;
            padding: 0;
        }
        .confirmation-box ul li {
            margin-bottom: 10px;
        }
        .confirmation-box ul li strong {
            font-weight: bold;
        }
        .buttons {
            display: flex;
            justify-content: flex-start;
        }
        .buttons button, .buttons a {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 10px;
            text-decoration: none;
            text-align: center;
        }
        .cancel-btn {
            background-color: #6c757d;
            color: #fff;
        }
        .delete-btn {
            background-color: #007bff;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Delete Subject</h1>
        <div class="breadcrumb">
            <a href="#">Dashboard</a> / 
            <a href="#">Add Subject</a> / 
            <span>Delete Subject</span>
        </div>
        <div class="confirmation-box">
            <?php if ($subject_code && $subject_name): ?>
                <p>Are you sure you want to delete the following subject record?</p>
                <ul>
                    <li><strong>Subject Code:</strong> <?php echo $subject_code; ?></li>
                    <li><strong>Subject Name:</strong> <?php echo $subject_name; ?></li>
                </ul>
                <form method="POST" action="">
                    <input type="hidden" name="subject_code" value="<?php echo $subject_code; ?>">
                    <div class="buttons">
                        <a href="add.php" class="cancel-btn">Cancel</a>
                        <button type="submit" name="delete_subject" class="delete-btn">Delete Subject Record</button>
                    </div>
                </form>
            <?php else: ?>
                <p>Error: Subject details are missing. Please go back and try again.</p>
                <a href="add.php" class="cancel-btn">Return to Add Subject</a>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
