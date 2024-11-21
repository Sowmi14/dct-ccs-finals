<?php

// Database connection functions
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

// Debugging helper function
function debugLog($message) {
    error_log("[DEBUG] " . $message);
}

// Login function
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

// Check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['email']);
}

// Add a new subject
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

// Fetch all subjects
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

// Delete a subject
function deleteSubject($subject_code) {
    $conn = openCon();

    // Prepare and execute delete query
    $stmt = $conn->prepare("DELETE FROM subjects WHERE subject_code = ?");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("s", $subject_code);
    $result = $stmt->execute();

    if (!$result) {
        error_log("Error deleting subject: " . $stmt->error);
    }

    $stmt->close();
    closeCon($conn);

    return $result;
}

// Fetch a single subject by subject code
function getSubjectByCode($subject_code) {
    $conn = openCon();

    $query = "SELECT * FROM subjects WHERE subject_code = ?";
    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("s", $subject_code);
    $stmt->execute();
    $result = $stmt->get_result();
    $subject = $result->fetch_assoc();

    $stmt->close();
    closeCon($conn);

    return $subject;
}

// Update a subject
function getSubjectById($id) {
    $conn = openCon();
    $sql = "SELECT * FROM subjects WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $subject = null;
    if ($result->num_rows > 0) {
        $subject = $result->fetch_assoc();
    }

    $stmt->close();
    closeCon($conn);
    return $subject;
}

function updateSubjectName($id, $subjectName) {
    $conn = openCon();
    $sql = "UPDATE subjects SET subject_name = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $subjectName, $id);
    
    if ($stmt->execute()) {
        debugLog("Subject with ID $id updated successfully to $subjectName.");
        $stmt->close();
        closeCon($conn);
        return true;
    } else {
        debugLog("Error updating subject with ID $id: " . $stmt->error);
    }

    $stmt->close();
    closeCon($conn);
    return false;
}   

?>
