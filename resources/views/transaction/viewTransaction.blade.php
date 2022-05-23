@extends('layouts.app')

@section('content')
<div class="container">
	<div class="">
		<h3 class="py-4">Transaction</h3>

		<div class="">
			@foreach($data as $datas)
			<div class="row py-4">
				<div class="col-md-10">
					<div>
						<h5>Transaction on <b>{{$datas->created_at->format('M d Y, H:i a')}}</b></h5>
					</div>
				</div>
				<div class="col-md-2">
					<div class="">
						<h5>By <b>{{$datas->user->name}}</b></h5>
					</div>
				</div><hr>
			</div>
			<div class="">
				<hr style="border-top: 3px dotted">
				{{--@foreach($detail as $details)--}}
				<div class="row mx-auto d-flex align-items-center py-4" style>
					<div class="col-md-3">
						{{$datas->clothes->name}}
					</div>
					<div class="col-md-3">
						@ Rp. {{number_format($datas->clothes->price,0,'',',')}}
					</div>
					<div class="col-md-3">
						Quantity: {{$datas->quantity}}
					</div>
					<div class="col-md-3">
						SubTotal:Rp. {{number_format($datas->clothes->price * $datas->quantity,0,'','.')}}
					</div>
				</div>
				{{--@endforeach--}}
			</div>
			@endforeach
		</div>
	</div>
</div>
@endsection