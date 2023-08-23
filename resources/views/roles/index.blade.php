@extends('layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('posts.index') }}">@lang('Posts')</a></li>
                    <li class="breadcrumb-item active">{{ __('Plan List') }}</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('Plan List') }}</h3>
                <div class="card-tools">
                    <button class="btn btn-default" data-toggle="collapse" href="#filter"><i class="fas fa-filter"></i> @lang('Filter')</button>
                </div>
            </div>
            <div class="card-body">
                <div id="filter" class="collapse @if(request()->isFilterActive) show @endif">
                    <div class="card-body border">
                        <form action="" method="get" role="form" autocomplete="off">
                            <input type="hidden" name="isFilterActive" value="true">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>@lang('Plan Name')</label>
                                        <input type="text" name="name" class="form-control" value="{{ request()->name }}" placeholder="@lang('Plan Name')">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>@lang('Plan For')</label>
                                        <select class="form-control" name="role_for">
                                            <option value="">--@lang('Select')--</option>
                                            <option value="0" {{ old('role_for', request()->role_for) === '0' ? 'selected' : ''  }}>@lang('System User')</option>
                                            <option value="1" {{ old('role_for', request()->role_for) === '1' ? 'selected' : ''  }}>@lang('General User')</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-info">@lang('Submit')</button>
                                    @if(request()->isFilterActive)
                                        <a href="{{ route('roles.index') }}" class="btn btn-secondary">@lang('Clear')</a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <table class="table table-striped" id="laravel_datatable">
                    <thead>
                        <tr>
                            <th>@lang('Id')</th>
                            <th>@lang('Name')</th>
                            <th>@lang('Daily Post Limits')</th>
                            <th>@lang('Plan For')</th>
                            <th>@lang('Default')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    @if($role->daily_post_limits == 0)
                                        {{ "Unlimited" }}
                                    @else
                                        {{ $role->daily_post_limits }}
                                    @endif
                                </td>
                                <td>
                                    @if($role->role_for == '1')
                                        <span class="badge badge-pill badge-success">@lang('General User')</span>
                                    @else
                                        <span class="badge badge-pill badge-primary">@lang('System User')</span>
                                    @endif
                                </td>
                                <td>
                                    @if($role->is_default == '1')
                                        <span class="badge badge-pill badge-info">@lang('Yes')</span>
                                    @else
                                        <span class="badge badge-pill badge-danger">@lang('No')</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $roles->links() }}
            </div>
        </div>
    </div>
</div>
@include('script.roles.index.js')
@endsection
