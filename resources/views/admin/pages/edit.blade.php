@extends('admin.layouts.master')

@section('content')
    <p>@lang('pages.show') : {{ link_to_route('page.custompage', route('page.custompage', $page), $page) }}</p>

    

    {!! Form::model($page, ['route' => ['admin.pages.update', $page], 'method' =>'PUT', 'files' => true]) !!}
        @include('admin/pages/_form')

        <div class="pull-left">
            {{ link_to_route('admin.pages.index', __('forms.actions.back'), [], ['class' => 'btn btn-secondary']) }}
            {!! Form::submit(__('forms.actions.update'), ['class' => 'btn btn-primary']) !!}
        </div>
    {!! Form::close() !!}

    {!! Form::model($page, ['method' => 'DELETE', 'route' => ['admin.pages.destroy', $page], 'class' => 'form-inline pull-right', 'data-confirm' => __('forms.pages.delete')]) !!}
        {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i> ' . __('pages.delete'), ['class' => 'btn btn-link text-danger', 'name' => 'submit', 'type' => 'submit']) !!}
    {!! Form::close() !!}
@endsection
