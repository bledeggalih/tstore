@extends('layouts.app')

@section('content')
<div class="container">
    <div>
        <h1 class="display-4" style="font-size:2em">Categories</h1>
        <h2 class="display-4" style="font-size:1.5em"></h2>
    </div>

    <div class="row justify-content-center">
        
        @foreach($data as $datas)

        <br>
        <div class="col-lg-12 mt-3" style="width: 100%;margin-top:auto;margin-bottom:auto;overflow: hidden;height: 300px"> 
            <div>
                <a href="{{'/category/'.$datas->name}}"><img class="card-img-top" src="{{asset("storage/".$datas->image)}}"> </a>
                <br>
                <form method="GET" action="{{'/category/'.$datas->name}}"><button class="btn btn-primary text-uppercase" href="#" style="position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);" type="submit">{{$datas->name}}</button></form>
                @if($admin)
                
                <div class="d-flex justify-content-center">
                    <a class="btn btn-primary" href="{{route('editCategory', ['id' => $datas->id])}}" style="position: absolute;top: 90%;left: 39%;width: 20%;transform: translate(-50%, -50%);">UPDATE</a>
                    <form method="POST" action="{{ route('deleteCategory', ['id' => $datas->id]) }}">
                        <a class="btn btn-danger" href="#" style="position: absolute;top: 90%;left: 61%;width: 20%;transform: translate(-50%, -50%);">DELETE</a>
                    </form>
                </div>
                @endif 
            </div>
        </div>
        <br>
        @endforeach
        

    </div>
    <div>
        <br><br>
    </div>
    @if($admin)
    <div class="d-flex justify-content-center">
        <a class="btn btn-primary" href="{{route('addCategory')}}">Add Cetegory</a>
    </div>
           
    @endif
</div>
@endsection