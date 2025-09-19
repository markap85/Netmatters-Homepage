<?php
/**
 * Contact Form Submissions Viewer
 * Simple admin interface to view contact form submissions
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
    
    // Get all contact form submissions
    $query = $pdo->query("
        SELECT * FROM contact_forms 
        ORDER BY created_at DESC
    ");
    $submissions = $query->fetchAll();
    
    echo "📋 Contact Form Submissions\n";
    echo "===========================\n\n";
    
    if (empty($submissions)) {
        echo "ℹ️  No contact form submissions found.\n";
    } else {
        echo "📊 Total submissions: " . count($submissions) . "\n\n";
        
        foreach ($submissions as $index => $submission) {
            echo "📝 Submission #" . ($index + 1) . " (ID: {$submission['id']})\n";
            echo "─────────────────────────────────────────\n";
            echo "👤 Name: {$submission['first_name']} {$submission['last_name']}\n";
            echo "📧 Email: {$submission['email']}\n";
            if (!empty($submission['phone'])) {
                echo "📞 Phone: {$submission['phone']}\n";
            }
            if (!empty($submission['company'])) {
                echo "🏢 Company: {$submission['company']}\n";
            }
            echo "📌 Subject: {$submission['subject']}\n";
            echo "💬 Message: " . substr($submission['message'], 0, 100);
            if (strlen($submission['message']) > 100) {
                echo "...";
            }
            echo "\n";
            echo "📈 Marketing: " . ($submission['marketing_consent'] ? 'Yes' : 'No') . "\n";
            echo "🏷️  Status: {$submission['status']}\n";
            echo "📅 Submitted: {$submission['created_at']}\n";
            echo "🌐 IP: {$submission['ip_address']}\n";
            echo "\n";
        }
    }
    
    // Get submission statistics
    $statsQuery = $pdo->query("
        SELECT 
            status,
            COUNT(*) as count
        FROM contact_forms 
        GROUP BY status
        ORDER BY count DESC
    ");
    $stats = $statsQuery->fetchAll();
    
    if (!empty($stats)) {
        echo "📊 Submission Statistics:\n";
        echo "─────────────────────────\n";
        foreach ($stats as $stat) {
            echo "• {$stat['status']}: {$stat['count']}\n";
        }
        echo "\n";
    }
    
    // Get recent submissions count
    $recentQuery = $pdo->query("
        SELECT COUNT(*) as count 
        FROM contact_forms 
        WHERE created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)
    ");
    $recent = $recentQuery->fetch();
    
    echo "📈 Recent Activity:\n";
    echo "───────────────────\n";
    echo "• Last 7 days: {$recent['count']} submissions\n";
    
} catch (PDOException $e) {
    echo "❌ Database error: " . $e->getMessage() . "\n";
    exit(1);
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    exit(1);
}
?>