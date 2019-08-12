@extends('layout.master')

{{-- page title --}}
@section('page_title')
@if (empty($product))
    Add Product
@else
    Edit Product
@endif
@endsection
{{-- {{ dd($product) }} --}}



@section('content')

<div class="box box-danger">
    <div class="box-header">
        <h3 class="box-title">
            <a class="btn btn-primary" href="{{ route('admin.product.list') }}">Back to List</a>


        </h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title=""
                data-original-title="Collapse">
                <i class="fa fa-minus"></i></button>
        </div>
    </div>
    <div class="box-body">
        <form action="{{ (!empty($product)) ? route('admin.product.saveEdit') : route('admin.product.saveAdd') }}" method="post">
            {{@csrf_field()}}

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input id="name" value="{{ (old('name')) ? old('name') : ( !empty($product['name']) ? $product['name'] : '' ) }}" type="text" class="form-control name" name="name">
                        <input type="hidden" name="id" value="{{ (!empty($product['id'])) ? $product['id'] : '' }}">
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="category_id">Category</label>
                        <select multiple name="category_id[]" id="category_id" class="form-control category_id select2">
                            @php
                                $arr = (old('category_id')) ? old('category_id') : ( !empty($product['category_id']) ? $product['category_id'] : [] );
                            @endphp
                            <option>---------</option>
                            @foreach ($categories as $item)
                            @php
                            $step = "";
                            if ($item['step'] > 0) {
                            
                            for ($i=0; $i < $item['step']; $i++) {
                                 $step .='--- ' ; 
                                } 
                            } 
                            @endphp 
                            <option {{ (in_array($item['id'], $arr)) ? 'selected' : '' }} value="{{ $item['id'] }}">{{ $step . $item['name'] }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input 
                        value="{{ (old('price')) ? old('price') : ( !empty($product['price']) ? $product['price'] : '' ) }}" 
                        min="0" 
                        type="number" 
                        name="price" 
                        class="form-control price" 
                        id="price">
                    @error('price')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                           <div class="form-group">
                               <label for="">Trạng thái</label>
                            <button type="button" 
                            class="btn btn-lg btn-toggle {{ (old('status') == 1) ? 'active' : (( !empty($product['status']) && $product['status']  == 1) ? 'active' : 'focus' ) }} btn-status" 
                            data-status="" data-toggle="button" 
                            aria-pressed="{{ (old('status') == 1) ? 'true' : (( !empty($product['status']) && $product['status'] == 1) ? 'true' : 'false' ) }}" 
                            autocomplete="off">
                                <div class="handle"></div>
                            </button>
                            </div>
                            <input  type="hidden" name="status">
                            @error('status')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror

                    
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="image">Thumbnail</label>
                        <input 
                        value="{{ (old('image')) ? old('image') : ( !empty($product['image']) ? $product['image'] : '' ) }}" 
                        readonly min="0" 
                        type="text" 
                        name="image" class="form-control image" id="thumbnail">
                    </div>
                    <button class="btn btn-primary choose_image" id="choose_image" type="button">Choose Image</button>
                    <br>
                    <div class=form-group>
                        <img style="width: auto; height: 110px; padding-top: 10px !important" id="this-img" src="{{ (old('image')) ? old('image') : ( !empty($product['image']) ? $product['image'] : '' ) }}" alt="">
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-sm-12">
                    <label for="editor">Description</label>
                     <textarea name="description" id="editor" 
                     class="form-control">{{ (old('description')) ? old('description') : ( !empty($product['description']) ? $product['description'] : '' ) }}</textarea>
                </div>
                
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <br>
                    <button class="btn btn-success" type="submit">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
<a href=""></a>

@section('add-product')
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script> CKEDITOR.replace('editor'); </script>
{{-- ******************************* --}}
@if ((old('image')))
    <script>
        $('img#this-img').show();
    </script>
@else
    @if (!empty($product['image']))
        <script>
            $('img#this-img').show();
        </script>
    @else
        <script>
            $('img#this-img').hide();
        </script>
    @endif
@endif
<script>
    var button1 = document.getElementById('choose_image');

    button1.onclick = function() {
        selectFileWithCKFinder( 'thumbnail' );
    };

    function selectFileWithCKFinder( elementId, elementImg ) {
        CKFinder.popup( {
            chooseFiles: true,
            width: 800,
            height: 600,
            onInit: function( finder ) {
                finder.on( 'files:choose', function( evt ) {
                    var file = evt.data.files.first();
                    var output = document.getElementById( elementId );
                    output.value = file.getUrl();
                    $('img#this-img').show();
                    $('img#this-img').attr('src', file.getUrl());
                } );

                finder.on( 'file:choose:resizedImage', function( evt ) {
                    var output = document.getElementById( elementId );
                    output.value = evt.data.resizedUrl;
                } );
            }
        } );
    }
</script> 
<script>

    $(document).ready(function(){
        var status = $('.btn-status').attr('aria-pressed');
        console.log(status);
            if (status == 'true') {
                $('input[name=status]').val(1); 
            } else {
                $('input[name=status]').val(0);
            }
        $('.btn-status').click(function(){
            // alert('ok');
            var status = $(this).attr('aria-pressed');
            // alert(status);
            if (status == 'true') {
                $('input[name=status]').val(0); 
            } else {
                $('input[name=status]').val(1);
            }
        })
    })

</script>
@endsection
