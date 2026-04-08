<?php
// Start output buffering to prevent header issues
ob_start();

// Standalone setup script - doesn't depend on config.php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "crud";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Setup</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .container {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            max-width: 700px;
            width: 100%;
        }
        h1 {
            color: #667eea;
            margin-bottom: 10px;
            font-size: 32px;
        }
        .subtitle {
            color: #666;
            margin-bottom: 30px;
        }
        .step {
            padding: 15px;
            margin: 15px 0;
            border-radius: 8px;
            border-left: 5px solid #ddd;
        }
        .step.success {
            background: #d4edda;
            border-left-color: #28a745;
            color: #155724;
        }
        .step.error {
            background: #f8d7da;
            border-left-color: #dc3545;
            color: #721c24;
        }
        .step.info {
            background: #d1ecf1;
            border-left-color: #17a2b8;
            color: #0c5460;
        }
        .icon {
            font-size: 20px;
            margin-right: 10px;
        }
        .btn {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 8px;
            margin: 10px 5px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }
        .btn-secondary {
            background: #6c757d;
        }
        .divider {
            height: 2px;
            background: linear-gradient(90deg, transparent, #667eea, transparent);
            margin: 30px 0;
        }
        .success-box {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            margin: 20px 0;
        }
        .success-box h2 {
            margin-bottom: 10px;
        }
        ul {
            padding-left: 20px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔧 Database Setup</h1>
        <p class="subtitle">Setting up your CRUD database</p>
        
        <?php
        try {
            // Step 1: Connect to MySQL
            echo "<div class='step info'><span class='icon'>⚙️</span><strong>Step 1:</strong> Connecting to MySQL...</div>";
            $conn = new PDO("mysql:host=$host;charset=utf8mb4", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "<div class='step success'><span class='icon'>✅</span>Connected to MySQL successfully!</div>";
            
            // Step 2: Create database
            echo "<div class='step info'><span class='icon'>⚙️</span><strong>Step 2:</strong> Creating database '$dbname'...</div>";
            $conn->exec("CREATE DATABASE IF NOT EXISTS `$dbname`");
            echo "<div class='step success'><span class='icon'>✅</span>Database '$dbname' created successfully!</div>";
            
            // Step 3: Select database
            echo "<div class='step info'><span class='icon'>⚙️</span><strong>Step 3:</strong> Selecting database...</div>";
            $conn->exec("USE `$dbname`");
            echo "<div class='step success'><span class='icon'>✅</span>Database selected!</div>";
            
            // Step 4: Create table
            echo "<div class='step info'><span class='icon'>⚙️</span><strong>Step 4:</strong> Creating 'users' table...</div>";
            $sql = "CREATE TABLE IF NOT EXISTS users (
                id INT(11) AUTO_INCREMENT PRIMARY KEY,
                firstname VARCHAR(50) NOT NULL,
                lastname VARCHAR(50) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
            
            $conn->exec($sql);
            echo "<div class='step success'><span class='icon'>✅</span>Table 'users' created successfully!
                <ul>
                    <li>id (Primary Key, Auto Increment)</li>
                    <li>firstname (VARCHAR 50)</li>
                    <li>lastname (VARCHAR 50)</li>
                    <li>created_at (TIMESTAMP)</li>
                </ul>
            </div>";
            
            echo "<div class='divider'></div>";
            echo "<div class='success-box'>
                <h2>🎉 Setup Complete!</h2>
                <p>Your database is ready! The 'users' table is empty and ready for you to add data.</p>
            </div>";
            
            echo "<div style='text-align: center;'>
                <a href='index.php' class='btn'>📋 View Users</a>
                <a href='add.php' class='btn'>➕ Add First User</a>
            </div>";
            
        } catch(PDOException $e) {
            echo "<div class='step error'>
                <span class='icon'>❌</span><strong>Error:</strong> " . htmlspecialchars($e->getMessage()) . "
            </div>";
            
            echo "<div class='divider'></div>";
            echo "<h3 style='color: #dc3545;'>Troubleshooting:</h3>";
            echo "<div class='step error'>
                <ul>
                    <li>Make sure MySQL is running in XAMPP</li>
                    <li>Check if port 3306 is available</li>
                    <li>Verify MySQL credentials (root with no password)</li>
                </ul>
            </div>";
            
            echo "<div style='text-align: center;'>
                <a href='setup.php' class='btn'>🔄 Try Again</a>
            </div>";
        }
        
        $conn = null;
        ?>
    </div>
</body>
</html>