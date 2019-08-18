


@extends('layout.master')

{{-- page title --}}
@section('page_title')
List category
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
            <a class="btn btn-primary" href="{{ route('admin.category.add') }}">New category</a>


        </h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title=""
                data-original-title="Collapse">
                <i class="fa fa-minus"></i></button>
        </div>
    </div>
    <div class="box-body">
        <div class="table-responsive">
            <table id="category-table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Parent</th>
                        {{-- <th>Created at</th> --}}
                        <th>Action</th>
                    </tr>
                </thead>
                
            </table>
        </div>
    </div>
</div>

@endsection


@section('js')
<script>

$(function() {
    var table = $('#category-table').DataTable({
        processing: true,
        serverSide: true,
        "language": {
            "lengthMenu": "Hiển thị _MENU_ bản ghi trên trang",
            "zeroRecords": "Không có dữ liệu để hiển thị",
            "info": "Trang hiển thị _PAGE_ / _PAGES_",
            "infoEmpty": "Không có dữ liệu để hiển thị",
            "infoFiltered": "(được lọc từ _MAX_ tổng số hồ sơ)",
            "search": 'Tìm kiếm:   ',
            "paginate": {
                "first": "Trang đầu",
                "last": "Trang cuối",
                "next": "Trang sau",
                "previous": "Trang trước"
            },
        },
        keys: true,
        select: true,
        responsive: true,
        ajax: '{!! route('admin.category.data') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            // { data: 'parent_name', name: 'parent_name' },
            {data: null, render: function ( data, type, row ) {
                let step = '';
                if (data.step > 0) {
                    for (let index = 0; index < data.step; index++) {
                        step += "----- ";
                    }
                }
                return `<span>`+(data.parent_name != null ? step + data.parent_name : '')+`</span>`;
                } 
            },
            // { data: 'created_at', name: 'created_at' },
            {data: null, render: function ( data, type, row ) {
                return `
                <a class="btn btn-xs btn-warning" value=`+data.id+` href="/admin/category/edit/${data.id}">Edit</a>
                <a url="/admin/category/delete/${data.id}" class="btn btn-xs btn-danger btn-remove" href="javascript:;">Delete</a>`;
                } 
            },
        ]
    });

});
</script>
@endsection