<?php
include 'services/database.php';

$databaseService = DatabaseService::getInstance();

// Gather all possible GET parameters
$params = [
    'class_id' => $_GET['class_id'] ?? null,
    'instructor_class_id' => $_GET['instructor_class_id'] ?? null,
    'instructor_id' => $_GET['instructor_id'] ?? null,
    'instructor_student_class_id' => $_GET['instructor_student_class_id'] ?? null,
    'instructor_student_class_course_id' => $_GET['instructor_student_class_course_id'] ?? null,
    'instructor_student_class_class_id' => $_GET['instructor_student_class_class_id'] ?? null,
    'generate_schedule_class_id' => $_GET['generate_schedule_class_id'] ?? null,
    'generate_schedule_class_id_details' => $_GET['generate_schedule_class_id_details'] ?? null,
    'generate_schedule_for_student' => $_GET['generate_schedule_for_student'] ?? null,
    'course_id_quiz' => $_GET['course_id_quiz'] ?? null


];

$result = [];

// Determine which action to take based on parameters
if ($params['class_id']) {
    $result = $databaseService->getCoursesByClassId($params['class_id']);
} elseif ($params['instructor_class_id']) {
    $result = $databaseService->getCoursesByInstructorAndClass($params['instructor_id'], $params['instructor_class_id']);
} elseif ($params['instructor_student_class_id']) {
    $result = $databaseService->getStudentsByInstructorAndClass($params['instructor_id'], $params['instructor_student_class_id']);
} elseif ($params['instructor_student_class_course_id']) {
    $result = $databaseService->getStudentsByInstructorAndClassAndCourse($params['instructor_id'], $params['instructor_student_class_class_id'], $params['instructor_student_class_course_id']);
} elseif ($params['generate_schedule_class_id']) {
    $result = $databaseService->generateMonthlySchedule($params['generate_schedule_class_id']);
} elseif ($params['generate_schedule_class_id_details']) {
    $result = $databaseService->getScheduleByClassId($params['generate_schedule_class_id_details']);
} elseif ($params['generate_schedule_for_student']) {
    $result = $databaseService->getScheduleByUserId($params['generate_schedule_for_student']);
} elseif ($params['course_id_quiz']) {
    $result = $databaseService->fetchQuizzesForCourse($params['course_id_quiz']);
}

// Output the result as JSON
header('Content-Type: application/json');
echo json_encode($result ? $result : []);
