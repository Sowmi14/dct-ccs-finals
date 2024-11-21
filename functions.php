<?php
session_start();

function openCon() {
    $conn = new mysqli("localhost", "root", "", "dct-ccs-finals");

    // Check for connection errors
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

function closeCon($conn) {
    $conn->close();
}

function debugLog($message) {
    error_log("[DEBUG] " . $message);
}

function loginUser($username, $password) {
    $conn = openCon();

    // Query to fetch user data by email
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }
    
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify password using password_verify() with the hash stored in the database
        if (password_verify($password, $user['password'])) {
            // Set session variables for logged-in user
            $_SESSION['email'] = $user['email'];
            $_SESSION['user_id'] = $user['id'];

            $stmt->close();
            closeCon($conn);
            return true;
        }
    }

    $stmt->close();
    closeCon($conn);
    return false;
}

function isLoggedIn() {
    return isset($_SESSION['email']);
}

function addSubject($subject_code, $subject_name) {
    $conn = openCon();
    
    // Prepare statement to insert new subject
    $stmt = $conn->prepare("INSERT INTO subjects (subject_code, subject_name) VALUES (?, ?)");
    
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("ss", $subject_code, $subject_name);

    // Check if execution is successful
    if (!$stmt->execute()) {
        die("Error executing query: " . $stmt->error);
    }

    $stmt->close();
    closeCon($conn);
}

// Fetch all subjects from the database to display in the table
function getSubjects() {
    $conn = openCon();
    
    $sql = "SELECT * FROM subjects";
    $result = $conn->query($sql);
    
    if ($result === false) {
        die("Error fetching subjects: " . $conn->error);
    }
    
    $subjects = [];
    while ($row = $result->fetch_assoc()) {
        $subjects[] = $row;
    }

    closeCon($conn);
    return $subjects;
}
?>
