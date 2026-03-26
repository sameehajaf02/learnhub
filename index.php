<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learn Hub - Online Learning Platform</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }
        
        body {
            background: #f0f9ff;
            color: #1e293b;
        }
        
        .navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            padding: 1rem 2rem;
            position: sticky;
            top: 0;
            z-index: 100;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }
        
        .logo {
            font-size: 1.8rem;
            font-weight: 800;
            background: linear-gradient(135deg, #0284c7, #0ea5e9);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        
        .nav-links {
            display: flex;
            gap: 1.5rem;
            flex-wrap: wrap;
        }
        
        .nav-links a {
            text-decoration: none;
            color: #475569;
            font-weight: 500;
            cursor: pointer;
            transition: 0.2s;
            padding: 0.5rem;
        }
        
        .nav-links a:hover, .nav-links a.active {
            color: #0ea5e9;
            border-bottom: 2px solid #0ea5e9;
        }
        
        .user-area {
            display: flex;
            gap: 1rem;
            align-items: center;
        }
        
        .btn {
            padding: 0.5rem 1.2rem;
            border-radius: 40px;
            border: none;
            cursor: pointer;
            font-weight: 500;
            transition: 0.2s;
        }
        
        .btn-primary {
            background: #0ea5e9;
            color: white;
        }
        
        .btn-primary:hover {
            background: #0284c7;
            transform: translateY(-2px);
        }
        
        .btn-outline {
            background: transparent;
            border: 1px solid #0ea5e9;
            color: #0ea5e9;
        }
        
        .btn-outline:hover {
            background: #0ea5e9;
            color: white;
        }
        
        .user-greeting {
            background: #e0f2fe;
            padding: 0.5rem 1rem;
            border-radius: 40px;
            font-weight: 500;
            color: #0284c7;
        }
        
        .container {
            max-width: 1300px;
            margin: 2rem auto;
            padding: 0 1.5rem;
        }
        
        .page {
            display: none;
            animation: fadeIn 0.3s ease;
        }
        
        .active-page {
            display: block;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .hero {
            text-align: center;
            padding: 3rem;
            background: linear-gradient(135deg, #e0f2fe, #ffffff);
            border-radius: 30px;
            margin-bottom: 2rem;
        }
        
        .hero h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: #0284c7;
        }
        
        .search-filter {
            background: white;
            padding: 1rem 1.5rem;
            border-radius: 60px;
            margin-bottom: 2rem;
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        
        .search-box {
            flex: 2;
            display: flex;
            align-items: center;
            background: #f1f5f9;
            border-radius: 40px;
            padding: 0.5rem 1rem;
        }
        
        .search-box input {
            border: none;
            background: none;
            outline: none;
            width: 100%;
            font-size: 1rem;
            margin-left: 0.5rem;
        }
        
        .filter-chips {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }
        
        .chip {
            padding: 0.4rem 1rem;
            border-radius: 30px;
            background: #f1f5f9;
            cursor: pointer;
            font-size: 0.85rem;
            transition: 0.2s;
        }
        
        .chip.active, .chip:hover {
            background: #0ea5e9;
            color: white;
        }
        
        .courses-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 1.8rem;
        }
        
        .course-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            transition: 0.3s;
            cursor: pointer;
        }
        
        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.12);
        }
        
        .course-img {
            height: 140px;
            background: linear-gradient(135deg, #0ea5e9, #0284c7);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: white;
        }
        
        .course-info {
            padding: 1.2rem;
        }
        
        .course-title {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .course-category {
            display: inline-block;
            background: #e0f2fe;
            color: #0284c7;
            padding: 0.2rem 0.8rem;
            border-radius: 20px;
            font-size: 0.75rem;
            margin: 0.5rem 0;
        }
        
        .course-desc {
            color: #64748b;
            font-size: 0.85rem;
            margin: 0.5rem 0;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .course-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1rem;
        }
        
        .enroll-btn {
            background: #0ea5e9;
            color: white;
            border: none;
            padding: 0.4rem 1rem;
            border-radius: 30px;
            cursor: pointer;
            font-weight: 500;
            transition: 0.2s;
        }
        
        .enroll-btn:hover:not(:disabled) {
            background: #0284c7;
            transform: translateY(-2px);
        }
        
        .enroll-btn:disabled {
            background: #94a3b8;
            cursor: not-allowed;
        }
        
        .course-rating {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 8px 0;
        }
        
        .rating-value {
            font-weight: 600;
            color: #f59e0b;
        }
        
        .stars {
            display: inline-flex;
            gap: 2px;
        }
        
        .rating-stars {
            display: inline-flex;
            gap: 8px;
            cursor: pointer;
            margin: 10px 0;
        }
        
        .star {
            font-size: 24px;
            color: #cbd5e1;
            transition: color 0.2s;
            cursor: pointer;
        }
        
        .star.active, .star:hover {
            color: #fbbf24;
        }
        
        .review-card {
            background: #f8fafc;
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1rem;
            border: 1px solid #e2e8f0;
        }
        
        .review-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
        }
        
        .reviewer-name {
            font-weight: 600;
            color: #0f172a;
        }
        
        .review-date {
            font-size: 0.75rem;
            color: #64748b;
        }
        
        .review-text {
            color: #475569;
            margin-top: 0.5rem;
            line-height: 1.5;
        }
        
        .review-textarea {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #cbd5e1;
            border-radius: 12px;
            min-height: 100px;
            resize: vertical;
            font-family: inherit;
        }
        
        .rating-distribution {
            margin: 1rem 0;
        }
        
        .rating-bar {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 8px;
        }
        
        .rating-bar-label {
            width: 45px;
            font-size: 0.85rem;
        }
        
        .rating-bar-progress {
            flex: 1;
            height: 8px;
            background: #e2e8f0;
            border-radius: 4px;
            overflow: hidden;
        }
        
        .rating-bar-fill {
            height: 100%;
            background: #fbbf24;
            border-radius: 4px;
        }
        
        .rating-bar-count {
            width: 40px;
            font-size: 0.85rem;
            color: #64748b;
        }
        
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.6);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }
        
        .modal-content {
            background: white;
            border-radius: 24px;
            max-width: 800px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            padding: 2rem;
        }
        
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            border-bottom: 2px solid #e0f2fe;
            padding-bottom: 1rem;
        }
        
        .modal-header h3 {
            color: #0284c7;
        }
        
        .close-modal {
            font-size: 1.8rem;
            cursor: pointer;
            color: #64748b;
            transition: 0.2s;
        }
        
        .close-modal:hover {
            color: #0284c7;
        }
        
        /* YouTube Video Container */
        .video-container {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 Aspect Ratio */
            height: 0;
            overflow: hidden;
            margin-bottom: 1.5rem;
            border-radius: 12px;
        }
        
        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 12px;
        }
        
        .watch-video-btn {
            background: #ff0000;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 30px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: 0.2s;
        }
        
        .watch-video-btn:hover {
            background: #cc0000;
            transform: scale(1.05);
        }
        
        .popup-message {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            background: white;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            z-index: 1100;
            animation: slideIn 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .popup-message.success {
            border-left: 4px solid #10b981;
            background: #f0fdf4;
        }
        
        .popup-message.error {
            border-left: 4px solid #ef4444;
            background: #fef2f2;
        }
        
        .popup-message.info {
            border-left: 4px solid #0ea5e9;
            background: #e0f2fe;
        }
        
        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        .faq-item {
            background: white;
            margin-bottom: 1rem;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }
        
        .faq-question {
            padding: 1.2rem;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            background: white;
        }
        
        .faq-question:hover {
            background: #e0f2fe;
        }
        
        .faq-answer {
            padding: 0 1.2rem;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
            background: #fafcff;
            color: #475569;
        }
        
        .faq-item.active .faq-answer {
            padding: 1.2rem;
            max-height: 200px;
            border-top: 1px solid #e0f2fe;
        }
        
        .form-group {
            margin-bottom: 1rem;
        }
        
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #cbd5e1;
            border-radius: 12px;
        }
        
        .message {
            padding: 0.8rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            display: none;
        }
        
        .stats-card {
            background: linear-gradient(135deg, #0ea5e9, #0284c7);
            color: white;
            padding: 1.5rem;
            border-radius: 20px;
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .stats-card h3 {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }
        
        .info-box {
            background: #f1f5f9;
            padding: 1rem;
            border-radius: 12px;
            margin: 1rem 0;
        }
        
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="logo">📚 Learn Hub</div>
        <div class="nav-links">
            <a onclick="showPage('home')" class="active" data-page="home">Home</a>
            <a onclick="showPage('courses')" data-page="courses">Courses</a>
            <a onclick="showPage('mycourses')" data-page="mycourses">My Courses</a>
            <a onclick="showPage('instructors')" data-page="instructors">Instructors</a>
            <a onclick="showPage('faq')" data-page="faq">FAQ</a>
            <a onclick="showPage('contact')" data-page="contact">Contact</a>
        </div>
        <div class="user-area" id="userArea">
            <?php if(isset($_SESSION['username'])): ?>
                <span class="user-greeting">👋 Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                <button class="btn btn-outline" onclick="logout()">Logout</button>
            <?php else: ?>
                <button class="btn btn-outline" onclick="showAuthModal('login')">Login</button>
                <button class="btn btn-primary" onclick="showAuthModal('register')">Sign Up</button>
            <?php endif; ?>
        </div>
    </div>
    
    <div class="container">
        <div id="home" class="page active-page">
            <div class="hero">
                <h1>📚 Welcome to Learn Hub</h1>
                <p>Your journey to knowledge starts here. Access 80+ expert-led courses and advance your career</p>
                <button class="btn btn-primary" onclick="showPage('courses')">Explore Courses →</button>
            </div>
            <h2 style="margin-bottom: 1rem; color: #0284c7;">🌟 Featured Courses</h2>
            <div class="courses-grid" id="featuredCourses"></div>
        </div>
        
        <div id="courses" class="page">
            <div class="search-filter">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Search courses..." onkeyup="filterCourses()">
                </div>
                <div class="filter-chips" id="categoryFilters"></div>
            </div>
            <div id="coursesGrid" class="courses-grid"></div>
        </div>
        
        <div id="mycourses" class="page">
            <div class="stats-card">
                <h3 id="enrolledCount">0</h3>
                <p>Courses Enrolled</p>
            </div>
            <h2 style="margin-bottom: 1rem; color: #0284c7;">📖 My Enrolled Courses</h2>
            <div id="myCoursesGrid" class="courses-grid"></div>
        </div>
        
        <div id="instructors" class="page">
            <h2 style="margin-bottom: 2rem; color: #0284c7;">👨‍🏫 Meet Our Expert Instructors</h2>
            <div class="courses-grid" id="instructorsGrid"></div>
        </div>
        
        <div id="faq" class="page">
            <h2 style="margin-bottom: 2rem; color: #0284c7;">❓ Frequently Asked Questions</h2>
            <div id="faqAccordion"></div>
        </div>
        
        <div id="contact" class="page">
            <div style="max-width: 600px; margin: 0 auto; background: white; padding: 2rem; border-radius: 20px;">
                <h2 style="color: #0284c7;">📧 Contact Us</h2>
                <form id="contactForm">
                    <div class="form-group">
                        <input type="text" placeholder="Your Name" required>
                    </div>
                    <div class="form-group">
                        <input type="email" placeholder="Your Email" required>
                    </div>
                    <div class="form-group">
                        <textarea rows="4" placeholder="Your Message" required style="width:100%; padding:0.8rem;"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width:100%">Send Message</button>
                </form>
            </div>
        </div>
    </div>
    
    <div id="authModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="authModalTitle">Login</h3>
                <span class="close-modal" onclick="closeAuthModal()">&times;</span>
            </div>
            <div id="authMessage" class="message"></div>
            <form id="authForm">
                <div class="form-group">
                    <input type="text" id="authUsername" placeholder="Username" style="display:none;">
                </div>
                <div class="form-group">
                    <input type="email" id="authEmail" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <input type="password" id="authPassword" placeholder="Password" required>
                </div>
                <button type="submit" class="btn btn-primary" style="width:100%">Submit</button>
            </form>
        </div>
    </div>
    
    <div id="previewModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="previewTitle"></h3>
                <span class="close-modal" onclick="closePreviewModal()">&times;</span>
            </div>
            <div id="previewContent"></div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let allCourses = [];
        let enrolledCourses = [];
        let currentUser = <?php echo isset($_SESSION['username']) ? json_encode($_SESSION['username']) : 'null'; ?>;
        
        function showPopup(message, type) {
            const popup = $(`<div class="popup-message ${type}"><i class="fas fa-${type === 'success' ? 'check-circle' : (type === 'error' ? 'exclamation-circle' : 'info-circle')}"></i><span>${message}</span></div>`);
            $('body').append(popup);
            setTimeout(() => popup.fadeOut(300, function() { $(this).remove(); }), 3000);
        }
        
        function loadCourses() {
            $.get('api/courses.php', function(courses) {
                allCourses = courses;
                filterCourses();
                loadFeaturedCourses();
                loadInstructors();
                if (currentUser) loadEnrolledCourses();
                loadCategories();
            }).fail(() => showPopup('Error loading courses', 'error'));
        }
        
        function loadFeaturedCourses() {
            $('#featuredCourses').html(allCourses.slice(0, 3).map(c => renderCourseCard(c)).join(''));
        }
        
        function renderCourseCard(course) {
            const isEnrolled = enrolledCourses.includes(course.id);
            const avgRating = parseFloat(course.avg_rating || 0).toFixed(1);
            let starsHtml = '';
            for (let i = 1; i <= 5; i++) {
                starsHtml += i <= Math.floor(avgRating) ? '<i class="fas fa-star" style="color: #fbbf24;"></i>' : '<i class="far fa-star" style="color: #cbd5e1;"></i>';
            }
            return `<div class="course-card" onclick="previewCourse(${course.id})">
                <div class="course-img">${course.image_icon || '📚'}</div>
                <div class="course-info">
                    <div class="course-title">${escapeHtml(course.title)}</div>
                    <div class="course-rating"><div class="stars">${starsHtml}</div><span class="rating-value">${avgRating}</span><span style="font-size:0.75rem;">(${course.total_reviews || 0})</span></div>
                    <span class="course-category">${escapeHtml(course.category)}</span>
                    <div class="course-desc">${escapeHtml(course.description.substring(0, 80))}...</div>
                    <div class="course-footer">
                        <span>👨‍🏫 ${escapeHtml(course.instructor)}</span>
                        <button class="enroll-btn" onclick="event.stopPropagation(); enrollCourse(${course.id})" ${isEnrolled ? 'disabled' : ''}>${isEnrolled ? '✓ Enrolled' : 'Enroll Now'}</button>
                    </div>
                </div>
            </div>`;
        }
        
        function renderMyCourseCard(course) {
            const avgRating = parseFloat(course.avg_rating || 0).toFixed(1);
            let starsHtml = '';
            for (let i = 1; i <= 5; i++) starsHtml += i <= Math.floor(avgRating) ? '<i class="fas fa-star" style="color: #fbbf24;"></i>' : '<i class="far fa-star" style="color: #cbd5e1;"></i>';
            return `<div class="course-card" onclick="previewCourse(${course.id})">
                <div class="course-img">${course.image_icon || '📚'}</div>
                <div class="course-info">
                    <div class="course-title">${escapeHtml(course.title)}</div>
                    <div class="course-rating"><div class="stars">${starsHtml}</div><span class="rating-value">${avgRating}</span></div>
                    <span class="course-category">${escapeHtml(course.category)}</span>
                    <div class="course-desc">${escapeHtml(course.description.substring(0, 80))}...</div>
                    <div class="course-footer"><span>👨‍🏫 ${escapeHtml(course.instructor)}</span><span style="color:#10b981;"><i class="fas fa-check-circle"></i> Enrolled</span></div>
                </div>
            </div>`;
        }
        
        function escapeHtml(text) {
            if(!text) return '';
            return text.replace(/[&<>]/g, function(m) {
                if(m === '&') return '&amp;';
                if(m === '<') return '&lt;';
                if(m === '>') return '&gt;';
                return m;
            });
        }
        
        function filterCourses() {
            const search = $('#searchInput').val().toLowerCase();
            const category = $('.chip.active').data('category') || 'All';
            let filtered = allCourses;
            if (search) filtered = filtered.filter(c => c.title.toLowerCase().includes(search) || c.description.toLowerCase().includes(search));
            if (category !== 'All') filtered = filtered.filter(c => c.category === category);
            $('#coursesGrid').html(filtered.map(c => renderCourseCard(c)).join(''));
        }
        
        function enrollCourse(courseId) {
            if (!currentUser) { showPopup('Please login first!', 'info'); showAuthModal('login'); return; }
            $.ajax({ url: 'api/enroll.php', method: 'POST', contentType: 'application/json', data: JSON.stringify({ course_id: courseId }), success: function(res) {
                showPopup(res.message, res.success ? 'success' : 'error');
                if (res.success) loadEnrolledCourses();
            }});
        }
        
        function loadEnrolledCourses() {
            $.get('api/enroll.php', function(enrolled) { 
                enrolledCourses = enrolled;
                filterCourses();
                loadFeaturedCourses();
                loadMyCourses();
                $('#enrolledCount').text(enrolledCourses.length);
            });
        }
        
        function loadMyCourses() {
            const myCourses = allCourses.filter(c => enrolledCourses.includes(c.id));
            $('#myCoursesGrid').html(myCourses.length ? myCourses.map(c => renderMyCourseCard(c)).join('') : '<div style="text-align:center;padding:3rem;background:white;border-radius:20px;"><i class="fas fa-book-open" style="font-size:3rem;color:#94a3b8;"></i><p style="margin-top:1rem;">No courses enrolled. <a onclick="showPage(\'courses\')" style="color:#0ea5e9;cursor:pointer;">Browse courses →</a></p></div>');
        }
        
        function loadCourseReviews(courseId) {
            $.get(`api/reviews.php?course_id=${courseId}`, function(data) {
                if (data.success) {
                    let html = `<div class="rating-distribution"><h4>Rating Distribution</h4>`;
                    ['five', 'four', 'three', 'two', 'one'].forEach((star, i) => {
                        let percent = data.stats.total_reviews > 0 ? (data.stats[`${star}_star`] / data.stats.total_reviews * 100) : 0;
                        html += `<div class="rating-bar"><div class="rating-bar-label">${5-i} ★</div><div class="rating-bar-progress"><div class="rating-bar-fill" style="width: ${percent}%"></div></div><div class="rating-bar-count">${data.stats[`${star}_star`] || 0}</div></div>`;
                    });
                    html += `</div>`;
                    if (data.reviews.length === 0) {
                        html += '<p style="color:#64748b;">No reviews yet. Be the first to review!</p>';
                    } else {
                        data.reviews.forEach(r => {
                            let stars = '★'.repeat(r.rating) + '☆'.repeat(5 - r.rating);
                            html += `<div class="review-card"><div class="review-header"><div><span class="reviewer-name">${escapeHtml(r.username)}</span><div style="color:#fbbf24;margin-top:5px;">${stars}</div></div><span class="review-date">${new Date(r.created_at).toLocaleDateString()}</span></div><div class="review-text">${escapeHtml(r.review)}</div></div>`;
                        });
                    }
                    $('#reviewsList').html(html);
                }
            });
        }
        
        function submitReview(courseId) {
            const rating = $('.star.fas').length;
            const review = $('#reviewText').val();
            if (rating === 0) { showPopup('Please select a rating', 'error'); return; }
            if (!review.trim()) { showPopup('Please write a review', 'error'); return; }
            $.ajax({ url: 'api/reviews.php', method: 'POST', contentType: 'application/json', data: JSON.stringify({ course_id: courseId, rating, review }), success: function(res) {
                if (res.success) { showPopup(res.message, 'success'); $('#reviewText').val(''); $('.star').removeClass('fas').addClass('far'); loadCourseReviews(courseId); loadCourses(); }
                else showPopup(res.message, 'error');
            }});
        }
        
        function previewCourse(courseId) {
            const course = allCourses.find(c => c.id == courseId);
            if(!course) return;
            const isEnrolled = enrolledCourses.includes(course.id);
            
            // Load reviews
            setTimeout(() => loadCourseReviews(courseId), 100);
            
            const avgRating = parseFloat(course.avg_rating || 0).toFixed(1);
            let starsHtml = '';
            for (let i = 1; i <= 5; i++) {
                starsHtml += i <= Math.floor(avgRating) ? '<i class="fas fa-star" style="color: #fbbf24;"></i>' : '<i class="far fa-star" style="color: #cbd5e1;"></i>';
            }
            
            let levelColor = '';
            if(course.level === 'Beginner') levelColor = '#10b981';
            else if(course.level === 'Intermediate') levelColor = '#f59e0b';
            else levelColor = '#ef4444';
            
            // Get YouTube embed URL (convert watch?v= to embed/)
            let youtubeEmbed = course.youtube_url || 'https://www.youtube.com/embed/6v2L2UGZJAM';
            if (youtubeEmbed.includes('watch?v=')) {
                youtubeEmbed = youtubeEmbed.replace('watch?v=', 'embed/');
            }
            if (youtubeEmbed.includes('youtu.be/')) {
                let videoId = youtubeEmbed.split('youtu.be/')[1].split('?')[0];
                youtubeEmbed = `https://www.youtube.com/embed/${videoId}`;
            }
            
            $('#previewTitle').text(course.title);
            $('#previewContent').html(`
                <!-- YouTube Video -->
                <div class="video-container">
                    <iframe src="${youtubeEmbed}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                
                <!-- Course Header -->
                <div style="text-align:center; margin-bottom:1rem;">
                    <div class="course-rating" style="justify-content:center;">
                        <div class="stars">${starsHtml}</div>
                        <span class="rating-value">${avgRating}</span>
                        <span style="font-size:0.85rem;">(${course.total_reviews || 0} ratings)</span>
                    </div>
                </div>
                
                <!-- Course Details -->
                <div class="info-box">
                    <p><strong><i class="fas fa-user"></i> Instructor:</strong> ${escapeHtml(course.instructor)}</p>
                    <p><strong><i class="fas fa-clock"></i> Duration:</strong> ${escapeHtml(course.duration)}</p>
                    <p><strong><i class="fas fa-chart-line"></i> Level:</strong> <span style="background:${levelColor}; color:white; padding:2px 10px; border-radius:20px; font-size:0.75rem;">${escapeHtml(course.level)}</span></p>
                    <p><strong><i class="fas fa-tag"></i> Category:</strong> ${escapeHtml(course.category)}</p>
                    <p><strong><i class="fas fa-dollar-sign"></i> Price:</strong> ${course.price > 0 ? '$' + course.price : 'Free'}</p>
                </div>
                
                <!-- Course Description -->
                <h4 style="margin: 1rem 0 0.5rem 0;"><i class="fas fa-align-left"></i> Course Description</h4>
                <p style="line-height: 1.6; color:#475569;">${escapeHtml(course.description)}</p>
                
                <!-- What You'll Learn -->
                <h4 style="margin: 1rem 0 0.5rem 0;"><i class="fas fa-graduation-cap"></i> What You'll Learn</h4>
                <ul style="margin-left: 1.5rem; color:#475569; line-height:1.6;">
                    <li>Master ${escapeHtml(course.title)} from basics to advanced</li>
                    <li>Hands-on projects and real-world applications</li>
                    <li>Expert tips and best practices from industry professionals</li>
                    <li>Lifetime access to all course materials and updates</li>
                    <li>Certificate of completion upon finishing the course</li>
                </ul>
                
                <!-- Course Includes -->
                <h4 style="margin: 1rem 0 0.5rem 0;"><i class="fas fa-box"></i> This Course Includes</h4>
                <ul style="margin-left: 1.5rem; color:#475569; line-height:1.6;">
                    <li><i class="fas fa-video"></i> ${course.duration} of video content</li>
                    <li><i class="fas fa-download"></i> Downloadable resources and materials</li>
                    <li><i class="fas fa-mobile-alt"></i> Access on mobile and TV</li>
                    <li><i class="fas fa-certificate"></i> Certificate of completion</li>
                    <li><i class="fas fa-comments"></i> Discussion forum for Q&A</li>
                </ul>
                
                <hr style="margin: 1.5rem 0;">
                
                <!-- Rating Section -->
                ${isEnrolled ? `
                    <div style="background: #e0f2fe; padding: 1.2rem; border-radius: 16px; margin: 1rem 0;">
                        <h4 style="margin-bottom: 0.5rem;"><i class="fas fa-star"></i> Rate this Course</h4>
                        <p style="font-size:0.85rem; margin-bottom:0.5rem;">Share your experience to help other students</p>
                        <div class="rating-stars" id="ratingInput"></div>
                        <textarea id="reviewText" class="review-textarea" placeholder="Write your review... What did you like? What could be improved?"></textarea>
                        <button class="btn btn-primary" style="margin-top: 0.5rem;" onclick="submitReview(${course.id})">Submit Review</button>
                    </div>
                    <hr>
                ` : '<div style="background:#f1f5f9; padding:1rem; border-radius:12px; text-align:center; margin:1rem 0;"><i class="fas fa-lock"></i> <strong>Enroll in this course</strong> to leave a rating and review</div>'}
                
                <!-- Reviews Section -->
                <h4 style="margin: 1rem 0;"><i class="fas fa-comments"></i> Student Reviews</h4>
                <div id="reviewsList">
                    <p style="color:#64748b;">Loading reviews...</p>
                </div>
                
                <hr style="margin: 1.5rem 0;">
                
                <!-- Enroll Button -->
                <button class="btn btn-primary" style="width:100%; padding:0.8rem; font-size:1rem;" onclick="enrollCourse(${course.id}); closePreviewModal();" ${isEnrolled ? 'disabled' : ''}>
                    ${isEnrolled ? '<i class="fas fa-check-circle"></i> Already Enrolled' : '<i class="fas fa-shopping-cart"></i> Enroll Now'}
                </button>
            `);
            
            // Setup rating stars if user is enrolled
            if (isEnrolled) {
                $('#ratingInput').html('<div class="rating-stars">' + [1,2,3,4,5].map(i => `<i class="far fa-star star" data-rating="${i}"></i>`).join('') + '</div>');
                $('.star').on('click', function() {
                    let val = $(this).data('rating');
                    $('.star').removeClass('fas').addClass('far');
                    for(let i=1; i<=val; i++) $(`.star[data-rating="${i}"]`).removeClass('far').addClass('fas');
                });
            }
            
            $('#previewModal').css('display', 'flex');
        }
        
        function loadInstructors() {
            const instructors = [...new Map(allCourses.map(c => [c.instructor, { name: c.instructor, courses: [] }])).values()];
            instructors.forEach(inst => inst.courses = allCourses.filter(c => c.instructor === inst.name).map(c => c.title));
            $('#instructorsGrid').html(instructors.map(inst => `<div class="course-card"><div class="course-img">👨‍🏫</div><div class="course-info"><h3 style="color:#0284c7;">${escapeHtml(inst.name)}</h3><p>🎓 Teaches ${inst.courses.length} courses</p><p style="font-size:0.85rem; color:#475569;">📚 ${inst.courses.slice(0,3).join(', ')}</p></div></div>`).join(''));
        }
        
        const faqs = [
            { q: "How do I enroll in a course?", a: "Click the 'Enroll Now' button on any course card after logging in." },
            { q: "Are the courses self-paced?", a: "Yes, all courses are 100% self-paced. Learn at your own speed!" },
            { q: "Do I get a certificate?", a: "Yes! You'll receive a verified certificate upon completion." },
            { q: "Can I watch course preview videos?", a: "Yes! Each course has a YouTube preview video in the modal." },
            { q: "How do I leave a review?", a: "After enrolling, click on any course and scroll to the rating section." },
            { q: "Can I update my review?", a: "Yes! Submitting a new review will update your previous one." }
        ];
        
        function loadFAQ() {
            $('#faqAccordion').html(faqs.map((faq, i) => `<div class="faq-item"><div class="faq-question" onclick="toggleFAQ(${i})">${faq.q} <i class="fas fa-chevron-down"></i></div><div class="faq-answer">${faq.a}</div></div>`).join(''));
        }
        
        window.toggleFAQ = (index) => { $('.faq-item').eq(index).toggleClass('active'); };
        
        function showAuthModal(type) {
            $('#authModalTitle').text(type === 'login' ? 'Login to Learn Hub' : 'Create Your Account');
            $('#authUsername').toggle(type !== 'login');
            $('#authForm')[0].reset();
            $('#authMessage').hide();
            $('#authModal').css('display', 'flex');
            $('#authForm').off('submit').on('submit', function(e) { e.preventDefault(); handleAuth(type); });
        }
        
        function handleAuth(type) {
            const data = { action: type, email: $('#authEmail').val(), password: $('#authPassword').val() };
            if (type === 'register') data.username = $('#authUsername').val();
            $.post('auth.php', data, function(res) {
                if (res.success) {
                    closeAuthModal();
                    if (type === 'login') { showPopup('Welcome back!', 'success'); location.reload(); }
                    else { showPopup('Registration successful! Please login.', 'success'); showAuthModal('login'); }
                } else $('#authMessage').text(res.message).show();
            }, 'json');
        }
        
        function logout() { $.post('auth.php', { action: 'logout' }, () => location.reload()); }
        function closeAuthModal() { $('#authModal').hide(); }
        function closePreviewModal() { $('#previewModal').hide(); }
        
        function showPage(page) {
            $('.page').removeClass('active-page');
            $(`#${page}`).addClass('active-page');
            $('.nav-links a').removeClass('active');
            $(`.nav-links a[data-page="${page}"]`).addClass('active');
            if (page === 'courses') filterCourses();
            if (page === 'mycourses') loadMyCourses();
        }
        
        function loadCategories() {
            if(!allCourses.length) return;
            const cats = ['All', ...new Set(allCourses.map(c => c.category))];
            $('#categoryFilters').html(cats.map(cat => `<div class="chip ${cat === 'All' ? 'active' : ''}" data-category="${cat}" onclick="setCategory('${cat}')">${cat}</div>`).join(''));
        }
        
        window.setCategory = (cat) => {
            $('.chip').removeClass('active');
            $(`.chip[data-category="${cat}"]`).addClass('active');
            filterCourses();
        };
        
        $(document).ready(function() {
            loadCourses();
            loadFAQ();
            $('#contactForm').on('submit', function(e) { e.preventDefault(); showPopup('Message sent successfully!', 'success'); this.reset(); });
        });
    </script>
</body>
</html>