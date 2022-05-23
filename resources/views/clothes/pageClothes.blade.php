@extends('layouts.app')
<style>
  a:hover{
    text-decoration: none;
  }
</style>
@section('content')
<div class="container">
    <div>
        <div class="row">
        	<div class="col-md-6">
            <h1 class="display-4" style="font-size:2em">Our {{collect(request()->segments())->last() }} Collection</h1>
            <h2 class="display-4" style="font-size:1.5em"></h2> 
          </div>
        	<div class="col-md-2">
        		<div class="dropdown" style="float:right">
        			<button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Categories</button>
        			<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
					    @foreach($category as $categories)
                <a class="dropdown-item" href="{{'/category/'.$categories->name}}">{{$categories->name}}</a>
              @endforeach
					</div>
        		</div>
            </div>
            <div class="col-md-4">
	            <form method="GET">
                <!-- search by clothes name / store name -->
	                <input value="{{isset($_GET['search']) ? $_GET['search'] : '' }}" type="text" name="search" placeholder="Search" class="form-control @error('name') is-invalid @enderror" style="width:70%">
	            </form>
        	</div>
        </div>
        @if(!$data)<div>Not found!</div>
    	@else
    	<div class="row">
    	@foreach($data as $datas)
          @if(!$datas)
            <div>Not found!</div>
          @else
	        <div class="col-lg-3.5 mt-3" style="flex:0 0 20%;max-width:20%;">
                <div class="card mx-auto" style="width: 10rem; height:100%;">
                  <a href="{{route('detailClothes', ['id' => $datas->id])}}"> <img class="card-img-top" src="{{asset("storage/".$datas->image)}}" style="color:black;text-decoration: none;">
                  <div class="card-body" style="color:black;text-decoration: none;">
                    <h5 class="card-title d-flex justify-content-center">{{$datas->name}}</h5>
                    <div class="d-flex justify-content-center"><img src="{{asset("/storage/".$datas->store->image)}}" style="height:20px;">&nbsp;&nbsp;{{$datas->store->name}}</div>
                    <p class="card-text d-flex justify-content-center">Rp. {{number_format($datas->price,0,'','.')}}</p>
                  </div></a>
                </div>
            </div>
            @endif
        @endforeach
		@endif
       </div>
       <div class="mx-auto d-flex justify-content-center mt-3" style="">
       	{{$data->appends(request()->input()
                )->links()}}
       </div>
   	</div>
</div>
@endsection


