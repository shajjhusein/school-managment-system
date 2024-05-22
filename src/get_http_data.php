<?php
include 'services/database.php';

$databaseService = DatabaseService::getInstance();

// Gather all possible GET parameters
$getParams = [
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

// Gather all possible POST parameters
$postParams = $_POST ?? [];

$result = [];

// Determine which action to take based on parameters
if ($getParams['class_id']) {
    $result = $databaseService->getCoursesByClassId($getParams['class_id']);
} elseif ($getParams['instructor_class_id']) {
    $result = $databaseService->getCoursesByInstructorAndClass($getParams['instructor_id'], $getParams['instructor_class_id']);
} elseif ($getParams['instructor_student_class_id']) {
    $result = $databaseService->getStudentsByInstructorAndClass($getParams['instructor_id'], $getParams['instructor_student_class_id']);
} elseif ($getParams['instructor_student_class_course_id']) {
    $result = $databaseService->getStudentsByInstructorAndClassAndCourse($getParams['instructor_id'], $getParams['instructor_student_class_class_id'], $getParams['instructor_student_class_course_id']);
} elseif ($getParams['generate_schedule_class_id']) {
    $result = $databaseService->generateMonthlySchedule($getParams['generate_schedule_class_id']);
} elseif ($getParams['generate_schedule_class_id_details']) {
    $result = $databaseService->getScheduleByClassId($getParams['generate_schedule_class_id_details']);
} elseif ($getParams['generate_schedule_for_student']) {
    $result = $databaseService->getScheduleByUserId($getParams['generate_schedule_for_student']);
} elseif ($getParams['course_id_quiz']) {
    $result = $databaseService->fetchQuizzesForCourse($getParams['course_id_quiz']);
} elseif ($postParams['action'] ?? null) {
    // Handle POST actions
    switch ($postParams['action']) {
        case 'delete_quiz':
            if (isset($postParams['quiz_id'])) {
                $result = $databaseService->deleteQuize($postParams['quiz_id']);
            } else {
                $result = ['error' => 'Missing quiz_id parameter'];
            }
            break;
        case 'delete_material':
            if (isset($postParams['material_id'])) {
                $result = $databaseService->deleteMaterial($postParams['material_id']);
            } else {
                $result = ['error' => 'Missing material_id parameter'];
            }
            break;
        case 'add_quiz':
            // Check if all required parameters are provided
            if (isset($postParams['dueDate']) && isset($postParams['content']) && isset($postParams['course_id'])) {
                // Call the addQuiz method from the database service
                $dueDate = $postParams['dueDate'];
                $content = $postParams['content'];
                $courseId = $postParams['course_id'];
                $result = $databaseService->addQuiz($dueDate, $content, $courseId);
            } else {
                $result = ['error' => 'Missing required parameters for adding a quiz'];
            }
            break;
        case 'add_material':
            if (isset($postParams['content']) && isset($postParams['course_id'])) {
                // Call the addQuiz method from the database service
                $content = $postParams['content'];
                $courseId = $postParams['course_id'];
                $result = $databaseService->addMaterial($content, $courseId);
            } else {
                $result = ['error' => 'Missing required parameters for adding a quiz'];
            }
            break;
        default:
            $result = ['error' => 'Invalid action'];
            break;
    }
} else {
    $result = ['error' => 'No valid parameters provided'];
}

// Output the result as JSON
header('Content-Type: application/json');
echo json_encode($result);
