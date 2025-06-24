<?php
include_once 'assets/conn/dbconnect.php';

// Login functionality
session_start();
if (isset($_SESSION['patientSession']) != "") {
    header("Location: patient/patient.php");
}

if (isset($_POST['login'])) {
    $icPatient = mysqli_real_escape_string($con, $_POST['icPatient']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $res = mysqli_query($con, "SELECT * FROM patient WHERE icPatient = '$icPatient'");
    $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
    
    if ($row && $row['password'] == $password) {
        $_SESSION['patientSession'] = $row['icPatient'];
        echo "<script>alert('Login successful! Redirecting to dashboard...'); window.location.href='patient/patient.php';</script>";
    } else {
        echo "<script>alert('Invalid credentials. Please try again.');</script>";
    }
}

// Registration functionality
if (isset($_POST['signup'])) {
    $patientFirstName = mysqli_real_escape_string($con, $_POST['patientFirstName']);
    $patientLastName = mysqli_real_escape_string($con, $_POST['patientLastName']);
    $patientEmail = mysqli_real_escape_string($con, $_POST['patientEmail']);
    $icPatient = mysqli_real_escape_string($con, $_POST['icPatient']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $month = mysqli_real_escape_string($con, $_POST['month']);
    $day = mysqli_real_escape_string($con, $_POST['day']);
    $year = mysqli_real_escape_string($con, $_POST['year']);
    $patientDOB = $year . "-" . $month . "-" . $day;
    $patientGender = mysqli_real_escape_string($con, $_POST['patientGender']);

    $query = "INSERT INTO patient (icPatient, password, patientFirstName, patientLastName, patientDOB, patientGender, patientEmail) 
              VALUES ('$icPatient', '$password', '$patientFirstName', '$patientLastName', '$patientDOB', '$patientGender', '$patientEmail')";
    $result = mysqli_query($con, $query);
    
    if ($result) {
        echo "<script>alert('Registration successful! Please login to continue.');</script>";
    } else {
        echo "<script>alert('Registration failed. User may already exist.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HealthCare Plus - Modern Medical Appointment System</title>
    
    <!-- Modern CSS Framework -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #0ea5e9;
            --accent-color: #06b6d4;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --dark-color: #1f2937;
            --light-color: #f8fafc;
            --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --gradient-secondary: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --gradient-accent: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            color: var(--dark-color);
            overflow-x: hidden;
        }

        /* Modern Navigation */
        .navbar-modern {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            padding: 1rem 0;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary-color) !important;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .navbar-brand img {
            width: 40px;
            height: 40px;
            border-radius: 8px;
        }

        .nav-link {
            font-weight: 500;
            color: var(--dark-color) !important;
            transition: all 0.3s ease;
            padding: 0.5rem 1rem !important;
            border-radius: 8px;
        }

        .nav-link:hover {
            color: var(--primary-color) !important;
            background: rgba(37, 99, 235, 0.1);
        }

        .btn-modern {
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary-modern {
            background: var(--gradient-primary);
            color: white;
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3);
        }

        .btn-primary-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.4);
            color: white;
        }

        .btn-outline-modern {
            background: transparent;
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
        }

        .btn-outline-modern:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.3;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            color: white;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            margin-bottom: 2rem;
            opacity: 0.9;
            font-weight: 400;
        }

        .appointment-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .appointment-card h3 {
            color: var(--dark-color);
            margin-bottom: 1.5rem;
            font-weight: 600;
        }

        .form-control-modern {
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
        }

        .form-control-modern:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
            outline: none;
        }

        .input-group-modern {
            position: relative;
            margin-bottom: 1rem;
        }

        .input-group-modern i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6b7280;
            z-index: 3;
        }

        .input-group-modern input {
            padding-left: 3rem;
        }

        /* Services Section */
        .services-section {
            padding: 5rem 0;
            background: var(--light-color);
        }

        .service-card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            border: 1px solid #e5e7eb;
            height: 100%;
        }

        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border-color: var(--primary-color);
        }

        .service-icon {
            width: 80px;
            height: 80px;
            background: var(--gradient-accent);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2rem;
            color: white;
        }

        .service-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--dark-color);
        }

        .service-description {
            color: #6b7280;
            line-height: 1.6;
        }

        /* Modal Styles */
        .modal-modern .modal-content {
            border-radius: 20px;
            border: none;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }

        .modal-modern .modal-header {
            border-bottom: 1px solid #e5e7eb;
            padding: 2rem 2rem 1rem;
        }

        .modal-modern .modal-body {
            padding: 1rem 2rem 2rem;
        }

        .modal-modern .modal-title {
            font-weight: 600;
            color: var(--dark-color);
        }

        /* Footer */
        .footer-modern {
            background: var(--dark-color);
            color: white;
            padding: 2rem 0;
            text-align: center;
        }

        .footer-modern a {
            color: var(--accent-color);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .footer-modern a:hover {
            color: white;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .hero-subtitle {
                font-size: 1.1rem;
            }
            
            .appointment-card {
                margin-top: 2rem;
            }
        }

        /* Animation Classes */
        .fade-in {
            animation: fadeIn 0.8s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .slide-in-left {
            animation: slideInLeft 0.8s ease-out;
        }

        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-50px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .slide-in-right {
            animation: slideInRight 0.8s ease-out;
        }

        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(50px); }
            to { opacity: 1; transform: translateX(0); }
        }
    </style>
