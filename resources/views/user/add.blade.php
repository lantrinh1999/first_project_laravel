@extends('layout.master')

{{-- page title --}}
@section('page_title')
@if (empty($user))
Add user
@else
Edit user
@endif
@endsection
{{-- {{ dd($user) }} --}}
@section('style')
<style>
    .btn-toggle.btn-lg:before {
        content: 'Khoá' !important ;
        left: -5rem !i\mportant;
    }

    .btn-toggle.btn-lg:after {
        content: 'Mở' !important;
        right: -5rem;
        opacity: 0.5;
    }

</style>
@endsection



@section('content')

<div class="box box-danger">
    <div class="box-header">
        <h3 class="box-title">
            <a class="btn btn-primary" href="{{ route('admin.user.list') }}">Back to List</a>


        </h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title=""
                data-original-title="Collapse">
                <i class="fa fa-minus"></i></button>
        </div>
    </div>
    <div class="box-body">
        <form action="{{ (!empty($user)) ? route('admin.user.saveEdit') : route('admin.user.saveAdd') }}" method="post">
            {{@csrf_field()}}
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input id="name"
                            value="{{ (old('name')) ? old('name') : ( !empty($user['name']) ? $user['name'] : '' ) }}"
                            type="text" class="form-control name" name="name">
                        @if (!empty($user))
                            <input type="hidden" name="id" value="{{ (!empty($user['id'])) ? $user['id'] : '' }}">
                        @endif
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Email</label>
                        <input id="name"
                            value="{{ (old('email')) ? old('email') : ( !empty($user['email']) ? $user['email'] : '' ) }}"
                            type="text" class="form-control name" name="email">
                        @error('email')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">password</label>
                        <input id="password" value="" type="password" class="form-control password" name="password">
                        @error('password')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Confirm password</label>
                        <input id="confirm_password" value="" type="password"
                            class="form-control confirm_password" name="confirm_password">
                        @error('confirm_password')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Trạng thái</label>
                        <button type="button"
                            class="btn btn-lg btn-toggle 
                            {{ (old('is_active') == 1) ? 'active' : (( !empty($user['is_active']) && $user['is_active']  == 1) ? 'active' : 'focus' ) }}
                             btn-status"
                            data-status="" data-toggle="button"
                            aria-pressed="
                            {{ (old('is_active') == 1) ? 'true' : (( !empty($user['is_active']) && $user['is_active'] == 1) ? 'true' : 'false' ) }}
                            "
                            autocomplete="off">
                            <div class="handle"></div>
                        </button>
                    </div>
                    <input type="hidden" name="is_active">
                    @error('status')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
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
<script>
    $(document).ready(function () {
        var status = $('.btn-status').attr('aria-pressed');
        console.log(status);
        if (status == 'true') {
            $('input[name=is_active]').val(1);
        } else {
            $('input[name=is_active]').val(0);
        }
        $('.btn-status').click(function () {
            // alert('ok');
            var status = $(this).attr('aria-pressed');
            // alert(status);
            if (status == 'true') {
                $('input[name=is_active]').val(0);
            } else {
                $('input[name=is_active]').val(1);
            }
        })
    })

</script>
@endsection
