@extends('layout.master')

{{-- page title --}}
@section('page_title')
@if (empty($category))
Add Category
@else
Edit Category
@endif
@endsection
{{-- {{ dd($category) }} --}}



@section('content')

<div class="box box-danger">
    <div class="box-header">
        <h3 class="box-title">
            <a class="btn btn-primary" href="{{ route('admin.category.list') }}">Back to List</a>
        </h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title=""
                data-original-title="Collapse">
                <i class="fa fa-minus"></i></button>
        </div>
    </div>
    <div class="box-body">
        <form action="{{ (!empty($category)) ? route('admin.category.saveEdit') : route('admin.category.saveAdd') }}"
            method="post">
            {{@csrf_field()}}

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input id="name"
                            value="{{ (old('name')) ? old('name') : ( !empty($category['name']) ? $category['name'] : '' ) }}"
                            type="text" class="form-control name" name="name">
                        @if (!empty($category))
                            <input type="hidden" name="id" value="{{ (!empty($category['id'])) ? $category['id'] : '' }}">
                        @endif
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="parent_id">Parent Category</label>
                        <select name="parent_id" id="parent_id" class="form-control parent_id select2">
                            <option value="0" @if (empty($categories))
                                selected
                            @endif >KHÔNG</option>
                            @foreach ($categories as $item)
                            @php
                            $step = "";
                            if ($item['step'] > 0) {
                                // $flag = -1;
                            for ($i=0; $i < $item['step']; $i++) { $step .='----- ' ; } } 
                            @endphp 
                            <option @if (!empty($category))
                                {{ ($item['parent_id'] == $category['id'] || $item['id'] == $category['id'] ) ? 'disabled' : '' }}
                                {{ ($item['id'] == $category['parent_id']) ? 'selected' : '' }}
                            @endif  value="{{ $item['id'] }}">
                                {{ $step . $item['name'] }}</option>
                                @php
                                    
                                @endphp
                                @endforeach
                        </select>
                        @error('parent_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                

            </div>
            <div class="row">
                <div class="col-sm-12">
                    <label for="editor">Description</label>
                    <textarea name="description" id="editor"
                        class="form-control">{{ (old('description')) ? old('description') : ( !empty($category['description']) ? $category['description'] : '' ) }}</textarea>
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

@section('js')
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace('editor');

</script>


@endsection
