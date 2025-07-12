<?php
require 'config.php';
$action = isset($_GET['action']) ? $_GET['action'] : 'view';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($action === 'add') {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $dob = $_POST['dob'];
        $stmt = $pdo->prepare("INSERT INTO students (first_name, last_name, email, dob) VALUES (?, ?, ?, ?)");
        $stmt->execute([$first_name, $last_name, $email, $dob]);
        header("Location: index.php?action=view");
        exit;
    } elseif ($action === 'update') {
        $student_id = $_POST['student_id'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $dob = $_POST['dob'];
        $stmt = $pdo->prepare("UPDATE students SET first_name = ?, last_name = ?, email = ?, dob = ? WHERE student_id = ?");
        $stmt->execute([$first_name, $last_name, $email, $dob, $student_id]);
        header("Location: index.php?action=view");
        exit;
    }
}

if ($action === 'delete' && isset($_GET['id'])) {
    $student_id = $_GET['id'];
    $stmt = $pdo->prepare("DELETE FROM students WHERE student_id = ?");
    $stmt->execute([$student_id]);
    header("Location: index.php?action=view");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Database Management</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Student Database Management</h1>

        <?php if ($action === 'add' || $action === 'edit'): ?>
            <?php
            $student = null;
            if ($action === 'edit' && isset($_GET['id'])) {
                $stmt = $pdo->prepare("SELECT * FROM students WHERE student_id = ?");
                $stmt->execute([$_GET['id']]);
                $student = $stmt->fetch(PDO::FETCH_ASSOC);
            }
            ?>
            <form method="POST" class="mb-6">
                <h2 class="text-xl mb-2"><?php echo $action === 'add' ? 'Add Student' : 'Edit Student'; ?></h2>
                <?php if ($action === 'edit'): ?>
                    <input type="hidden" name="student_id" value="<?php echo $student['student_id']; ?>">
                <?php endif; ?>
                <div class="mb-4">
                    <label class="block text-sm font-medium">First Name</label>
                    <input type="text" name="first_name" value="<?php echo $student ? $student['first_name'] : ''; ?>" class="w-full p-2 border rounded" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Last Name</label>
                    <input type="text" name="last_name" value="<?php echo $student ? $student['last_name'] : ''; ?>" class="w-full p-2 border rounded" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Email</label>
                    <input type="email" name="email" value="<?php echo $student ? $student['email'] : ''; ?>" class="w-full p-2 border rounded" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Date of Birth</label>
                    <input type="date" name="dob" value="<?php echo $student ? $student['dob'] : ''; ?>" class="w-full p-2 border rounded">
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
                <a href="index.php?action=view" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</a>
            </form>
        <?php else: ?>
            <a href="index.php?action=add" class="bg-green-500 text-white px-4 py-2 rounded mb-4 inline-block">Add New Student</a>
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border p-2">ID</th>
                        <th class="border p-2">Name</th>
                        <th class="border p-2">Email</th>
                        <th class="border p-2">DOB</th>
                        <th class="border p-2">Courses</th>
                        <th class="border p-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stmt = $pdo->query("SELECT * FROM students");
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $stmt_courses = $pdo->prepare("SELECT c.course_name FROM courses c JOIN enrollments e ON c.course_id = e.course_id WHERE e.student_id = ?");
                        $stmt_courses->execute([$row['student_id']]);
                        $courses = $stmt_courses->fetchAll(PDO::FETCH_COLUMN);
                        ?>
                        <tr>
                            <td class="border p-2"><?php echo $row['student_id']; ?></td>
                            <td class="border p-2"><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></td>
                            <td class="border p-2"><?php echo $row['email']; ?></td>
                            <td class="border p-2"><?php echo $row['dob']; ?></td>
                            <td class="border p-2"><?php echo implode(', ', $courses); ?></td>
                            <td class="border p-2">
                                <a href="index.php?action=edit&id=<?php echo $row['student_id']; ?>" class="text-blue-500">Edit</a>
                                <a href="index.php?action=delete&id=<?php echo $row['student_id']; ?>" class="text-red-500" onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>