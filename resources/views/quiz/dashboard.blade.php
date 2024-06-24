@extends('layouts.student.master')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Quiz</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Quiz</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-medal"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Score</span>
                <span class="info-box-number" id="score">0</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

 

        </div>
        <!-- /.row -->

        <!-- .row -->
        <div class="row">
            @foreach($categories as $cat)
            <div class="col-lg-6 col-6">
                <!-- small card -->
                <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$cat->title}}</h3>

                    <p></p>
                </div>
                
                <a href="quiz/{{$cat->title}}" class="small-box-footer">
                    Start quiz <i class="fas fa-arrow-circle-right"></i>
                </a>
                </div>
            </div>
            <!-- /.col -->
            @endforeach
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection