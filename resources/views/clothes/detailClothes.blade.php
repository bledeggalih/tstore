@extends('layouts.app')

@section('content')
<div class="container">
	<h1 class="display-4" style="font-size:2em">Clothes Details</h1>
    <h2 class="display-4" style="font-size:1.5em"></h2>
    <div class="row py-4" style="margin-top: 50px;">
        <div class="col-lg-4">
            <img style="height: 250px" src="{{asset("storage/".$data->image)}}">
        </div>
        <div class="col-lg-8 mt-3" style="">
                <div class="" style="height:100%;">
                  <div class="" style="">
                    <div class="row" style="margin-top:2em">
                        <div class="col-md-2">
                            <p class="">Name: </p>
                            <p class="">Store: </p>
                            <p class="">Stock: </p>
                            <p class="">Price: </p>
                            <p class="">Description: </p>
                        </div>
                        <div class="col-md-4">
                            <p class="">{{$data->name}}</p>
                            <p class="">{{$data->store->name}}</p>
                            <p class="">{{$data->stock}} item(s) ready</p>
                            <p class="">Rp. {{number_format($data->price,0,'','.')}}</p>
                            <p class="">{{$data->description}}</p> 
                        </div>
                    </div>
                  </div>
                  <div class="">
                    <div>
                      <form action="{{route('storeCart')}}" method="POST" class="py-4">
                        <!-- buat token -->
                        @csrf 
                        <div>
                            {{--<input type="hidden" value="{{$data->id}}" name="clothes_id">--}}
                            {{--<input type="hidden" name="store_id" value="{{app('request')->input('id')}}">
                            <input type="hidden" name="clothes_id" value="{{app('request')->input('id')}}">--}}
                        </div>
                        <div class="form-group">
                            <h5>Add Cart</h5>
                            <label>Quantity</label><small>&nbsp;&nbsp;(Must more than 1 Item)</small>
                            <input type="number" min="1" max="{{$data->stock}}" class="form-control" name="quantity" value="1" style="width:150px">
                            <input type="hidden" value="{{$data->id}}" name="clothes_id">
                            <input type="hidden" name="stock" value="{{$data->stock}}">
                        </div>
                        @if(!auth()->user()->id)
                            <button class="btn btn-primary btn-disabled" disabled>Login first!</button>
                        @else
                            <button type="submit" class="btn btn-primary">Add Cart</button>
                        @endif
                      </form>
                    </div>
                    <div>
                    </div>
                  </div>
                </div>
            </div>
    </div>
</div>
@endsection