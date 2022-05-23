@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">

                         @if ($errors->any())
                          <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                <li> {{ $error }} </li>
                                @endforeach
                          </div>
                        @endif

                        <form action="{{ route('storeCategory') }}" method="POST" enctype="multipart/form-data">
                            @csrf 
                            <div class="form-group">
                                <label>Name</label><small>&nbsp;&nbsp;(Must more than 5 Characters)</small>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name')}}">
                            </div>

                            <div class="form-group">
                                <label>Image</label><small>&nbsp;&nbsp;(Must be JPG, PNG, and JPEG)</small>
                                <input type="file" class="form-control-file" name="image">
                            </div>

                            <button type="submit" class="btn btn-primary">Add Category</button>

                        </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection