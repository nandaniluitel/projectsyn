<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | General Form Elements</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="index.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  @include('nav.create')
  @include('teachersidebar.create')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="fullContainer">
        <div class="container">
            <main class="mainContent" style="background-image: url('background.jpg');">
                <div class="overlay"></div>
                <section class="hero">
                    <h2 class="heroTitle">Creating a smooth platform for your project.</h2>
                    <p class="heroText">
                        Connect with your school today. Start your application process in 4 steps.
                    </p>
                    <button class="heroBtn">Get Started</button>
                </section>
            </main>
        </div>
        <div class="landingCard">
            <div class="card">
                <img height='200px' width='400px' src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTfKKQjnQuDakncTZEjmrXZIWid1r-sx6ONfA&usqp=CAU" alt="View Profile" class="cardMedia">
                <div class="cardContent">
                    <h5 class="cardTitle">View Profile</h5>
                    <p class="cardText">View profile information. View your academic details, contact information, and other personal data.</p>
                </div>
                <div class="cardActions">
                    <button class="cardBtn">Navigate</button>
                </div>
            </div>
            <div class="card">
                <img height='200px' width='400px' src="https://img.freepik.com/free-vector/online-image-upload-landing-page_23-2148282428.jpg?size=626&ext=jpg&ga=GA1.1.1700460183.1713398400&semt=ais" alt="Project Upload" class="cardMedia">
                <div class="cardContent">
                    <h5 class="cardTitle">Project Upload</h5>
                    <p class="cardText">Upload your project files here. Ensure all necessary documents are included before submission.</p>
                </div>
                <div class="cardActions">
                    <button class="cardBtn">Navigate</button>
                </div>
            </div>
            <div class="card">
                <img height='200px' width='400px' src="https://img.freepik.com/premium-vector/back-view-businessman-looking-question-marks_77417-1081.jpg" alt="View Marks" class="cardMedia">
                <div class="cardContent">
                    <h5 class="cardTitle">View Marks</h5>
                    <p class="cardText">Check your grades and feedback for all submitted assignments and projects. Stay updated with your academic progress.</p>
                </div>
                <div class="cardActions">
                    <button class="cardBtn">Navigate</button>
                </div>
            </div>
        </div>
        <div class="aboutUsContainer">
            <div class="featuredSchoolsHeader">
                <h3>About Us</h3>
            </div>
            <p>Welcome to our platform, a dedicated space designed to streamline the project submission and grading process for students and teachers alike. Our mission is to facilitate seamless interaction between students and educators, enhancing the learning experience through efficient project management and evaluation. From the moment students upload their projects to the time teachers provide their feedback and grades, we are here to support and simplify every step of the educational journey. We believe that a robust educational platform empowers both teaching and learning, and our goal is to provide the tools necessary to make managing educational tasks as straightforward as possible. Dive in and discover how easy and effective educational collaboration can be!</p>
        </div>
    </div>

<!-- jQuery -->
<script src="/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/adminlte/dist/js/adminlte.min.js"></script>
<!-- Page specific script -->
<script>
    $(document).ready(function() {
        $('#submitBtn').click(function() {
            alert('Submitting form...'); // You can replace alert with any other method
        });
    });
</script>
<script>
    $(function() {
    var crnIndex = 1; // To ensure unique IDs for dynamically added fields

    // Function to add CRN field
    $('.addCrnField').click(function() {
        var newField = '<hr>'+
                       '<div class="form-group row">'+
                       '<label for="crn-' + crnIndex + '" class="col-sm-2 col-form-label">TEAM MEMBER CRN:</label>'+
                       '<div class="col-sm-10">'+
                       '<input type="number" class="form-control mb-2" name="crns[]" id="crn-' + crnIndex + '" placeholder="CRN (e.g., 020319)" required>'+
                       '</div>'+
                       '</div>'+
                       '<hr>';

        $('#maincard').append(newField);
        crnIndex++;
    });
});
</script>
</body>
</html>
