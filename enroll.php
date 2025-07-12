<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = $_POST['student_id'];
    $course_id = $_POST['course_id'];
    $enrollment_date = date('Y-m-d');
    $stmt = $pdo->prepare("INSERT INTO enrollments (student_id, course_id, enrollment_date) VALUES (?, ?, ?)");
    $stmt->execute([$student_id, $course_id, $enrollment_date]);
    header("Location: index.php?action=view");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enroll Student</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Enroll Student in Course</h1>
        <form method="POST" class="mb-6">
            <div class="mb-4">
                <label class="block text-sm font-medium">Student</label>
                <select name="student_id" class="w-full p-2 border rounded" required>
                    <?php
                    $stmt = $pdo->query("SELECT student_id, first_name, last_name FROM students");
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='{$row['student_id']}'>{$row['first_name']} {$row['last_name']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium">Course</label>
                <select name="course_id" class="w-full p-2 border rounded" required>
                    <?php
                    $stmt = $pdo->query("SELECT course_id, course_name FROM courses");
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='{$row['course_id']}'>{$row['course_name']}</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Enroll</button>
            <a href="index.php?action=view" class="bg-gray-500 text-white px-4 py-2 rounded">Back</a>
        </form>
    </div>
</body>
</html>