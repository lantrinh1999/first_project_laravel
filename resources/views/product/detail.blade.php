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
            <div class="col-sm-3 col-xs-3">
                <div class="img-responsive img-bordered">
                     <img width="100%" src="{{ ($product['image']) ? $product['image'] : 'https://x.kinja-static.com/assets/images/logos/placeholders/default.png' }}" alt="">
                </div>
            </div>
            <div class="col-sm-8 col-xs-8">
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

<div class="box box-primary">
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
                    <div class="col-xs-2 col-sm-2">
                        <div class="img-responsive img-bordered">
                            <img width="100%" src="https://alumni.crg.eu/sites/default/files/default_images/default-picture_0_0.png" alt="">
                        </div>
                    </div>
                    <div class="col-xs-10 col-sm-10 border-bottom border">
                        <div><h4>{{ $item->name }}</h4></div>
                        <div>{{ $item->content }}</div>
                        @if (Auth::user()->id == $item->user_id)
                        <br>
                            <div>
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal{{$key}}">
                                Sửa
                            </button>
                                <a url="{{route('admin.product.delete_comment',[ 'comment_id' => $item->id,'product' => $product['id']] )}}" href="javascript:;"
                                class="btn btn-danger btn-sm btn-remove" ">Xóa</a>
                        
                        </div>
                        @endif
                        
                    </div>
                    <div class="col-sm-12">
                        <hr> 
                    </div>
                    <div class="modal fade" id="exampleModal{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Sửa bình luận</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                 <form action="{{route('admin.product.edit_comment')}}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="modal-body">
                                    <input type="hidden" name="id" value="{{$item->id}}">
                                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                    <input type="hidden" name="product_id" value="{{$product['id']}}">
                                    <input type="text" name="content" class="form-control" value="{{$item->content}}">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <input type="submit" class="btn btn-primary" value="Edit">
                                    </div>
                                 </form>
                            </div>
                        </div>
                    </div>




                </div>
                    @endforeach
                @endif
                
            </div>
        </div>
    </div>
</div>

@endsection

