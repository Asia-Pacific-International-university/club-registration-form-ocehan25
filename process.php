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



/*Step 6 Requirements:
- Add enhanced features like:
  - File storage for persistence
  - Additional form fields
  - Better error handling
  - Search functionality
*/
// Club Registration Form Processing - Step 6

// Start session to store registrations
session_start();

// Initialize registrations array if not exists
if (!isset($_SESSION['registrations'])) {
    $_SESSION['registrations'] = [];
}

// Custom function to sanitize input
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Custom function to validate phone number
function validatePhone($phone) {
    // Remove all non-digit characters
    $phone = preg_replace('/[^0-9]/', '', $phone);
    
    // Check if phone number has 10 digits
    if (strlen($phone) === 10) {
        return true;
    }
    
    return false;
}

// Custom function to save registrations to file
function saveRegistrationsToFile($registrations) {
    $filename = 'registrations.txt';
    $data = json_encode($registrations);
    file_put_contents($filename, $data);
}

// Custom function to load registrations from file
function loadRegistrationsFromFile() {
    $filename = 'registrations.txt';
    if (file_exists($filename)) {
        $data = file_get_contents($filename);
        return json_decode($data, true) ?: [];
    }
    return [];
}

// Load registrations from file at start
if (empty($_SESSION['registrations'])) {
    $_SESSION['registrations'] = loadRegistrationsFromFile();
}

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and initialize variables
    $name = sanitizeInput($_POST['name'] ?? '');
    $email = sanitizeInput($_POST['email'] ?? '');
    $phone = sanitizeInput($_POST['phone'] ?? '');
    $year = sanitizeInput($_POST['year'] ?? '');
    $club = $_POST['club'] ?? '';
    $interests = $_POST['interests'] ?? [];
    $comments = sanitizeInput($_POST['comments'] ?? '');
    
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
    
    // Validate phone (optional but if provided, validate format)
    if (!empty($phone) && !validatePhone($phone)) {
        $errors[] = "Please enter a valid 10-digit phone number";
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
                    <div class='error-container'>
                        <h2>Please fix the following errors:</h2>
                        <ul>";
                        foreach ($errors as $error) {
                            echo "<li>$error</li>";
                        }
                        echo "</ul>
                    </div>
                    <p><a href='index.html'>Go back to registration form</a></p>
                </div>
            </main>
            
            <footer>
                <p>&copy; 2024 Student Club Registration System</p>
            </footer>
        </body>
        </html>";
    } else {
        // Format phone number if provided
        if (!empty($phone)) {
            $phone = preg_replace('/[^0-9]/', '', $phone);
            $phone = "(" . substr($phone, 0, 3) . ") " . substr($phone, 3, 3) . "-" . substr($phone, 6);
        }
        
        // Add registration to array
        $registration = [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'year' => $year,
            'club' => $club,
            'interests' => $interests,
            'comments' => $comments,
            'timestamp' => date('Y-m-d H:i:s')
        ];
        
        array_unshift($_SESSION['registrations'], $registration);
        
        // Save to file
        saveRegistrationsToFile($_SESSION['registrations']);
        
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
                    <div class='success-container'>
                        <h2>Your Registration Details:</h2>
                        <p><strong>Name:</strong> $name</p>
                        <p><strong>Email:</strong> $email</p>";
                        
                        if (!empty($phone)) {
                            echo "<p><strong>Phone:</strong> $phone</p>";
                        }
                        
                        if (!empty($year)) {
                            echo "<p><strong>Academic Year:</strong> " . ucfirst($year) . "</p>";
                        }
                        
                        echo "<p><strong>Club:</strong> " . ucfirst($club) . " Club</p>";
                        
                        if (!empty($interests)) {
                            echo "<p><strong>Interests:</strong> " . implode(', ', array_map('ucfirst', $interests)) . "</p>";
                        }
                        
                        if (!empty($comments)) {
                            echo "<p><strong>Comments:</strong> $comments</p>";
                        }
                        
                    echo "</div>
                    
                    <h2>All Registrations:</h2>
                    
                    <form method='get' action='process.php' style='margin-bottom: 20px;'>
                        <input type='text' name='search' placeholder='Search registrations...' value='" . ($_GET['search'] ?? '') . "'>
                        <input type='submit' value='Search' style='padding: 8px 15px; font-size: 14px; margin-left: 10px;'>
                    </form>
                    
                    <table>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Club</th>
                            <th>Registered At</th>
                        </tr>";
                        
                        $searchTerm = $_GET['search'] ?? '';
                        $displayedRegistrations = 0;
                        
                        foreach ($_SESSION['registrations'] as $reg) {
                            // Filter by search term if provided
                            if (!empty($searchTerm)) {
                                $searchTerm = strtolower($searchTerm);
                                $nameMatch = strpos(strtolower($reg['name']), $searchTerm) !== false;
                                $emailMatch = strpos(strtolower($reg['email']), $searchTerm) !== false;
                                $clubMatch = strpos(strtolower($reg['club']), $searchTerm) !== false;
                                
                                if (!$nameMatch && !$emailMatch && !$clubMatch) {
                                    continue;
                                }
                            }
                            
                            echo "<tr>
                                <td>{$reg['name']}</td>
                                <td>{$reg['email']}</td>
                                <td>" . ucfirst($reg['club']) . " Club</td>
                                <td>{$reg['timestamp']}</td>
                            </tr>";
                            $displayedRegistrations++;
                        }
                        
                        if ($displayedRegistrations === 0) {
                            echo "<tr><td colspan='4' style='text-align: center;'>No registrations found" . 
                                 (!empty($searchTerm) ? " matching '$searchTerm'" : "") . "</td></tr>";
                        }
                        
                    echo "</table>
                    
                    <p style='margin-top: 20px;'><a href='index.html'>Register Another Student</a></p>
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
    saveRegistrationsToFile([]);
    header('Location: index.html');
    exit();
} else {
    // Display registrations if accessed directly with search
    $searchTerm = $_GET['search'] ?? '';
    
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Club Registrations</title>
        <link rel='stylesheet' href='styles.css'>
    </head>
    <body>
        <header>
            <h1>Club Registrations</h1>
        </header>
        
        <main>
            <div class='container'>
                <form method='get' action='process.php' style='margin-bottom: 20px;'>
                    <input type='text' name='search' placeholder='Search registrations...' value='$searchTerm'>
                    <input type='submit' value='Search' style='padding: 8px 15px; font-size: 14px; margin-left: 10px;'>
                </form>
                
                <table>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Club</th>
                        <th>Registered At</th>
                    </tr>";
                    
                    $displayedRegistrations = 0;
                    
                    foreach ($_SESSION['registrations'] as $reg) {
                        // Filter by search term if provided
                        if (!empty($searchTerm)) {
                            $searchTerm = strtolower($searchTerm);
                            $nameMatch = strpos(strtolower($reg['name']), $searchTerm) !== false;
                            $emailMatch = strpos(strtolower($reg['email']), $searchTerm) !== false;
                            $clubMatch = strpos(strtolower($reg['club']), $searchTerm) !== false;
                            
                            if (!$nameMatch && !$emailMatch && !$clubMatch) {
                                continue;
                            }
                        }
                        
                        echo "<tr>
                            <td>{$reg['name']}</td>
                            <td>{$reg['email']}</td>
                            <td>" . ucfirst($reg['club']) . " Club</td>
                            <td>{$reg['timestamp']}</td>
                        </tr>";
                        $displayedRegistrations++;
                    }
                    
                    if ($displayedRegistrations === 0) {
                        echo "<tr><td colspan='4' style='text-align: center;'>No registrations found" . 
                             (!empty($searchTerm) ? " matching '$searchTerm'" : "") . "</td></tr>";
                    }
                    
                echo "</table>
                
                <p style='margin-top: 20px;'><a href='index.html'>Register Another Student</a></p>
                <p><a href='process.php?clear=true'>Clear All Registrations</a></p>
            </div>
        </main>
        
        <footer>
            <p>&copy; 2024 Student Club Registration System</p>
        </footer>
    </body>
    </html>";
}


?>
