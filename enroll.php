<?php
require_once '../config/db.php';
requireLogin();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $course_id = isset($data['course_id']) ? (int)$data['course_id'] : 0;
    $user_id = $_SESSION['user_id'];
    
    if ($course_id <= 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid course ID']);
        exit;
    }
    
    try {
        // Check if already enrolled
        $check = $pdo->prepare("SELECT * FROM enrollments WHERE user_id = ? AND course_id = ?");
        $check->execute([$user_id, $course_id]);
        
        if ($check->rowCount() > 0) {
            echo json_encode(['success' => false, 'message' => 'You are already enrolled in this course!']);
            exit;
        }
        
        $stmt = $pdo->prepare("INSERT INTO enrollments (user_id, course_id) VALUES (?, ?)");
        $stmt->execute([$user_id, $course_id]);
        
        // Get course title for response
        $stmt = $pdo->prepare("SELECT title FROM courses WHERE id = ?");
        $stmt->execute([$course_id]);
        $course = $stmt->fetch();
        
        echo json_encode(['success' => true, 'message' => '✓ Successfully enrolled in ' . $course['title'] . '!']);
        
    } catch(PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Database error: Unable to enroll']);
    }
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!isset($_SESSION['user_id'])) {
        echo json_encode([]);
        exit;
    }
    
    $stmt = $pdo->prepare("SELECT course_id FROM enrollments WHERE user_id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $enrolled = $stmt->fetchAll(PDO::FETCH_COLUMN);
    echo json_encode($enrolled);
    exit;
}
?>