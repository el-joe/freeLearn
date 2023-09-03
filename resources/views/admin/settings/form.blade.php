@extends('admin.layout.index')

@section('title', 'Lessons')

@section('content')
    <form action="{{$action}}" method="POST" class="form-panel" enctype="multipart/form-data">
        @csrf
        @if($method == 'PUT')
            @method('PUT')
        @endif
        @foreach ($settings as $setting)
            <div class="form-group">
                <label for="{{$setting->column_name}}">{{$setting->title}}</label>
                @switch($setting->column_type)
                @case('text')
                    <input type="text" class="form-control" name="{{$setting->column_name}}" id="{{$setting->column_name}}" value="{{$setting->value}}" required>
                @break
                @case('textarea')
                    <textarea name="{{$setting->column_name}}" id="{{$setting->column_name}}" class="form-control" required>{!! $setting->value !!}</textarea>
                @break
                @case('url')
                    <input type="url" name="{{$setting->column_name}}" id="{{$setting->column_name}}" value="{{$setting->value}}" class="form-control" required>
                @break
                @case('file')
                    <input type="file" name="{{$setting->column_name}}" id="{{$setting->column_name}}" class="form-control">
                    @if($setting->file_path != '')
                        <img src="{{$setting->file_path}}" alt="File" height="50">
                    @endif
                @break
                @case('checkbox')
                    <input type="checkbox" name="{{$setting->column_name}}" id="{{$setting->column_name}}"  @if($setting->value == 1) checked @endif>
                @break
                @case('select')
                    <select name="{{$setting->column_name}}" id="{{$setting->column_name}}">
                        @foreach ($setting->column_data as $value)
                            <option value="{{$value}}" @if($setting->value == $value) selected @endif>{{$value}}</option>
                        @endforeach
                    </select>
                @break
                @case('radio')
                    @foreach ($setting->column_data as $value)
                        <input type="radio" name="{{$setting->column_name}}" id="{{$setting->column_name}}" @if ($setting->value == $value) checked @endif>
                    @endforeach
                @break
                @case('number')
                    <input type="number" name="{{$setting->column_name}}" id="{{$setting->column_name}}" value="{{$setting->value}}" class="form-control" required>
                @break
                @case('float')
                    <input type="number" name="{{$setting->column_name}}" id="{{$setting->column_name}}" value="{{$setting->value}}" class="form-control" required>
                @break
                @endswitch
            </div>
        @endforeach
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection

@push('scripts')

@endpush
