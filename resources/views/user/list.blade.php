@extends('layout.master')

{{-- page title --}}
@section('page_title')
List user
@endsection

@section('style')
    
@endsection



@section('content')
@if (session('success'))
<div class="row">
    <div class="col-sm-12">
        <div class="alert alert-success alert-dismissible show" role="alert">
            <strong>Thông báo!</strong> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
</div>
@endif
@if (session('error'))
<div class="row">
    <div class="col-sm-12">
        <div class="alert alert-warning alert-dismissible show" role="alert">
            <strong>Thông báo!</strong> {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
</div>
@endif
<div class="box box-danger">
    <div class="box-header">
        <h3 class="box-title">
            <a class="btn btn-primary" href="{{ route('admin.user.add') }}">New user</a>

        </h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title=""
                data-original-title="Collapse">
                <i class="fa fa-minus"></i></button>
        </div>
    </div>
    <div class="box-body">
        <div class="table-responsive">
            <table id="user-table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Active</th>
                        <th>Created at</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($users)
                        @foreach ($users as $key => $item)
                            <tr>
                            <td>{{$item['id']}}</td>
                            <td>{{$item['name']}}</td>
                            <td>{{$item['email']}}</td>
                            <td>{{$item['is_active'] == 1 ? 'Active' : 'Inactive'}}</td>
                            <td>{{$item['created_at']}}</td>
                            <td>
                            <a class="btn btn-warning btn-xs" href="{{ route('admin.user.edit', $item['id']) }}">Edit</a>
                            <a url="{{ route('admin.user.delete', $item['id']) }}" class="btn btn-danger btn-xs btn-remove" href="javascript:;">Delete</a>
                            </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
                
            </table>
        </div>
    </div>
</div>

@endsection

