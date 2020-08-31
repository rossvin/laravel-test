@extends('frontend.layout')

@section('main')

<div class="page_title">
	{!! $page->name !!}
</div>
{!! $page->body !!}

@endsection