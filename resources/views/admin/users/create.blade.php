@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('global.user.title_singular') }}
    </div>

    <div class="card-body">
        {!! Form::open(['method'=>'Post', 'action'=>'Admin\UsersController@store', 'enctype'=>'multipart/form-data']) !!}

            <div class="form-group ">
                {!! Form::label('name', 'Name:') !!}
                {!! Form::text('name', '', ['class' => 'form-control']) !!}
            </div>

            <div class="form-group ">
                {!! Form::label('roles', 'Role:') !!}
                {!! Form::select('roles[]', [''=>'Choose Options', $roles], null , ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('email', 'Email:') !!}
                {!! Form::email('email', '', ['class' => 'form-control']) !!}
            </div>

            <div class="form-group ">
                {!! Form::label('password', 'Password:') !!}
                {!! Form::password('password', ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('file', 'Photo', ['class' => 'control-label']) !!}
                {!! Form::file('filename') !!}
            </div>

            <div class="form-group ">
                {!! Form::label('is_active', 'Status:') !!}
                {!! Form::select('is_active', [1=>'Active', 0=>'Inactive'], 0, ['class' => 'form-control']) !!}
            </div>

            <div>
                {!! Form::submit(trans('global.save'), ['class' => 'btn btn-danger']) !!}
            </div>

        @include('errors.form-error')


        {!! Form::close() !!}
    </div>
</div>

@endsection
