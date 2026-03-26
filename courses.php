<?php
require_once '../config/db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $search = $_GET['search'] ?? '';
    $category = $_GET['category'] ?? '';
    $course_id = $_GET['id'] ?? null;
    
    if ($course_id) {
        $stmt = $pdo->prepare("SELECT * FROM courses WHERE id = ?");
        $stmt->execute([$course_id]);
        echo json_encode($stmt->fetch());
        exit;
    }
    
    $sql = "SELECT * FROM courses WHERE 1=1";
    $params = [];
    
    if ($search) {
        $sql .= " AND (title LIKE ? OR description LIKE ?)";
        $params[] = "%$search%";
        $params[] = "%$search%";
    }
    
    if ($category && $category !== 'All') {
        $sql .= " AND category = ?";
        $params[] = $category;
    }
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $courses = $stmt->fetchAll();
    
    // Add default YouTube videos if not set
    foreach ($courses as &$course) {
        if (empty($course['youtube_url'])) {
            $course['youtube_url'] = 'https://www.youtube.com/embed/6v2L2UGZJAM'; // Default course preview video
        }
    }
    
    echo json_encode($courses);
}
?>