<?php
include 'config.php';
$sql = "SELECT s.FirstName, s.LastName, c.CourseName, e.Grade
        FROM Students s
        JOIN Enrollments e ON s.StudentID = e.StudentID
        JOIN Courses c ON e.CourseID = c.CourseID";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head><title>Student Enrollments</title></head>
<body>
<h2>Student Enrollments</h2>
<table border='1'>
<tr><th>First Name</th><th>Last Name</th><th>Course</th><th>Grade</th></tr>
<?php while($row = $result->fetch_assoc()) {
    echo "<tr><td>{$row['FirstName']}</td><td>{$row['LastName']}</td><td>{$row['CourseName']}</td><td>{$row['Grade']}</td></tr>";
} ?>
</table>
</body>
</html>
<?php $conn->close(); ?>
