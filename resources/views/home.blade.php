@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                        <form method="post" action="{{route('upload-sitelist')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Upload updated sitelist</label>
                                <input type="file" name="sitelist" class="form-control-file" id="exampleFormControlFile1" required>
                            </div>
                            <button>Upload</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
