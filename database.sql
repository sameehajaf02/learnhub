-- Create database
CREATE DATABASE IF NOT EXISTS lms_db;
USE lms_db;

-- Users table
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Courses table
CREATE TABLE courses (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(200) NOT NULL,
    description TEXT,
    category VARCHAR(50),
    instructor VARCHAR(100),
    duration VARCHAR(50),
    level VARCHAR(20),
    price DECIMAL(10,2) DEFAULT 0,
    image_icon VARCHAR(10),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Enrollments table
CREATE TABLE enrollments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    course_id INT,
    enrolled_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE,
    UNIQUE KEY unique_enrollment (user_id, course_id)
);

-- Insert 20 courses
INSERT INTO courses (title, description, category, instructor, duration, level, image_icon) VALUES
('Complete Web Development Bootcamp', 'Learn HTML, CSS, JavaScript, React, Node.js from scratch. Build real-world projects and become a full-stack developer.', 'Web Development', 'Dr. Sarah Johnson', '12 weeks', 'Beginner', '🌐'),
('Python Mastery: From Zero to Hero', 'Comprehensive Python programming with projects. Learn data structures, OOP, and build applications.', 'Programming', 'Prof. Michael Chen', '8 weeks', 'Beginner', '🐍'),
('Data Science & Machine Learning', 'ML algorithms, Python, TensorFlow, real-world projects. Master data analysis and AI.', 'Data Science', 'Dr. Emily Rodriguez', '10 weeks', 'Intermediate', '📊'),
('UI/UX Design Fundamentals', 'User research, prototyping, Figma, design systems. Create beautiful user experiences.', 'Design', 'Lisa Wong', '6 weeks', 'Beginner', '🎨'),
('Digital Marketing Masterclass', 'SEO, Social Media, Analytics, Content Strategy. Grow your business online.', 'Marketing', 'David Kumar', '8 weeks', 'All Levels', '📈'),
('JavaScript: The Advanced Concepts', 'Closures, promises, async patterns, OOP. Master modern JavaScript.', 'Programming', 'James Wilson', '5 weeks', 'Advanced', '⚡'),
('React.js Complete Guide', 'Hooks, Redux, Next.js, modern React patterns. Build powerful web apps.', 'Web Development', 'Anna Martinez', '7 weeks', 'Intermediate', '⚛️'),
('Mobile App Development with Flutter', 'Build iOS & Android apps with Dart. Cross-platform development.', 'Mobile Development', 'Robert Taylor', '9 weeks', 'Intermediate', '📱'),
('Cybersecurity Essentials', 'Network security, cryptography, ethical hacking. Protect digital assets.', 'Security', 'Dr. James Bond', '6 weeks', 'Beginner', '🔒'),
('Cloud Computing with AWS', 'EC2, S3, Lambda, serverless architecture. Master cloud technologies.', 'Cloud', 'Patricia Brown', '8 weeks', 'Intermediate', '☁️'),
('Artificial Intelligence Fundamentals', 'Neural networks, NLP, computer vision basics. Explore AI concepts.', 'AI', 'Dr. Alan Turing', '10 weeks', 'Advanced', '🤖'),
('Graphic Design with Adobe Suite', 'Photoshop, Illustrator, InDesign mastery. Create stunning visuals.', 'Design', 'Maria Garcia', '7 weeks', 'Beginner', '🎨'),
('Business Intelligence & Analytics', 'Tableau, Power BI, SQL for business. Make data-driven decisions.', 'Business', 'Thomas Lee', '6 weeks', 'Intermediate', '📊'),
('PHP & MySQL Backend Development', 'REST APIs, authentication, database design. Build robust backends.', 'Backend', 'Kevin Johnson', '8 weeks', 'Intermediate', '🐘'),
('DevOps Engineering', 'Docker, Kubernetes, CI/CD pipelines. Automate deployment.', 'DevOps', 'Emma Watson', '9 weeks', 'Advanced', '🚀'),
('Blockchain & Cryptocurrency', 'Smart contracts, Ethereum, Web3 basics. Understand blockchain technology.', 'Blockchain', 'Chris Evans', '5 weeks', 'Intermediate', '⛓️'),
('Game Development with Unity', 'C#, 2D/3D games, physics, animations. Create interactive games.', 'Game Dev', 'Nathan Drake', '12 weeks', 'Beginner', '🎮'),
('Photography & Video Editing', 'Composition, Lightroom, Premiere Pro. Master visual storytelling.', 'Creative', 'Sofia Martinez', '6 weeks', 'Beginner', '📸'),
('Project Management Professional', 'Agile, Scrum, PMP certification prep. Lead projects effectively.', 'Business', 'Richard Park', '8 weeks', 'All Levels', '📋'),
('English Communication Skills', 'Business English, public speaking, writing. Improve communication.', 'Language', 'Jennifer Lopez', '6 weeks', 'Beginner', '💬');