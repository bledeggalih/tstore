@extends('layouts.app')

@section('content')
<div class="container">
    <div>
        <h1 class="display-4" style="font-size:2em">Welcome to TStore!</h1>
        <h2 class="display-4" style="font-size:1.5em">Our Clothes Categories:</h2>
    </div>
    <div class="row justify-content-center">

        {{--@if(!$data)
        <div>Category doesnt exist!</div>
        @else--}}
        @foreach($data as $datas)


        <div class="col-lg-12 mt-3" style="width: 100%;height: 200px;top:50%;overflow: hidden;"> 
            <div>
                <a href="{{'/category/'.$datas->name}}"> <img class="card-img-top" style="width:100%;" src="{{asset("storage/".$datas->image)}}"> </a>
                <br>
                <form method="GET" action="{{'/category/'.$datas->name}}"><button class="btn btn-primary" href="#" style="position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);" type="submit">{{$datas->name}}</button></form>
                
            </div>
        </div>
        @endforeach


<!-- {{--<a href="{{route('pageClothes', ['name' => $datas->name])}}"> <img class="card-img-top" style="width:100%;" src="{{asset("storage/".$datas->image)}}"> </a>--}}
 -->        <!--gajadi-->

        <!-- <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>-->
        {{--@endif--}}

    </div> 
</div>
@endsection
