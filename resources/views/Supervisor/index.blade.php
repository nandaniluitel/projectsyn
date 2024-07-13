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
  <link rel="stylesheet" href="index.css">
  <link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css">
</head>

  <!-- Navbar -->
  @include('nav.create')
  @include('teachersidebar.create')
  <!-- Content Wrapper. Contains page content -->
  
    <!-- Content Header (Page header) -->
    <style>
  body {
  font-family: 'Arial', sans-serif;
  background-color: #f5f5f5;
  margin: 0;
  padding: 0;
}

.fullContainer {
  padding: 20px;
}

.fontforhead {
  text-align: center;
  margin: 50px;
  font-size: 2em;
  color: #008c9e; /* Adjusted to match the form's header color */
}

.landingCard {
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  margin-top: 50px;
}

.card {
  margin: 20px;
  padding: 20px;
  background-color: white;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  overflow: hidden;
  max-width: 300px;
  transition: transform 0.3s;
}

.card:hover {
  transform: translateY(-10px);
}

.cardMedia {
  width: 100%;
  height: 150px;
  object-fit: cover;
  border-bottom: 2px solid #ddd;
}

.cardContent {
  padding: 16px;
}

.cardTitle {
  margin: 0;
  font-size: 1.5em;
  font-weight: bold;
  color: #333;
}

.cardText {
  font-size: 1em;
  color: #666;
  margin: 10px 0;
}

.cardActions {
  text-align: right;
}

.cardBtn {
  background-color: #008c9e; /* Blue color for the button matching the form */
  color: white;
  border: none;
  padding: 10px 20px;
  cursor: pointer;
  border-radius: 5px;
  transition: background-color 0.3s;
}

.cardBtn:hover {
  background-color: #00677d; /* Darker blue on hover */
}


