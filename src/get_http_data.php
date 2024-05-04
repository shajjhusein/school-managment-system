<?php
include 'services/database.php';

$databaseService = DatabaseService::getInstance();
$class_id = $_GET['class_id'] ?? null;  // Get class ID from AJAX request
$instructor_class_id = $_GET['instructor_class_id'] ?? null;  // Get class ID from AJAX request
$instructor_id = $_GET['instructor_id'] ?? null;  // Get class ID from AJAX request
$instructor_student_class_id = $_GET['instructor_student_class_id'] ?? null;  // Get class ID from AJAX request
$instructor_student_class_course_id = $_GET['instructor_student_class_course_id'] ?? null;  // Get class ID from AJAX request
$instructor_student_class_class_id = $_GET['instructor_student_class_class_id'] ?? null;  // Get class ID from AJAX request
$generate_schedule_class_id = $_GET['generate_schedule_class_id'] ?? null;  // Get class ID from AJAX request
$generate_schedule_class_id_details = $_GET['generate_schedule_class_id_details'] ?? null;  // Get class ID from AJAX request


if ($class_id) {
    $courses = $databaseService->getCoursesByClassId($class_id);
    header('Content-Type: application/json');
    echo json_encode($courses);  // Send courses data as JSON
} else if ($instructor_class_id) {
    $courses = $databaseService->getCoursesByInstructorAndClass($instructor_id, $instructor_class_id);
    header('Content-Type: application/json');
    echo json_encode($courses);  // Send courses data as JSON
} else if ($instructor_student_class_id) {
    $courses = $databaseService->getStudentsByInstructorAndClass($instructor_id, $instructor_student_class_id);
    header('Content-Type: application/json');
    echo json_encode($courses);  // Send courses data as JSON
} else if ($instructor_student_class_course_id) {
    $courses = $databaseService->getStudentsByInstructorAndClassAndCourse($instructor_id, $instructor_student_class_class_id, $instructor_student_class_course_id);
    header('Content-Type: application/json');
    echo json_encode($courses);  // Send courses data as JSON
} else if ($generate_schedule_class_id) {
    $courses = $databaseService->generateMonthlySchedule($generate_schedule_class_id);
    header('Content-Type: application/json');
    echo json_encode($courses);  // Send courses data as JSON
} else if ($generate_schedule_class_id_details) {
    $courses = $databaseService->getScheduleByClassId($generate_schedule_class_id_details);
    header('Content-Type: application/json');
    echo json_encode($courses);  // Send courses data as JSON
} else {
    echo json_encode([]);  // Send empty array if no class_id provided
}
