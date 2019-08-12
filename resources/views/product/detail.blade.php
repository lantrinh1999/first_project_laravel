@extends('layout.master')

{{-- page title --}}
@section('page_title')
Product detail
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
        <div class="row">
            <div class="col-sm-5 col-xs-5">
                <div class="img-responsive img-bordered">
                     <img width="100%" src="{{ ($product['image']) ? $product['image'] : 'https://x.kinja-static.com/assets/images/logos/placeholders/default.png' }}" alt="">
                </div>
            </div>
            <div class="col-sm-7 col-xs-7">
                <div class="card card-group">
                    <div class="card-body">
                        <div>
                            <h3>{{ ($product['name']) ? $product['name'] : '' }}</h3>
                        </div>
                        <div>
                            <h4>Price: <strong>{{ ($product['price']) ? number_format($product['price'])  : '' }}</strong></h4>
                        </div>
                        <div>
                            <div>Description:</div>
                            @php
                                echo ($product['description']) ? trim($product['description'])  : ''
                            @endphp
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    </div>
</div>

<div class="box box-primary collapsed-box">
    <div class="box-header">
        <h3 class="box-title border-bottom">
            Comments
        </h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title=""
                data-original-title="Collapse">
                <i class="fa fa-minus"></i></button>
        </div>
    </div>
    <div class="box-body">
        
        <div class="row">
            <div class="col-sm-8">
                <form action="{{ route('admin.product.postComment') }}" method="post">
                    {{ @csrf_field() }}
                    <div class="form-group">
                        @error('content')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <input type="hidden" name="id" value="{{ $product['id'] }}">
                        <textarea class="form-control" name="content" id="content" columns="4" rows="4"></textarea>
                        
                        </div>
                        <div class="form-group">
                
                        <button class="btn btn-foursquare" type="submit">Submit</button>
                        <br>
                    </div>
                </form>
            </div>
            <div class="col-sm-12">
                @if (!empty($comments))
                    @foreach ($comments as $key => $item)
                        <div class="row">
                    <div class="col-sm-2 col-xs-4">
                        <div class="img-responsive img-bordered">
                            <img width="100%" src="https://alumni.crg.eu/sites/default/files/default_images/default-picture_0_0.png" alt="">
                        </div>
                    </div>
                    <div class="col-sm-8 col-xs-8 border-bottom border">
                        <div><h4>{{ $item->name }}</h4></div>
                        <div>{{ $item->content }}</div>
                    </div>
                    <div class="col-sm-12">
                        <hr> 
                    </div>
                </div>
                    @endforeach
                @endif
                
            </div>
        </div>
    </div>
</div>

@endsection