.header {
  background-color: #17a2b8; /* Teal color */
  color: white;
  padding: 20px;
  text-align: center;
  border-top-left-radius: 10px;
  border-top-right-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.header h1 {
  margin: 0;
  font-size: 2em;
}
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="header">
    <h1>Supervisor Page</h1>
  </div>
<div class="wrapper">
<div class="content-wrapper">
  <div class="fullContainer">
    
    <div class="landingCard">
      <div class="card">
        <img height="150px" width="200px" src="https://img.freepik.com/free-vector/online-image-upload-landing-page_23-2148282428.jpg?size=626&ext=jpg&ga=GA1.1.1700460183.1713398400&semt=ais" alt="Project Upload" class="cardMedia">
        <div class="cardContent">
          <h5 class="cardTitle"> View Assigned groups</h5>
          <p class="cardText">View Assigned groups with their Project names. </p>
        </div>
        <div class="cardActions">
        <a href="{{ route('Supervisor.assignedgroups') }}" class="cardBtn">Navigate</a>
        </div>
      </div>

      <div class="card">
        <img height="150px" width="200px" src="https://img.freepik.com/free-vector/online-image-upload-landing-page_23-2148282428.jpg?size=626&ext=jpg&ga=GA1.1.1700460183.1713398400&semt=ais" alt="Project Upload" class="cardMedia">
        <div class="cardContent">
          <h5 class="cardTitle">View Project Files</h5>
          <p class="cardText">View the necessary files uploaded by respective groups including proposal,slides and reports.</p>
        </div>
        <div class="cardActions">
        <button class="cardBtn">Navigate</button>
        </div>
      </div>
      <div class="card">
        <img height="150px" width="200px" src="https://img.freepik.com/free-vector/online-image-upload-landing-page_23-2148282428.jpg?size=626&ext=jpg&ga=GA1.1.1700460183.1713398400&semt=ais" alt="Project Upload" class="cardMedia">
        <div class="cardContent">
          <h5 class="cardTitle">Send finalized file</h5>
          <p class="cardText">Upload the finalized files here.This file will be sent to the coordinator ensuring that respective group is eligible for defence. Ensure all necessary documents are included before submission.</p>
        </div>
        <div class="cardActions">
          <button class="cardBtn">Navigate</button>
        </div>
      </div>
      <div class="card">
        <img height="150px" width="200px" src="https://img.freepik.com/free-vector/online-image-upload-landing-page_23-2148282428.jpg?size=626&ext=jpg&ga=GA1.1.1700460183.1713398400&semt=ais" alt="Project Upload" class="cardMedia">
        <div class="cardContent">
          <h5 class="cardTitle">Send Feedback to students</h5>
          <p class="cardText">Send necessary feedback to your Assigned group reagarding project.
        </div>
        <div class="cardActions">
        <a href="{{ route('Supervisor.assignedgroups') }}" class="cardBtn">Navigate</a>
        </div>
      </div>
      <div class="card">
        <img height="150px" width="200px" src="https://img.freepik.com/free-vector/online-image-upload-landing-page_23-2148282428.jpg?size=626&ext=jpg&ga=GA1.1.1700460183.1713398400&semt=ais" alt="Project Upload" class="cardMedia">
        <div class="cardContent">
          <h5 class="cardTitle">Upload Evaluation marks</h5>
          <p class="cardText">Upload your Evaluated marks of your respective group to Coordinator . Ensure all necessary documents are included before submission.</p>
        </div>
        <div class="cardActions">
          <button class="cardBtn">Navigate</button>
        </div>
      </div>
      <!-- <div class="card">
        <img height="150px" width="200px" src="https://img.freepik.com/free-vector/online-image-upload-landing-page_23-2148282428.jpg?size=626&ext=jpg&ga=GA1.1.1700460183.1713398400&semt=ais" alt="Project Upload" class="cardMedia">
        <div class="cardContent">
          <h5 class="cardTitle">Project Upload</h5>
          <p class="cardText">Upload your project files here. Ensure all necessary documents are included before submission.</p>
        </div>
        <div class="cardActions">
          <button class="cardBtn">Navigate</button>
        </div>
      </div> -->
    
            <!-- <div class="landingCard"  style="display: flex; margin-top:50px;">
            <div class="card" style="margin:20px;">
                <img height="100px" width="200px" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTfKKQjnQuDakncTZEjmrXZIWid1r-sx6ONfA&usqp=CAU" alt="View Profile" class="cardMedia">
                <div class="cardContent">
                    <h5 class="cardTitle">View Profile</h5>
                    <p class="cardText">View profile information. View your academic details, contact information, and other personal data.</p>
                </div>
                <div class="cardActions">
                    <button class="cardBtn">Navigate</button>
                </div>
            </div>
            <div class="card" style="margin:20px; padding:5px;">
                <img height="100px" width="200px" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTfKKQjnQuDakncTZEjmrXZIWid1r-sx6ONfA&usqp=CAU" alt="View Profile" class="cardMedia">
                <div class="cardContent">
                    <h5 class="cardTitle">View Profile</h5>
                    <p class="cardText">View profile information. View your academic details, contact information, and other personal data.</p>
                </div>
                <div class="cardActions">
                    <button class="cardBtn">Navigate</button>
                </div>
            </div>
            <div class="card" style="margin:20px;padding:5px;">
                <img height="150px" width="300px" style="display: block; margin: 0 auto;" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTfKKQjnQuDakncTZEjmrXZIWid1r-sx6ONfA&usqp=CAU" alt="View Profile" class="cardMedia">
                <div class="cardContent">
                    <h5 class="cardTitle">View Profile</h5>
                    <p class="cardText">View profile information. View your academic details, contact information, and other personal data.</p>
                </div>
                <div class="cardActions">
                    <button class="cardBtn">Navigate</button>
                </div>
            </div>
            
        </div> -->
            <!-- <div class="card" style="margin:20px;">
                <img  height="100px" width="200px" src="https://img.freepik.com/premium-vector/back-view-businessman-looking-question-marks_77417-1081.jpg" alt="View Marks" class="cardMedia">
                <div class="cardContent">
                    <h5 class="cardTitle">View Marks</h5>
                    <p class="cardText">Check your grades and feedback for all submitted assignments and projects. Stay updated with your academic progress.</p>
                </div>
                <div class="cardActions">
                    <button class="cardBtn">Navigate</button>
                </div>
            </div> -->
</div>

        <!-- <div class="aboutUsContainer">
            <div class="featuredSchoolsHeader">
                <h3>About Us</h3>
            </div>
            <p>Welcome to our platform, a dedicated space designed to streamline the project submission and grading process for students and teachers alike. Our mission is to facilitate seamless interaction between students and educators, enhancing the learning experience through efficient project management and evaluation. From the moment students upload their projects to the time teachers provide their feedback and grades, we are here to support and simplify every step of the educational journey. We believe that a robust educational platform empowers both teaching and learning, and our goal is to provide the tools necessary to make managing educational tasks as straightforward as possible. Dive in and discover how easy and effective educational collaboration can be!</p>
        </div>
    </div> -->

<!-- jQuery -->
<script src="/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/adminlte/dist/js/adminlte.min.js"></script>
<!-- Page specific script -->
</body>
</html>
