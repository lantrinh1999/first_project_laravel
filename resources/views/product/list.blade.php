@extends('layout.master')

{{-- page title --}}
@section('page_title')
List Product
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
            <a class="btn btn-primary" href="{{ route('admin.product.add') }}">New product</a>


        </h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title=""
                data-original-title="Collapse">
                <i class="fa fa-minus"></i></button>
        </div>
    </div>
    <div class="box-body">
        <div class="table-responsive">
            <table id="product-table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Created at</th>
                        <th>Action</th>
                    </tr>
                </thead>
                
            </table>
        </div>
    </div>
</div>

@endsection
<a href=""></a>

@section('datatable-product')
<script>

$(function() {
    var table = $('#product-table').DataTable({
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
        ajax: '{!! route('admin.product.data') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'price', name: 'price' },
            { data: 'listcategories', name: 'listcategories' },
            { data: 'created_at', name: 'created_at' },
            {data: null,
      render: function ( data, type, row ) {
          
        return `
        <a class="btn btn-xs btn-primary" value=`+data.id+` href="/admin/product/detail/`+data.id+`">View</a>
        <a class="btn btn-xs btn-warning" value=`+data.id+` href="/admin/product/edit/`+data.id+`">Edit</a>
        <a url="/admin/product/delete/`+data.id+`" class="btn btn-xs btn-danger btn-remove" href="javascript:;">Delete</a>`;

      } }
            
            
        ]
    });

});
</script>
@endsection