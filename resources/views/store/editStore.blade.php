@extends('layouts.app')
@section('content')
<div class="container">
    <div>
        <div>
        </div>
    </div>
	<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="mx-auto d-flex justify-content-center mt-3">
                    <h3>Store Details</h3>
                    <div>
                        
                    </div>
                </div>
                <div class="mx-auto d-flex justify-content-center mt-3">
                    <img src="{{asset("/storage/".$data->image)}}" style="height:100px" alt="Store Image">
                </div>
                <div class="card-body">

                         @if ($errors->any())
                          <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                <li> {{ $error }} </li>
                                @endforeach
                          </div>
                        @endif

                        <div>
                        <form action="{{ route('updateStore', ['id' => $data->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Name</label><small>&nbsp;&nbsp;(Must more than 5 Characters)</small>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name')}}">
                            </div>
                            <div class="form-group">
                                <label>Address</label><small>&nbsp;&nbsp;(Must more than 10 Characters)</small>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="address" value="{{old('address')}}">
                            </div>
                            <div class="form-group">
                                <label>Description</label><small>&nbsp;&nbsp;(Must more than 20 Characters)</small>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="description" value="{{old('description')}}">
                            </div>
                            <div class="form-group">
                                <label>Image</label><small>&nbsp;&nbsp;(Must be JPG, PNG, and JPEG)</small>
                                <input type="file" class="form-control-file" name="image">
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Update Store</button>

                        
                        </form>
                    </div>
                        
                </div>
            </div>
        </div>
    </div>
</div>
@endsection