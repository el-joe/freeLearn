@extends('admin.layout.index')

@section('title', 'Lesson Exam')

@section('content')
    <form action="{{$action}}" method="POST" class="form-panel" enctype="multipart/form-data">
        @csrf
        <a href="javascript:" class="btn btn-primary col-sm-12" onclick="addNewQ()">New Question</a>
        <div class="questions">

        </div>

        <button type="submit" class="btn btn-primary">Save</button>

        <div class="modal fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                  
                </div>
              </div>
            </div>
          </div>
@endsection

@push('scripts')

<script>

    var state = {
        questions : @json($questions)
    };

    console.log(state.questions);

</script>

<script src="{{asset('js/pages/exam.js')}}"></script>

@endpush
