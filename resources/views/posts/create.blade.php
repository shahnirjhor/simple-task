@extends('layouts.app')
@section('one_page_js')
    <script src="{{ asset('plugins/custom/js/quill.js') }}"></script>
@endsection
@section('one_page_css')
    <link href="{{ asset('plugins/custom/css/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}" rel="stylesheet">
@endsection
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('posts.index') }}">@lang('Post List')</a></li>
                    <li class="breadcrumb-item active">@lang('Create Post')</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang('Add Post')</h3>
            </div>
            <form id="postCampaignForm" class="form-material form-horizontal" action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-form-label"><h4>@lang('Title') <b class="ambitious-crimson">*</b></h4></label>
                                <div class="input-group mb-3">
                                    <input type="text" id="title" name="title" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror" placeholder="@lang('Type Your Title')" required>
                                    @error('title')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-form-label"><h4>{{ __('Description') }}</h4></label>
                                <div id="input_description" class="@error('description') is-invalid @enderror description-min-height">
                                </div>
                                <input type="hidden" name="description" value="{{ old('description') }}" id="description">
                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                        </div>
                    </div>
                    @php
                    $roleName = Auth::user()->getRoleNames();
                    @endphp
                    @if($roleName['0'] == "Super Admin" || $roleName['0'] == "Premium")
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-form-label"><h4>@lang('Schedule')</h4></label><br/>
                                    <input name="schedule_type" value="now" id="schedule_now" class="@error('schedule_type') is-invalid @enderror" checked type="radio"> @lang('Now') &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input name="schedule_type" value="later" id="schedule_later" class="@error('schedule_type') is-invalid @enderror" type="radio"> @lang('Later')
                                    @error('schedule_type')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group schedule_block_item">
                                    <label>@lang('Schedule time')</label>
                                    <input placeholder="Time"  name="schedule_time" id="schedule_time" class="form-control flatpickr-date-time @error('schedule_time') is-invalid @enderror" type="text"/>
                                    @error('schedule_time')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input id="submit_campaign" type="submit" value="{{ __('Submit') }}" class="btn btn-outline btn-info btn-lg"/>
                                    <a href="{{ route('posts.index') }}" class="btn btn-outline btn-warning btn-lg float-right">{{ __('Cancel') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@include('script.posts.create.js')
@endsection
