@extends('layouts.app')
@section('content')
<div class="container">
    @if(!$store)
        <div class="d-flex justify-content-center">
            <div>
                <a href="{{route('addStore')}}" class="btn btn-primary">Create Store</a>
            </div>
        </div>
    @else
    <div>
        <h1 class="display-4" style="font-size:2em">Your Store page</h1>
        <h2 class="display-4" style="font-size:1.5em">Welcome, {{$store->name}}</h2>
        <div class="row">
            <div class="col-md-1">
                <img src="{{asset("/storage/".$store->image)}}" class="" style="height:50px;" alt="Store Image">
            </div>
            <div class="col-md-8" style="margin-left:-30px;">
                <p class="" style="font-size: 2em;">{{$store->name}}</p>
            </div>
            <div class="col-md-3" style="float:right">
                <a class="btn btn-primary" href="{{'/addClothes?id='.$store->id}}"  style="float: right">Add Item</a>
            </div>
        </div>     
    </div>
        <div class="row">
            @foreach($clothes as $cloth)
            <div class="col-md-2.5" style="width:20%">
                <div class="card mx-auto" style="width: 10rem; height:100%">
                  <img src="{{asset("/storage/".$cloth->image)}}" class="card-img-top" alt="{{$cloth->name}}">
                  <div class="card-body">
                    <h5 class="card-title d-flex justify-content-center">{{$cloth->name}}</h5>
                    <p class="card-text d-flex justify-content-center">Stock : {{$cloth->stock}} item(s)</p>
                    <p class="card-text d-flex justify-content-center">{{$cloth->description}}</p>
                    <p class="card-text d-flex justify-content-center">Rp. {{number_format($cloth->price,0,'','.')}}</p>
                    <div class="d-flex justify-content-center">
                        <a class="btn btn-primary" href="{{'/editClothes?clothes_id='.$cloth->id.'&store_id='.$store->id}}" style="">Update</a>
                    </div>
                    <div class="d-flex justify-content-center" style="margin-top:15px">
                        <form action="{{route('deleteClothes',['id'=>$cloth->id])}}" method="POST" >
                            @csrf
                            <button class="btn btn-danger" href="#"  style="" type="submit">Delete</button>
                        </form>  
                    </div>
                  </div>
                </div>
            </div>
            @endforeach    
        </div>
        <div class="d-flex justify-content-center py-4">
            <a class="btn btn-primary" href="{{'/editStore?store_id='.$store->id.'&user_id='.$user->id}}"  style="">Update Store</a>
        </div>
        <div class="d-flex justify-content-center" style="margin-top:15px">
            <form action="{{route('deleteStore',['id'=>$store->id])}}" method="POST" >
                @csrf
                <button class="btn btn-danger" href="#"  style="" type="submit">Delete</button>
            </form>  
        </div>
        @endif
        {{--<div class="mx-auto d-flex justify-content-center mt-3" style="">
        {{$clothes->appends(request()->input()
                )->links()}}
       </div>--}}
    </div>
</div>
@endsection