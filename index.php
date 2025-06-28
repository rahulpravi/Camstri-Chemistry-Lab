<?php
// Define site-wide constants
define('SITE_NAME', 'Camstri Chemistry Lab');
define('SITE_EMAIL', 'info@camstrichemlab.edu');
define('CURRENT_YEAR', date('Y'));

// Basic contact form handling
$contact_response = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'])) {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

    if ($name && $email && $subject && $message) {
        // Email setup (requires mail server configuration)
        $to = SITE_EMAIL;
        $headers = "From: $email\r\nReply-To: $email\r\n";
        $body = "Name: $name\nEmail: $email\nSubject: $subject\nMessage:\n$message";
        if (mail($to, $subject, $body, $headers)) {
            $contact_response = '<p style="color: green;">Message sent successfully!</p>';
        } else {
            $contact_response = '<p style="color: red;">Failed to send message. Please try again later.</p>';
        }
    } else {
        $contact_response = '<p style="color: red;">All fields are required.</p>';
    }
}

// Define team and instrument data
$team = [
    [
        'name' => 'Dr. Emily Rodriguez',
        'role' => 'Postdoctoral Fellow',
        'description' => 'Focuses on environmental chemistry and pollution remediation.',
        'image' => 'https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?ixlib=rb-4.0.3&auto=format&fit=crop&w=1374&q=80',
        'alt' => 'Dr. Emily Rodriguez, Postdoctoral Fellow at Camstri Chemistry Lab',
        'email' => 'erodriguez@camstrichemlab.edu',
        'cv' => '/cv/emily-rodriguez.pdf'
    ],
    [
        'name' => 'Dr. Sarah Johnson',
        'role' => 'Principal Investigator',
        'description' => 'Expert in organic synthesis with 15+ years of research experience.',
        'image' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-4.0.3&auto=format&fit=crop&w=1376&q=80',
        'alt' => 'Dr. Sarah Johnson, Principal Investigator at Camstri Chemistry Lab',
        'email' => 'sjohnson@camstrichemlab.edu',
        'cv' => '/cv/sarah-johnson.pdf'
    ],
    [
        'name' => 'Dr. Michael Chen',
        'role' => 'Senior Researcher',
        'description' => 'Specializes in analytical chemistry and method development.',
        'image' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&auto=format&fit=crop&w=1374&q=80',
        'alt' => 'Dr. Michael Chen, Senior Researcher at Camstri Chemistry Lab',
        'email' => 'mchen@camstrichemlab.edu',
        'cv' => '/cv/michael-chen.pdf'
    ],
    [
        'name' => 'Dr. Aisha Khan',
        'role' => 'Research Associate',
        'description' => 'Expert in materials science with a focus on sustainable polymers.',
        'image' => 'https://images.unsplash.com/photo-1607746882042-944635dfe10e?ixlib=rb-4.0.3&auto=format&fit=crop&w=1376&q=80',
        'alt' => 'Dr. Aisha Khan, Research Associate at Camstri Chemistry Lab',
        'email' => 'akhan@camstrichemlab.edu',
        'cv' => '/cv/aisha-khan.pdf'
    ]
];

$students = [
    ['name' => 'Alex Turner', 'role' => 'PhD Candidate'],
    ['name' => 'Priya Patel', 'role' => 'PhD Candidate'],
    ['name' => 'James Wilson', 'role' => 'MSc Student'],
    ['name' => 'Sophia Kim', 'role' => 'MSc Student'],
    ['name' => 'David Zhang', 'role' => 'MSc Student'],
    ['name' => 'Lina Gupta', 'role' => 'MSc Student']
];

