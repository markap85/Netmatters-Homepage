<?php
/**
 * Contact Form Table Setup - Alternative Approach
 * Creates table with different name to avoid tablespace conflicts
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
    
    // Create the contact forms table (using different name to avoid conflicts)
    $createTableSQL = "
    CREATE TABLE IF NOT EXISTS contact_forms (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        first_name VARCHAR(100) NOT NULL,
        last_name VARCHAR(100) NOT NULL,
        email VARCHAR(255) NOT NULL,
        phone VARCHAR(20),
        company VARCHAR(150),
        subject VARCHAR(200) NOT NULL,
        message TEXT NOT NULL,
        marketing_consent BOOLEAN DEFAULT FALSE,
        ip_address VARCHAR(45),
        user_agent TEXT,
        status ENUM('new', 'read', 'responded', 'spam') DEFAULT 'new',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        INDEX idx_status (status),
        INDEX idx_created_at (created_at),
        INDEX idx_email (email)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ";
    
    // Execute table creation
    $pdo->exec($createTableSQL);
    echo "✅ Contact forms table created successfully.\n";
    
    // Verify table creation
    $checkTable = $pdo->query("DESCRIBE contact_forms");
    $columns = $checkTable->fetchAll();
    
    echo "\n📋 Contact forms table structure:\n";
    echo "==========================================\n";
    foreach ($columns as $column) {
        echo "   - {$column['Field']} ({$column['Type']})";
        if ($column['Null'] === 'NO') {
            echo " NOT NULL";
        }
        if ($column['Default'] !== null) {
            echo " DEFAULT {$column['Default']}";
        }
        if ($column['Key'] === 'PRI') {
            echo " PRIMARY KEY";
        }
        if ($column['Key'] === 'MUL') {
            echo " INDEX";
        }
        if ($column['Extra']) {
            echo " {$column['Extra']}";
        }
        echo "\n";
    }
    
    // Test insert to make sure table is working
    echo "\n🧪 Testing table functionality...\n";
    $testInsert = $pdo->prepare("
        INSERT INTO contact_forms 
        (first_name, last_name, email, subject, message, ip_address) 
        VALUES (?, ?, ?, ?, ?, ?)
    ");
    
    $testResult = $testInsert->execute([
        'Test',
        'User', 
        'test@example.com',
        'Test Subject',
        'This is a test message to verify the table is working properly.',
        '127.0.0.1'
    ]);
    
    if ($testResult) {
        echo "✅ Test record inserted successfully.\n";
        
        // Get the count of records
        $countQuery = $pdo->query("SELECT COUNT(*) as count FROM contact_forms");
        $count = $countQuery->fetch();
        echo "📊 Current records in contact_forms table: {$count['count']}\n";
        
        // Clean up test record
        $pdo->exec("DELETE FROM contact_forms WHERE email = 'test@example.com'");
        echo "🧹 Test record cleaned up.\n";
    }
    
    echo "\n🎯 Table features:\n";
    echo "   ✓ Table name: contact_forms\n";
    echo "   ✓ Primary key with auto-increment\n";
    echo "   ✓ Required fields: first_name, last_name, email, subject, message\n";
    echo "   ✓ Optional fields: phone, company\n";
    echo "   ✓ Marketing consent tracking\n";
    echo "   ✓ IP address and user agent logging for security\n";
    echo "   ✓ Status tracking (new, read, responded, spam)\n";
    echo "   ✓ Timestamps for created and updated dates\n";
    echo "   ✓ Indexes for performance optimization\n";
    echo "   ✓ UTF8MB4 charset for emoji support\n";
    
    echo "\n💡 Usage in PHP:\n";
    echo "   - Table name: contact_forms\n";
    echo "   - Use prepared statements for security\n";
    echo "   - Remember to sanitize and validate input data\n";
    
    echo "\n✅ Contact form database setup complete!\n";
    
} catch (PDOException $e) {
    echo "❌ Database error: " . $e->getMessage() . "\n";
    exit(1);
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    exit(1);
}
?>