@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach($data as $datas)
        <div class="col-lg-12 mt-3"> 
            <div class="container">
				<div class="row mx-auto d-flex align-items-center" style="top:50%">
					<div class="col-md-2">
						<img class="card-img-top" src="{{asset("storage/".$datas->clothes->image)}}">
					</div>
					<div class="col-md-2">
						<b>	{{$datas->clothes->name}} </b>
					</div>
					<div class="col-md-2">
						{{$datas->clothes->store->name}}
					</div>
					<div class="col-md-2">
						<div class="mx-auto d-flex align-items-center">Subtotal</div>
						Rp. {{number_format($datas->clothes->price * $datas->quantity,0,'','.')}}
					</div>
					<div class="col-md-3">
						<div>	
							<form class="form-group" style="" method="POST" action="{{route('updateCart', ['id' => $datas->id])}}">
								@csrf
								<div>
									Quantity :
									<input class="" name="quantity" type="number" min="1" max="{{$datas->clothes->stock}}" value="{{$datas->quantity}}" style="width:25%">

								</div>
								<button class="btn btn-info" style="color:white;margin-top:10px" type="submit">Update Quantity</button>
							</form> 
						</div>
						<div>
							
						</div>
						
					</div>
					<div class="col-md-1">
						<form method="POST" action="{{route('deleteCart', ['id' => $datas->id])}}">
							<!-- token -->
							@csrf
							<button class="btn btn-danger" type="submit">Delete Item</button>
						</form>
					</div>
				</div>
            </div>
        </div>
        @endforeach

    </div>
	
	@if($data->first() == null)
	<div>
		<div class="mx-auto d-flex justify-content-center">
			<h3>You don't have any cart for now!</h3>
		</div>
		<div class="d-flex justify-content-center"><a class="btn btn-primary" href="{{route('home')}}">View Clothes</a></div>
	</div>
	@else
	<div class="row justify-content-end">
		<div class="col-lg-12"><hr> </div>
		<div class="col-lg-2">
			Grand Total : <br>Rp. {{number_format($grandTotal,0,'','.')}}
		</div>
    </div>
    <div class="mx-auto d-flex justify-content-center">
		<div class=""  style="vertical-align: bottom;">
			<form method="POST" action="{{route('checkoutCart')}}">
				@csrf
				<input class="" name="subTotal" type="hidden" value="{{$grandTotal}}">
					<button class="btn btn-success" type="submit"> Checkout </button>
			</form>
		</div>
    </div>	
	@endif
</div>
@endsection