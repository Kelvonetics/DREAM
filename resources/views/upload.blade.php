@extends('layouts.base')


@section('content')

    <form action="{{url('/upload')}}" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
        <div class="form-group">
            <label for="upload_file">Upload</label>
            <input type="file" name="upload_file" class="form-control">
        </div>
        <input class="btn btn-success" type="submit" value="Upload File" name="submit">
    </form>

@endsection