$instruments = [
    ['icon' => 'fas fa-chart-line', 'name' => 'HPLC System', 'description' => 'High-performance liquid chromatography for precise separation and analysis of complex mixtures.'],
    ['icon' => 'fas fa-fire', 'name' => 'GC-MS', 'description' => 'Gas chromatography-mass spectrometry for volatile compound identification and quantification.'],
    ['icon' => 'fas fa-atom', 'name' => 'NMR Spectrometer', 'description' => '400 MHz nuclear magnetic resonance spectrometer for molecular structure determination.'],
    ['icon' => 'fas fa-lightbulb', 'name' => 'UV-Vis Spectrophotometer', 'description' => 'Ultraviolet-visible spectroscopy for absorption measurements across a wide wavelength range.'],
    ['icon' => 'fas fa-temperature-high', 'name' => 'DSC', 'description' => 'Differential scanning calorimeter for thermal analysis of materials.'],
    ['icon' => 'fas fa-vial', 'name' => 'FTIR Spectrometer', 'description' => 'Fourier-transform infrared spectroscopy for functional group analysis.']
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Camstri Chemistry Lab is dedicated to advancing chemical sciences through innovative research and collaboration.">
    <meta name="keywords" content="chemistry, research, innovation, lab, science, Camstri">
    <meta name="author" content="<?php echo SITE_NAME; ?>">
    <meta property="og:title" content="<?php echo SITE_NAME; ?> | Innovating the Future of Chemistry">
    <meta property="og:description" content="Explore groundbreaking chemical research at Camstri Chemistry Lab.">
    <meta property="og:image" content="https://images.unsplash.com/photo-1532094349884-543bc11b234d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80">
    <meta property="og:url" content="https://www.camstrichemlab.edu">
    <title><?php echo SITE_NAME; ?> | Innovating the Future of Chemistry</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* [CSS remains unchanged from original HTML, included here for single-page structure] */
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            background-color: #f3f4f6;
            scroll-behavior: smooth;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }
        nav {
            background: linear-gradient(45deg, #2a2a72, #009ffd);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
            padding: 0.5rem 0;
            transition: background 0.3s ease;
        }
        nav .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }
        .nav-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            padding: 0.5rem 0;
        }
        nav .logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1.8rem;
            font-weight: 700;
            color: #ffffff;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        nav .logo:hover { color: #fff; }
        nav .logo i { color: #fff; font-size: 1.6rem; }
        nav .nav-menu { width: 100%; }
        nav .desktop-menu {
            display: none;
            justify-content: center;
            gap: 2rem;
            padding: 1rem 0;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
        nav .desktop-menu a {
            color: #ffffff;
            text-decoration: none;
            font-weight: 500;
            padding: 0.5rem 1rem;
            position: relative;
            transition: color 0.3s ease, transform 0.3s ease;
            outline: none;
        }
        nav .desktop-menu a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -2px;
            left: 50%;
            background-color: #fff;
            transition: width 0.3s ease, left 0.3s ease;
        }
        nav .desktop-menu a:hover::after { width: 100%; left: 0; }
        nav .desktop-menu a:hover { color: #fff; transform: translateY(-2px); }
        nav .desktop-menu a:focus {
            outline: 2px solid #fff;
            outline-offset: 2px;
            border-radius: 4px;
        }
        nav .mobile-menu-button {
            background: none;
            border: none;
            color: #ffffff;
            font-size: 0;
            cursor: pointer;
            padding: 0.6rem;
            border-radius: 0.3rem;
            display: flex;
            flex-direction: column;
            gap: 0.2rem;
            transition: background-color 0.3s ease;
            outline: none;
            -webkit-tap-highlight-color: transparent;
            -webkit-touch-callout: none;
            -webkit-user-select: none;
        }
        .mobile-menu-button span {
            width: 25px;
            height: 3px;
            background-color: #ffffff;
            transition: all 0.3s ease;
            border-radius: 2px;
        }
        .mobile-menu-button:hover { background-color: rgba(255, 255, 255, 0.15); }
        .mobile-menu-button[aria-expanded="true"] span:nth-child(1) {
            transform: translateY(8px) rotate(45deg);
        }
        .mobile-menu-button[aria-expanded="true"] span:nth-child(2) { opacity: 0; }
        .mobile-menu-button[aria-expanded="true"] span:nth-child(3) {
            transform: translateY(-8px) rotate(-45deg);
        }
        .mobile-menu-button:focus {
            outline: 2px solid #fff;
            outline-offset: 2px;
            border-radius: 4px;
        }
        nav .mobile-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s ease-out;
            background: linear-gradient(45deg, #2a2a72, #009ffd);
            padding: 0.8rem 0;
            -webkit-overflow-scrolling: touch;
        }
        nav .mobile-menu.open { max-height: 300px; }
        nav .mobile-menu .menu-items {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            padding: 0 1rem;
        }
        nav .mobile-menu a {
            color: #ffffff;
            text-decoration: none;
            font-weight: 500;
            padding: 0.6rem 1rem;
            border-radius: 0.3rem;
            transition: background-color 0.3s ease;
            outline: none;
            -webkit-tap-highlight-color: transparent;
            -webkit-touch-callout: none;
            -webkit-user-select: none;
        }
        nav .mobile-menu a:hover {
            background-color: rgba(255,255,255,0.2);
            color: #fff;
        }
        nav .mobile-menu a:focus {
            outline: 2px solid #fff;
            outline-offset: 2px;
            border-radius: 4px;
        }
        @media (max-width: 767px) {
            nav .mobile-menu-button, nav .mobile-menu a {
                -webkit-tap-highlight-color: transparent !important;
                -webkit-touch-callout: none !important;
                -webkit-user-select: none !important;
                tap-highlight-color: transparent !important;
            }
            nav .mobile-menu { -webkit-transform: translateZ(0); }
            nav .mobile-menu-button:focus, nav .mobile-menu a:focus {
                outline: none !important;
                box-shadow: none !important;
            }
        }
        @media (min-width: 768px) {
            nav .container { flex-direction: row; justify-content: space-between; }
            nav .nav-header { padding: 0; }
            nav .desktop-menu { display: flex; }
            nav .mobile-menu-button, nav .mobile-menu { display: none; }
        }
        @media (min-width: 1024px) {
            nav .container { padding: 0 2rem; }
            nav .desktop-menu a { padding: 0.5rem 1.2rem; }
        }
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1532094349884-543bc11b234d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: #ffffff;
            padding: 5rem 1rem;
            text-align: center;
        }
        @media (min-width: 768px) { .hero-section { padding: 8rem 1rem; } }
        .hero-section h1 {
            font-size: 2.25rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 1.5rem;
        }
        @media (min-width: 768px) { .hero-section h1 { font-size: 3.75rem; } }
        .hero-section p {
            font-size: 1.25rem;
            color: #ffffff;
            margin-bottom: 2rem;
            max-width: 48rem;
            margin-left: auto;
            margin-right: auto;
        }
        @media (min-width: 768px) { .hero-section p { font-size: 1.5rem; } }
        .hero-section .buttons {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            justify-content: center;
        }
        @media (min-width: 640px) { .hero-section .buttons { flex-direction: row; } }
        .hero-section .buttons a {
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 500;
            text-decoration.3s ease;
        }
        .hero-section .buttons .primary {
            background-color: #2563eb;
            color: #ffffff;
        }
        .hero-section .buttons .primary:hover { background-color: #1d4ed8; }
        .hero-section .buttons .secondary {
            background-color: transparent;
            border: 2px solid #ffffff;
            color: #ffffff;
        }
        .hero-section .buttons .secondary:hover { background-color: #1e40af; }
        .about-section {
            padding: 5rem 1rem;
            background-color: #ffffff;
        }
        .section-title {
            text-align: center;
            margin-bottom: 4rem;
        }
        .section-title h2 {
            font-size: 1.875rem;
            font-weight: 900;
            color: #1e3a8a;
            margin-bottom: 1rem;
        }
        @media (min-width: 768px) { .section-title h2 { font-size: 2.25rem; } }
        .section-title .divider {
            width: 5rem;
            height: 0.25rem;
            background-color: #2563eb;
            margin: 0 auto 1.5rem;
        }
        .section-title p { color: #4b5563; max-width: 48rem; margin: 0 auto; }
        .about-grid { display: grid; gap: 2rem; }
        @media (min-width: 768px) { .about-grid { grid-template-columns: repeat(3, 1fr); } }
        .about-card {
            background-color: #eff6ff;
            padding: 1.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }
        .about-card:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            transform: translateY(-10px);
        }
        .about-card .icon {
            color: #2563eb;
            margin-bottom: 1rem;
            font-size: 2.5rem;
        }
        .about-card h3 {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1e3a8a;
            margin-bottom: 0.75rem;
        }
        .about-card p, .about-card ul { color: #4b5563; }
        .about-card ul {
            list-style: none;
            padding: 0;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        .research-section {
            padding: 5rem 1rem;
            background-color: #f9fafb;
        }
        .research-grid { display: grid; gap: 2rem; }
        @media (min-width: 768px) { .research-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (min-width: 1024px) { .research-grid { grid-template-columns: repeat(3, 1fr); } }
        .research-card {
            background-color: #ffffff;
            border-radius: 0.5rem;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .research-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        .research-card img { width: 100%; height: 12rem; object-fit: cover; }
        .research-card .content { padding: 1.5rem; }
        .research-card h3 {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1e3a8a;
            margin-bottom: 0.5rem;
        }
        .research-card p { color: #4b5563; margin-bottom: 1rem; }
        .research-card a {
            color: #2563eb;
            font-weight: 500;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .research-card a:hover { color: #1e40af; }
        .research-section .cta { text-align: center; margin-top: 3rem; }
        .research-section .cta a {
            background-color: #2563eb;
            color: #ffffff;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            text-decoration: none;
            font-weight: 500;
            transition: background-color 0.3s ease;
        }
        .research-section .cta a:hover { background-color: #1d4ed8; }
        .instruments-section {
            padding: 5rem 1rem;
            background-color: #ffffff;
        }
        .instruments-grid { display: grid; gap: 2rem; }
        @media (min-width: 768px) { .instruments-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (min-width: 1024px) { .instruments-grid { grid-template-columns: repeat(3, 1fr); } }
        .instrument-card {
            background-color: #f9fafb;
            padding: 1.5rem;
            border-radius: 0.5rem;
            border: 1px solid #e5e7eb;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }
        .instrument-card:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            transform: translateY(-10px);
        }
        .instrument-card .icon-wrapper {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }
        .instrument-card .icon {
            background-color: #dbeafe;
            padding: 0.75rem;
            border-radius: 50%;
            color: #2563eb;
            font-size: 1.25rem;
        }
 Odd job: .instrument-card h3 {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1e3a8a;
        }
        .instrument-card p { color: #4b5563; }
        .team-section {
            padding: 5rem 1rem;
            background-color: #1e3a8a;
            color: #ffffff;
        }
        .team-section .section-title p { color: #bfdbfe; }
        .team-grid { display: grid; gap: 2rem; }
        @media (min-width: 640px) { .team-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (min-width: 1024px) { .team-grid { grid-template-columns: repeat(3, 1fr); } }
        .team-card {
            background-color: #1e40af;
            border-radius: 0.5rem;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .team-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.2);
        }
        .team-card img { width: 100%; height: 16rem; object-fit: cover; }
        .team-card .content { padding: 1.5rem; }
        .team-card h3 {
            font-size: 1.25rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 0.75rem;
   