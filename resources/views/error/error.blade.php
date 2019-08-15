@extends('layout.master')

{{-- page title --}}
@section('page_title')
ERROR
@endsection



@section('content')
@if (session('error'))
<div class="row">
    <div class="col-sm-12">
        <div class="alert alert-danger alert-dismissible show" role="alert">
            <strong>{{ session('error') }}</strong> 
        </div>
    </div>
</div>
@endif
@endsection

@section('js')

@endsection