<?php
require_once '../config/db.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $course_id = isset($_GET['course_id']) ? (int)$_GET['course_id'] : 0;
    
    $stmt = $pdo->prepare("
        SELECT r.*, u.username 
        FROM reviews r 
        JOIN users u ON r.user_id = u.id 
        WHERE r.course_id = ? 
        ORDER BY r.created_at DESC
    ");
    $stmt->execute([$course_id]);
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $stmt = $pdo->prepare("
        SELECT 
            COALESCE(AVG(rating), 0) as avg_rating,
            COUNT(*) as total_reviews,
            SUM(CASE WHEN rating = 5 THEN 1 ELSE 0 END) as five_star,
            SUM(CASE WHEN rating = 4 THEN 1 ELSE 0 END) as four_star,
            SUM(CASE WHEN rating = 3 THEN 1 ELSE 0 END) as three_star,
            SUM(CASE WHEN rating = 2 THEN 1 ELSE 0 END) as two_star,
            SUM(CASE WHEN rating = 1 THEN 1 ELSE 0 END) as one_star
        FROM reviews 
        WHERE course_id = ?
    ");
    $stmt->execute([$course_id]);
    $stats = $stmt->fetch(PDO::FETCH_ASSOC);
    
    echo json_encode(['success' => true, 'reviews' => $reviews, 'stats' => $stats]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['success' => false, 'message' => 'Please login']);
        exit;
    }
    
    $data = json_decode(file_get_contents('php://input'), true);
    $course_id = (int)$data['course_id'];
    $rating = (int)$data['rating'];
    $review = trim($data['review']);
    $user_id = $_SESSION['user_id'];
    
    $stmt = $pdo->prepare("SELECT * FROM enrollments WHERE user_id = ? AND course_id = ?");
    $stmt->execute([$user_id, $course_id]);
    if ($stmt->rowCount() == 0) {
        echo json_encode(['success' => false, 'message' => 'You can only review courses you are enrolled in']);
        exit;
    }
    
    $stmt = $pdo->prepare("INSERT INTO reviews (course_id, user_id, rating, review) VALUES (?, ?, ?, ?) ON DUPLICATE KEY UPDATE rating = ?, review = ?");
    $stmt->execute([$course_id, $user_id, $rating, $review, $rating, $review]);
    
    $stmt = $pdo->prepare("UPDATE courses SET avg_rating = (SELECT AVG(rating) FROM reviews WHERE course_id = ?), total_reviews = (SELECT COUNT(*) FROM reviews WHERE course_id = ?) WHERE id = ?");
    $stmt->execute([$course_id, $course_id, $course_id]);
    
    echo json_encode(['success' => true, 'message' => 'Review submitted!']);
    exit;
}
?>