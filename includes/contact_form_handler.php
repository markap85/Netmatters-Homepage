<?php
/**
 * Contact Form Handler
 * Processes contact form submissions and stores them in the database
 */

require_once __DIR__ . '/../vendor/autoload.php';

// Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Initialize response array
$response = [
    'success' => false,
    'message' => '',
    'errors' => []
];

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Sanitize and validate input data
    $firstName = trim($_POST['first_name'] ?? '');
    $lastName = trim($_POST['last_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $company = trim($_POST['company'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');
    $marketingConsent = isset($_POST['marketing_consent']) ? 1 : 0;
    
    // Get client information for security
    $ipAddress = $_SERVER['REMOTE_ADDR'] ?? '';
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
    
    // Validation
    if (empty($firstName)) {
        $response['errors']['first_name'] = 'First name is required.';
    }
    
    if (empty($lastName)) {
        $response['errors']['last_name'] = 'Last name is required.';
    }
    
    if (empty($email)) {
        $response['errors']['email'] = 'Email is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['errors']['email'] = 'Please enter a valid email address.';
    }
    
    if (empty($subject)) {
        $response['errors']['subject'] = 'Subject is required.';
    }
    
    if (empty($message)) {
        $response['errors']['message'] = 'Message is required.';
    } elseif (strlen($message) < 10) {
        $response['errors']['message'] = 'Message must be at least 10 characters long.';
    }
    
    // If no validation errors, save to database
    if (empty($response['errors'])) {
        try {
            // Database connection
            $host = $_ENV['DB_HOST'];
            $dbname = $_ENV['DB_NAME'];
            $username = $_ENV['DB_USERNAME'];
            $password = $_ENV['DB_PASSWORD'];
            
            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
            
            // Prepare insert statement
            $insertQuery = $pdo->prepare("
                INSERT INTO contact_forms 
                (first_name, last_name, email, phone, company, subject, message, marketing_consent, ip_address, user_agent) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");
            
            // Execute insert
            $result = $insertQuery->execute([
                $firstName,
                $lastName,
                $email,
                $phone,
                $company,
                $subject,
                $message,
                $marketingConsent,
                $ipAddress,
                $userAgent
            ]);
            
            if ($result) {
                $response['success'] = true;
                $response['message'] = 'Thank you for your message! We will get back to you soon.';
                
                // Optional: Send email notification here
                // mail('admin@yoursite.com', 'New Contact Form Submission', $message);
                
            } else {
                $response['message'] = 'Sorry, there was a problem submitting your message. Please try again.';
            }
            
        } catch (PDOException $e) {
            error_log("Contact form database error: " . $e->getMessage());
            $response['message'] = 'Sorry, there was a technical problem. Please try again later.';
        }
    } else {
        $response['message'] = 'Please correct the errors below and try again.';
    }
    
    // If this is an AJAX request, return JSON
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
}

// Function to get form value with fallback
function getFormValue($field) {
    return htmlspecialchars($_POST[$field] ?? '', ENT_QUOTES, 'UTF-8');
}

// Function to check if field has error
function hasError($field, $errors) {
    return isset($errors[$field]);
}

// Function to get error message
function getError($field, $errors) {
    return $errors[$field] ?? '';
}
?>