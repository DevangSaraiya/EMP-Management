<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}">

    <!-- SEO Meta Tags -->
    <meta name="description" content="Manage employee records efficiently with our Employee Management System. Filter, search, and organize employee data seamlessly.">
    <meta name="keywords" content="Employee Management, Employee Records, Employee Database, Search Employees, Employee Filter, Employee Administration, HR Management">
    <meta name="author" content="Employee Management">
    <meta name="robots" content="index, follow"> <!-- Allow search engines to index the page -->

    <!-- Open Graph Meta Tags for better social media sharing -->
    <meta property="og:title" content="Employee Management - Search and Filter Employee Records">
    <meta property="og:description" content="Efficiently manage employee records with advanced search and filtering options. Organize and access employee data in real-time.">
    <meta property="og:image" content="./images/logo-image.jpg"> <!-- Add a relevant image URL -->
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="{{env('APP_URL')}}"> <!-- Domain -->

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="Efficiently manage employee records with advanced search and filtering options. Organize and access employee data in real-time.">
    <meta name="twitter:title" content="Employee Management - Search and Filter Employee Records">
    <meta name="twitter:description" content="Efficiently manage employee records with advanced search and filtering options. Organize and access employee data in real-time.">
    <meta name="twitter:image" content="./images/twitter-logo-image.jpg"> <!-- Add a relevant image URL -->

    <title>Filter and Search Page - Employee Management</title>

    <!-- Bootstrap 5 CDN Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- Additional Styles -->
    <style>
        header {
            background-color: #4CAF50;
            padding: 15px;
        }
        header a {
            color: white;
            font-weight: bold;
            text-decoration: none;
            margin: 0 15px;
        }
        .filter-container input {
            margin-bottom: 10px;
        }
        .reset-button {
            background-color: #f44336;
        }
        .reset-button:hover {
            background-color: #e53935;
        }
    </style>

    <!-- Structured Data for Employee Management (JSON-LD) -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebPage",
      "name": "Employee Management - Search and Filter Employee Records",
      "description": "Manage and organize employee records efficiently with advanced filtering and search capabilities.",
      "url": "{{ url()->current() }}",
      "mainEntity": {
        "@type": "Organization",
        "name": "{{env('APP_NAME')}}",
        "url": "{{env('APP_URL')}}",
        "logo": "./images/logo-image.jpg"
      }
    }
    </script>

</head>
<body>
    {{-- Header Section --}}
    @include("layout.header")

    {{-- All the contents here --}}
    @yield("content")

    <!-- Bootstrap 5 JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @yield("jsSection")
</body>
</html>

