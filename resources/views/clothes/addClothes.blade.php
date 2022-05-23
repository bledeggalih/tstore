@extends('layouts.app')

@section('content')
<div class="container">
    <div>
        <h1 class="display-4" style="font-size:2em">Add Clothes</h1>
        <h2 class="display-4" style="font-size:1.5em">Add more clothes to your store!</h2>
    </div>
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

                        <form action="{{ route('storeClothes') }}" method="POST" enctype="multipart/form-data">

                            @csrf 

                            <div class="form-group">
                                <label>Name</label><small>&nbsp;&nbsp;(Must more than 5 Characters)</small>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name')}}">
                            </div>

                            <div class="form-group">
                            <label>Category</label>
                                <select class="form-control" name="category_id">
                                  @foreach($category as $categories)
                                    <option value="{{$categories->id}}"> {{$categories->name}} </option>
                                  @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Price</label><small>&nbsp;&nbsp;(Must more than Rp.20.000)</small>
                                <input type="number" min="20000" class="form-control @error('name') is-invalid @enderror" name="price" value="{{old('price')}}" required>
                            </div>

                            <div class="form-group">
                                <label>Stock</label><small>&nbsp;&nbsp;(Must more than 1 Item)</small>
                                <input type="number" min="1" class="form-control @error('name') is-invalid @enderror" name="stock" value="{{old('stock')}}">
                            </div>


                            <div class="form-group">
                                <label>Description</label><small>&nbsp;&nbsp;(Must more than 20 Characters)</small>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="description" value="{{old('description')}}">
                            </div>

                            <div class="form-group">
                                <label>Image</label><small>&nbsp;&nbsp;(Must be JPG, PNG, and JPEG)</small>
                                <input type="file" class="form-control-file" name="image">
                            </div>

                            <input type="hidden" name="store_id" value="{{app('request')->input('id')}}">

                            <button type="submit" class="btn btn-primary">Submit</button>

                        </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection