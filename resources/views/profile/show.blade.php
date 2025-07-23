<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Profile</title>
  <link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>.progress-bar{min-width:60px;font-weight:bold;}</style>
</head>
<body style="background:#f4f6f9;font-family:'Source Sans Pro',sans-serif;">

@include('nav.create')

{{-- correct sidebar --}}
@if($isTeacher)
  @include('teachersidebar.create')
@elseif($isStudent)
  @include('sidebar.create')
@endif

<div class="content-wrapper" style="margin:20px auto;max-width:900px;background:#fff;padding:20px;border-radius:10px;">

  {{-- Heading --}}
  <h1 class="text-center font-weight-bold mb-4">
    {{ $isTeacher ? 'User Profile' : 'User Profile' }}
  </h1>

  {{-- Flash --}}
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  {{-- Basic Info --}}
  <div class="profile-info border-top pt-4 text-center">
    <img src="{{ asset('images/' . ($user->Photo ?? 'images.png')) }}"
         class="rounded-circle"
         style="width:150px;height:150px;border:3px solid #007bff;"
         alt="User Photo">
    <p class="mt-3"><strong>Name:</strong>  {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Phone:</strong> {{ $user->Phone_number ?? 'N/A' }}</p>
  </div>

  {{-- TEACHER‐ONLY --}}
  @if($isTeacher)
    {{-- Role Badges --}}
    <div class="text-center mt-4">
      @forelse($roles as $role)
        <span class="badge badge-primary px-3 py-2">{{ ucfirst($role) }}</span>
      @empty
        <span class="text-muted">

        </span>
      @endforelse
    </div>

    {{-- Supervised Groups --}}
    @if(in_array('supervisor',$roles) && $supervisorGroups->count())
      <div class="mt-5">
        <h4 class="mb-3">Supervised Project Groups</h4>
        <ul class="list-group">
          @foreach($supervisorGroups as $g)
            <li class="list-group-item">
              <strong>{{ $g->title }}</strong> — Year: {{ $g->year }}, Level: {{ $g->level }}
            </li>
          @endforeach
        </ul>
      </div>
    @endif
    @if(empty($roles))
      <p class="text-center text-muted mt-5"></p>
    @endif
  @endif

  {{-- STUDENT‐ONLY PROJECT BLOCK --}}
  @if(isset($projects) && $projects->count())
    <div class="mt-5">
      <h4 class="mb-3">📊 Overall Project Progress</h4>
      @php $overallPercent = round(($completedLevels/$totalLevels)*100) @endphp
      <div class="progress mb-4" style="height:25px;">
        <div class="progress-bar bg-success" role="progressbar"
             style="width:{{ $overallPercent }}%;">
          {{ $overallPercent }}% ({{ $completedLevels }}/{{ $totalLevels }} Levels Completed)
        </div>
      </div>

      @foreach($projects as $project)
        @php $phases=['proposal','midterm','final'] @endphp
        <div class="card mb-4">
          <div class="card-header bg-primary text-white">
            <h5 class="mb-0">{{ $project->title }} — Level {{ $project->level }}</h5>
          </div>
          <div class="card-body">
            {{-- Slides & Report --}}
            <p><strong>Slides:</strong>
              @if($project->slides_file)
                <a href="{{ asset($project->slides_file) }}" target="_blank">View Slides</a>
              @else Not uploaded @endif
            </p>
            <p><strong>Report:</strong>
              @if($project->report_file)
                <a href="{{ asset($project->report_file) }}" target="_blank">View Report</a>
              @else Not uploaded @endif
            </p>

            {{-- Supervisor & Members --}}
            <p><strong>Supervisor:</strong> {{ $project->supervisorName }}</p>
            <p><strong>Group Members:</strong>
              @if($project->members->count())
                {{ $project->members->implode(', ') }}
              @else No other members @endif
            </p>

            {{-- Phases --}}
            <ul class="list-group mt-3">
              @foreach($phases as $phase)
                @php $eval = $project->phases[$phase] ?? null; @endphp
                <li class="list-group-item">
                  <strong>{{ ucfirst($phase) }}</strong><br>
                  <span class="badge badge-{{ $eval?->status==='approved'?'success':($eval?->status==='rejected'?'danger':'secondary') }}">
                    Status: {{ $eval->status ?? 'Not submitted' }}
                  </span>
                  <p class="mt-2 text-muted">🗨 Feedback: {{ $eval->feedback ?? 'No feedback' }}</p>

                  {{-- Marks only if viewer is teacher --}}
                  @if($isTeacher && $eval)
                    <div class="ml-3">
                      <strong>Marks:</strong><br>
                      Report: {{ $eval->reportMarks ?? '-' }}<br>
                      Presentation: {{ $eval->presentationMarks ?? '-' }}<br>
                      QA: {{ $eval->qaMarks ?? '-' }}<br>
                      Demo: {{ $eval->demoMarks ?? '-' }}
                    </div>
                  @endif
                </li>
              @endforeach
            </ul>

            {{-- Chart --}}
            <canvas class="level-graph mt-4"
                    id="chart-level-{{ $project->level }}-{{ $loop->index }}"
                    data-title="{{ $project->title }} — Level {{ $project->level }}"
                    data-proposal="{{ $project->phases['proposal']?->status==='approved'?1:0 }}"
                    data-midterm="{{ $project->phases['midterm']?->status==='approved'?1:0 }}"
                    data-final="{{ $project->phases['final']?->status==='approved'?1:0 }}">
            </canvas>
          </div>
        </div>
      @endforeach
    </div>
  @endif

</div>

<script src="/adminlte/plugins/jquery/jquery.min.js"></script>
<script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/adminlte/dist/js/adminlte.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function(){
  document.querySelectorAll('.level-graph').forEach(canvas=>{
    const ctx      = canvas.getContext('2d');
    const title    = canvas.dataset.title;
    const proposal = parseInt(canvas.dataset.proposal);
    const midterm  = parseInt(canvas.dataset.midterm);
    const final    = parseInt(canvas.dataset.final);
    new Chart(ctx,{
      type:'bar',
      data:{
        labels:['Proposal','Midterm','Final'],
        datasets:[{
          label:'Status',
          data:[proposal,midterm,final],
          backgroundColor:[
            proposal?'#28a745':'#dee2e6',
            midterm?'#ffc107':'#dee2e6',
            final?'#17a2b8':'#dee2e6'
          ]
        }]
      },
      options:{
        responsive:true,
        plugins:{
          legend:{display:false},
          title:{display:true,text:title}
        },
        scales:{
          y:{beginAtZero:true,max:1,ticks:{callback:v=>v===1?'Approved':''}}
        }
      }
    });
  });
});
</script>
  <script src="/adminlte/plugins/jquery/jquery.min.js"></script>
  <script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/adminlte/dist/js/adminlte.min.js"></script>
</body>
</html>
