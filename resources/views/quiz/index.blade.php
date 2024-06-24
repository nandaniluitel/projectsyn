@extends('layouts.student.master')
<!-- Select2 -->
@section('pagecss')
  <link rel="stylesheet" href="/adminlte/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endsection
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
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active"><a href="/quiz">Quiz</a></li>
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
                <span class="info-box-text">Run Score</span>
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
          <div class="col-md-12">
            <!-- iCheck -->
            <form method="POST" class="form-horizontal">
            <div class="card card-success">
              <div class="card-header">
                <!-- <h3 class="card-title">iCheck Bootstrap - Radio Inputs</h3> -->
                 <h3 class="card-title"><span id="sn">{{$mcq->sn}}</span>) <span id="question">{{$mcq->question}}</h3>
              </div>
              <div class="card-body">
                <!-- Minimal style -->
                @csrf
                <div class="row">
                  <div class="col-sm-6">
                    <!-- radio -->
                    <div class="form-group clearfix">
                      <div class="icheck-primary d-inline">
                        <input type="radio" id="r1" name="choice" value="1">
                        <label for="r1" id="option1">{{$mcq->option1}}
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <!-- radio -->
                    <div class="form-group clearfix">
                      <div class="icheck-primary d-inline">
                        <input type="radio" id="r2" name="choice" value="2">
                        <label for="r2" id="option2">{{$mcq->option2}}</label>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-6">
                    <!-- radio -->
                    <div class="form-group clearfix">
                      <div class="icheck-primary d-inline">
                        <input type="radio" id="r3" name="choice" value="3">
                        <label for="r3" id="option3">{{$mcq->option3}}
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <!-- radio -->
                    <div class="form-group clearfix">
                      <div class="icheck-primary d-inline">
                        <input type="radio" id="r4" name="choice" value="4">
                        <label for="r4" id="option4">{{$mcq->option4}}</label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <input type="hidden" name="qid" id="qid" value="{{$mcq->id}}">
                <button type="submit" class="btn btn-info checkQuizAnswerBtn" >Set Answer</button>
              </div>
            </div>
            <!-- /.card -->
            </form>
            

            <!-- Bootstrap Switch -->
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Setting</h3>
              </div>
              <div class="card-body">
                <input type="checkbox" name="my-checkbox" checked data-bootstrap-switch>
                <input type="checkbox" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col (right) -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
@section('pagescript')
<!-- Bootstrap Switch -->
<script src="/adminlte/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })

  })

  $('.checkQuizAnswerBtn').click(function(e) {
    e.preventDefault(); 
    var formData = $(this).closest('form').serialize();
    var $button = $(this); 
    // Retrieve previous score
    var previousScore = parseInt($('#score').text());
    var csrfToken = '{{ csrf_token() }}'  ;
      $.ajax({
          url: '/answerQuizCheck',
          type: 'POST',
          data: formData,
          headers: {
              'X-CSRF-TOKEN': csrfToken
          },
          success: function(response) {
              // Handle success response
              // $button.hide();
              console.log(response);
              $('#question').text(response.nextq.question);
              $('#option1').text(response.nextq.option1);
              $('#option2').text(response.nextq.option2);
              $('#option3').text(response.nextq.option3);
              $('#option4').text(response.nextq.option4);
              
              // Update question ID
              $('#qid').val(response.nextq.id);
              $('#sn').text(response.nextq.sn);
              // Update score
              var newScore = previousScore + response.score;
              $('#score').text(newScore);
              $('input[type="radio"]').prop('checked', false);
          },
          error: function(xhr, status, error) {
              // Handle error
              console.error(xhr.responseText);
          }
      });
      // alert('hello');
    });
  
</script>
@endsection