</head>
<body>
    <!-- Modern Navigation -->
    <nav class="navbar navbar-expand-lg navbar-modern fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="assets/img/modern_logo.png" alt="HealthCare Plus">
                HealthCare Plus
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#services">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-modern btn-primary-modern ms-2" href="#" data-bs-toggle="modal" data-bs-target="#signupModal">
                            <i class="fas fa-user-plus"></i> Sign Up
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hero-content slide-in-left">
                        <h1 class="hero-title">Your Health, Our Priority</h1>
                        <p class="hero-subtitle">Book appointments with top doctors, manage your health records, and get the care you deserve - all in one modern platform.</p>
                        <div class="d-flex gap-3 flex-wrap">
                            <a href="#" class="btn btn-modern btn-primary-modern" data-bs-toggle="modal" data-bs-target="#signupModal">
                                <i class="fas fa-calendar-plus"></i> Book Appointment
                            </a>
                            <a href="#services" class="btn btn-modern btn-outline-modern">
                                <i class="fas fa-info-circle"></i> Learn More
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="appointment-card slide-in-right">
                        <h3><i class="fas fa-calendar-alt text-primary"></i> Quick Appointment</h3>
                        <p class="text-muted mb-4">Select a date to view available doctors and time slots</p>
                        
                        <div class="input-group-modern">
                            <i class="fas fa-calendar"></i>
                            <input type="date" class="form-control form-control-modern" id="appointmentDate" value="<?php echo date('Y-m-d'); ?>" onchange="showAvailableSlots(this.value)">
                        </div>
                        
                        <div id="availableSlots" class="mt-3">
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle"></i> Please login to view available time slots and book appointments.
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <button class="btn btn-modern btn-primary-modern w-100" data-bs-toggle="modal" data-bs-target="#loginModal">
                                <i class="fas fa-sign-in-alt"></i> Login to Book
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="services-section">
        <div class="container">
            <div class="text-center mb-5 fade-in">
                <h2 class="display-4 fw-bold mb-3">Our Medical Services</h2>
                <p class="lead text-muted">Comprehensive healthcare services with experienced professionals</p>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="service-card fade-in">
                        <div class="service-icon">
                            <i class="fas fa-brain"></i>
                        </div>
                        <h4 class="service-title">Neurology</h4>
                        <p class="service-description">Expert neurological care for brain and nervous system disorders with advanced diagnostic capabilities.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="service-card fade-in">
                        <div class="service-icon">
                            <i class="fas fa-heartbeat"></i>
                        </div>
                        <h4 class="service-title">Cardiology</h4>
                        <p class="service-description">Comprehensive heart care including preventive cardiology, diagnostics, and advanced treatment options.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="service-card fade-in">
                        <div class="service-icon">
                            <i class="fas fa-user-md"></i>
                        </div>
                        <h4 class="service-title">Dermatology</h4>
                        <p class="service-description">Complete skin care services from cosmetic treatments to medical dermatology procedures.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="service-card fade-in">
                        <div class="service-icon">
                            <i class="fas fa-female"></i>
                        </div>
                        <h4 class="service-title">Gynecology</h4>
                        <p class="service-description">Women's health services including routine care, family planning, and specialized treatments.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="service-card fade-in">
                        <div class="service-icon">
                            <i class="fas fa-x-ray"></i>
                        </div>
                        <h4 class="service-title">Radiology</h4>
                        <p class="service-description">State-of-the-art imaging services including MRI, CT scans, and digital X-rays.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="service-card fade-in">
                        <div class="service-icon">
                            <i class="fas fa-stethoscope"></i>
                        </div>
                        <h4 class="service-title">General Medicine</h4>
                        <p class="service-description">Primary healthcare services for routine check-ups, preventive care, and general medical consultations.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Login Modal -->
    <div class="modal fade modal-modern" id="loginModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-sign-in-alt text-primary"></i> Login to Your Account
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="">
                        <div class="input-group-modern">
                            <i class="fas fa-id-card"></i>
                            <input type="text" name="icPatient" class="form-control form-control-modern" placeholder="IC Number" required>
                        </div>
                        
                        <div class="input-group-modern">
                            <i class="fas fa-lock"></i>
                            <input type="password" name="password" class="form-control form-control-modern" placeholder="Password" required>
                        </div>
                        
                        <button type="submit" name="login" class="btn btn-modern btn-primary-modern w-100">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </button>
                    </form>
                    
                    <div class="text-center mt-3">
                        <p class="text-muted">Don't have an account? 
                            <a href="#" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#signupModal" class="text-primary">Sign up here</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Signup Modal -->
    <div class="modal fade modal-modern" id="signupModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-user-plus text-primary"></i> Create Your Account
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group-modern">
                                    <i class="fas fa-user"></i>
                                    <input type="text" name="patientFirstName" class="form-control form-control-modern" placeholder="First Name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group-modern">
                                    <i class="fas fa-user"></i>
                                    <input type="text" name="patientLastName" class="form-control form-control-modern" placeholder="Last Name" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input-group-modern">
                            <i class="fas fa-envelope"></i>
                            <input type="email" name="patientEmail" class="form-control form-control-modern" placeholder="Email Address" required>
                        </div>
                        
                        <div class="input-group-modern">
                            <i class="fas fa-id-card"></i>
                            <input type="text" name="icPatient" class="form-control form-control-modern" placeholder="IC Number" required>
                        </div>
                        
                        <div class="input-group-modern">
                            <i class="fas fa-lock"></i>
                            <input type="password" name="password" class="form-control form-control-modern" placeholder="Password" required>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <select name="month" class="form-control form-control-modern" required>
                                    <option value="">Month</option>
                                    <option value="01">January</option>
                                    <option value="02">February</option>
                                    <option value="03">March</option>
                                    <option value="04">April</option>
                                    <option value="05">May</option>
                                    <option value="06">June</option>
                                    <option value="07">July</option>
                                    <option value="08">August</option>
                                    <option value="09">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select name="day" class="form-control form-control-modern" required>
                                    <option value="">Day</option>
                                    <?php for($i = 1; $i <= 31; $i++): ?>
                                        <option value="<?php echo sprintf('%02d', $i); ?>"><?php echo $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select name="year" class="form-control form-control-modern" required>
                                    <option value="">Year</option>
                                    <?php for($i = 2010; $i >= 1950; $i--): ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Gender:</label>
                            <div class="d-flex gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="patientGender" value="male" required>
                                    <label class="form-check-label">Male</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="patientGender" value="female" required>
                                    <label class="form-check-label">Female</label>
                                </div>
                            </div>
                        </div>
                        
                        <button type="submit" name="signup" class="btn btn-modern btn-primary-modern w-100">
                            <i class="fas fa-user-plus"></i> Create Account
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer id="contact" class="footer-modern">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p>&copy; 2025 HealthCare Plus. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="adminlogin.php" class="me-3">
                        <i class="fas fa-user-shield"></i> Admin Login
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery.js"></script>
    
    <script>
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Show available slots function
        function showAvailableSlots(date) {
            const slotsDiv = document.getElementById('availableSlots');
            slotsDiv.innerHTML = `
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> Please login to view available time slots for ${date}.
                </div>
            `;
        }

        // Add loading animation to buttons
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function() {
                const submitBtn = this.querySelector('button[type="submit"]');
                if (submitBtn) {
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
                    submitBtn.disabled = true;
                }
            });
        });
    </script>
</body>
</html>

