<?php
require_once 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    
    if ($action === 'register') {
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        
        try {
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$username, $email, $password]);
            echo json_encode(['success' => true, 'message' => 'Registration successful! Please login.']);
        } catch(PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Username or email already exists']);
        }
    } 
    elseif ($action === 'login') {
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            echo json_encode(['success' => true, 'message' => 'Login successful', 'username' => $user['username']]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid credentials']);
        }
    }
    elseif ($action === 'logout') {
        session_destroy();
        echo json_encode(['success' => true]);
    }
}
?>