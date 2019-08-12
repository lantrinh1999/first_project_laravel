@extends('layout.master')

{{-- page title --}}
@section('page_title')
Page Test
@endsection



@section('content')
<div class="box box-danger">
    <div class="box-header">
        <h3 class="box-title">
            Test
        </h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title=""
                data-original-title="Collapse">
                <i class="fa fa-minus"></i></button>
        </div>
    </div>
    <div class="box-body">

    </div>
</div>
@endsection
