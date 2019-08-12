@extends('layout.master')

{{-- page title --}}
@section('page_title')
List comment
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
            

        </h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title=""
                data-original-title="Collapse">
                <i class="fa fa-minus"></i></button>
        </div>
    </div>
    <div class="box-body">
        <div class="table-responsive">
            <table id="dataTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Product</th>
                        <th>Content</th>
                        <th>Created at</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($comments))
                    @foreach ($comments as $key => $item)
                    <tr>
                        <td>{{ $item->comment_id }}</td>
                        <td>{{ $item->user_name }}</td>
                        <td>{{ $item->product_name }}</td>
                        <td>{{ $item->content }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>
                            <a url="{{ route('admin.comment.delete', $item->comment_id) }}" class="btn btn-danger btn-xs btn-remove" href="javascript:;">Delete</a>
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
