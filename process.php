<?php
// Club Registration Form Processing
// TODO: Add your PHP processing code here starting in Step 3

/* 
Step 3 Requirements:
- Process form data using $_POST
- Display submitted information back to user
- Handle name, email, and club fields
*/
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $club = $_POST['club'] ?? '';
    
    // Display submitted information
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Registration Successful</title>
        <link rel='stylesheet' href='styles.css'>
    </head>
    <body>
        <header>
            <h1>Registration Successful!</h1>
        </header>
        
        <main>
            <div class='container'>
                <h2>Your Registration Details:</h2>
                <p><strong>Name:</strong> $name</p>
                <p><strong>Email:</strong> $email</p>
                <p><strong>Club:</strong> " . ucfirst($club) . " Club</p>
                
                <p><a href='index.html'>Register Another Student</a></p>
            </div>
        </main>
        
        <footer>
            <p>&copy; 2024 Student Club Registration System</p>
        </footer>
    </body>
    </html>";
} else {
    // Redirect if accessed directly
    header('Location: index.html');
    exit();
}



/*Step 4 Requirements:
- Add validation for all fields
- Check for empty fields
- Validate email format
- Display appropriate error messages
*/

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Initialize variables
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $club = $_POST['club'] ?? '';
    $errors = [];
    
    // Validate name
    if (empty($name)) {
        $errors[] = "Name is required";
    } elseif (strlen($name) < 2) {
        $errors[] = "Name must be at least 2 characters long";
    }
    
    // Validate email
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address";
    }
    
    // Validate club selection
    if (empty($club)) {
        $errors[] = "Please select a club";
    } elseif (!in_array($club, ['science', 'art', 'sports', 'music'])) {
        $errors[] = "Invalid club selection";
    }
    
    // Check for errors
    if (!empty($errors)) {
        // Display error page
        echo "<!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Registration Error</title>
            <link rel='stylesheet' href='styles.css'>
        </head>
        <body>
            <header>
                <h1>Registration Error</h1>
            </header>
            
            <main>
                <div class='container'>
                    <h2>Please fix the following errors:</h2>
                    <ul>";
                    foreach ($errors as $error) {
                        echo "<li>$error</li>";
                    }
                    echo "</ul>
                    <p><a href='index.html'>Go back to registration form</a></p>
                </div>
            </main>
            
            <footer>
                <p>&copy; 2024 Student Club Registration System</p>
            </footer>
        </body>
        </html>";
    } else {
        // Display success page (same as Step 3)
        echo "<!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Registration Successful</title>
            <link rel='stylesheet' href='styles.css'>
        </head>
        <body>
            <header>
                <h1>Registration Successful!</h1>
            </header>
            
            <main>
                <div class='container'>
                    <h2>Your Registration Details:</h2>
                    <p><strong>Name:</strong> $name</p>
                    <p><strong>Email:</strong> $email</p>
                    <p><strong>Club:</strong> " . ucfirst($club) . " Club</p>
                    
                    <p><a href='index.html'>Register Another Student</a></p>
                </div>
            </main>
            
            <footer>
                <p>&copy; 2024 Student Club Registration System</p>
            </footer>
        </body>
        </html>";
    }
} else {
    // Redirect if accessed directly
    header('Location: index.html');
    exit();
}


/*
Step 5 Requirements:
- Store registration data in arrays
- Display list of all registrations
- Use loops to process array data
*/
session_start();

// Initialize registrations array if not exists
if (!isset($_SESSION['registrations'])) {
    $_SESSION['registrations'] = [];
}

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Initialize variables
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $club = $_POST['club'] ?? '';
    $errors = [];
    
    // Validate name
    if (empty($name)) {
        $errors[] = "Name is required";
    } elseif (strlen($name) < 2) {
        $errors[] = "Name must be at least 2 characters long";
    }
    
    // Validate email
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address";
    }
    
    // Validate club selection
    if (empty($club)) {
        $errors[] = "Please select a club";
    } elseif (!in_array($club, ['science', 'art', 'sports', 'music'])) {
        $errors[] = "Invalid club selection";
    }
    
    // Check for errors
    if (!empty($errors)) {
        // Display error page
        echo "<!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Registration Error</title>
            <link rel='stylesheet' href='styles.css'>
        </head>
        <body>
            <header>
                <h1>Registration Error</h1>
            </header>
            
            <main>
                <div class='container'>
                    <h2>Please fix the following errors:</h2>
                    <ul>";
                    foreach ($errors as $error) {
                        echo "<li>$error</li>";
                    }
                    echo "</ul>
                    <p><a href='index.html'>Go back to registration form</a></p>
                </div>
            </main>
            
            <footer>
                <p>&copy; 2024 Student Club Registration System</p>
            </footer>
        </body>
        </html>";
    } else {
        // Add registration to array
        $registration = [
            'name' => $name,
            'email' => $email,
            'club' => $club,
            'timestamp' => date('Y-m-d H:i:s')
        ];
        
        array_unshift($_SESSION['registrations'], $registration);
        
        // Display success page with all registrations
        echo "<!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Registration Successful</title>
            <link rel='stylesheet' href='styles.css'>
        </head>
        <body>
            <header>
                <h1>Registration Successful!</h1>
            </header>
            
            <main>
                <div class='container'>
                    <h2>Your Registration Details:</h2>
                    <p><strong>Name:</strong> $name</p>
                    <p><strong>Email:</strong> $email</p>
                    <p><strong>Club:</strong> " . ucfirst($club) . " Club</p>
                    
                    <h2>All Registrations:</h2>
                    <table>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Club</th>
                            <th>Registered At</th>
                        </tr>";
                        
                        foreach ($_SESSION['registrations'] as $reg) {
                            echo "<tr>
                                <td>{$reg['name']}</td>
                                <td>{$reg['email']}</td>
                                <td>" . ucfirst($reg['club']) . " Club</td>
                                <td>{$reg['timestamp']}</td>
                            </tr>";
                        }
                        
                    echo "</table>
                    
                    <p><a href='index.html'>Register Another Student</a></p>
                    <p><a href='process.php?clear=true'>Clear All Registrations</a></p>
                </div>
            </main>
            
            <footer>
                <p>&copy; 2024 Student Club Registration System</p>
            </footer>
        </body>
        </html>";
    }
} elseif (isset($_GET['clear']) && $_GET['clear'] === 'true') {
    // Clear registrations
    $_SESSION['registrations'] = [];
    header('Location: index.html');
    exit();
} else {
    // Redirect if accessed directly
    header('Location: index.html');
    exit();
}
?>



?>




Step 6 Requirements:
- Add enhanced features like:
  - File storage for persistence
  - Additional form fields
  - Better error handling
  - Search functionality
*/

?>
