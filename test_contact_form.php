<?php
/**
 * Test Contact Form Submission
 * Simple test to verify the contact form database functionality
 */

require_once 'vendor/autoload.php';

// Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

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
    
    echo "✅ Connected to database successfully.\n";
    
    // Insert a test contact form submission
    $insertQuery = $pdo->prepare("
        INSERT INTO contact_forms 
        (first_name, last_name, email, phone, company, subject, message, marketing_consent, ip_address, user_agent) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");
    
    $result = $insertQuery->execute([
        'John',
        'Doe',
        'john.doe@example.com',
        '01234 567890',
        'Test Company Ltd',
        'General Inquiry',
        'This is a test message to verify the contact form is working properly. The message contains enough text to meet the minimum length requirement.',
        1, // marketing consent
        '192.168.1.100',
        'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Test Browser'
    ]);
    
    if ($result) {
        echo "✅ Test contact form submission added successfully.\n";
        
        // Get the ID of the inserted record
        $insertId = $pdo->lastInsertId();
        echo "📝 Submission ID: $insertId\n";
        
        // Fetch and display the submitted data
        $fetchQuery = $pdo->prepare("SELECT * FROM contact_forms WHERE id = ?");
        $fetchQuery->execute([$insertId]);
        $submission = $fetchQuery->fetch();
        
        if ($submission) {
            echo "\n📋 Submitted Contact Form Data:\n";
            echo "==============================\n";
            echo "Name: {$submission['first_name']} {$submission['last_name']}\n";
            echo "Email: {$submission['email']}\n";
            echo "Phone: {$submission['phone']}\n";
            echo "Company: {$submission['company']}\n";
            echo "Subject: {$submission['subject']}\n";
            echo "Message: " . substr($submission['message'], 0, 100) . "...\n";
            echo "Marketing Consent: " . ($submission['marketing_consent'] ? 'Yes' : 'No') . "\n";
            echo "Status: {$submission['status']}\n";
            echo "Submitted: {$submission['created_at']}\n";
            echo "IP Address: {$submission['ip_address']}\n";
        }
        
        // Get total count of submissions
        $countQuery = $pdo->query("SELECT COUNT(*) as count FROM contact_forms");
        $count = $countQuery->fetch();
        echo "\n📊 Total contact form submissions: {$count['count']}\n";
        
        // Clean up test record
        $pdo->prepare("DELETE FROM contact_forms WHERE id = ?")->execute([$insertId]);
        echo "🧹 Test record cleaned up.\n";
    }
    
    echo "\n✅ Contact form database test complete!\n";
    echo "🎯 The contact form is ready to receive submissions.\n";
    
} catch (PDOException $e) {
    echo "❌ Database error: " . $e->getMessage() . "\n";
    exit(1);
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    exit(1);
}
?>