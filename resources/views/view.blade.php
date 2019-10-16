@extends('layouts.site')

@section('navigation')	
	
	{!! $navigation !!}

@endsection


@if(isset($content))
	@section('content')	
		{!! $content !!}
	@endsection
@endif

@if(isset($addPhoto))
	@section('content')	
		{!! $addPhoto !!}
	@endsection
@endif


@section('footer')	
	
	{!! $footer !!}

@endsection