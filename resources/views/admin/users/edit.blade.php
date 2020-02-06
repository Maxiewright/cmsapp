@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('global.user.title_singular') }}
    </div>

    <div class="card-body">
        <div class="row">

            <div class="col-sm-3 text-center">
                <div>
                    <img height="250" src="{{$user->photo ? $user->photo->file : 'http://placehold.it/400x400'}}" alt="" class="img-rounded img-responsive">
                </div>
                <br>

            </div>

            <div class="col-sm-9">

            {!! Form::model($user, ['route' => ['admin.users.update', $user->id], 'method' => 'PATCH']) !!}

                <div class="form-group">
                    {!! Form::label('photo_id', 'Photo', ['class' => 'control-label']) !!}
                    {!! Form::file('photo_id', null, ['class'=>'form-control'])!!}
                </div>

                <div class="form-group ">
                    {!! Form::label('name', 'Name:') !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group ">
                    {!! Form::label('roles', 'Role:') !!}
                    {!! Form::select('roles[]', [''=>'Choose Options', $roles], null , ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('email', 'Email:') !!}
                    {!! Form::email('email', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group ">
                    {!! Form::label('is_active', 'Status:') !!}
                    {!! Form::select('is_active', [1=>'Active', 0=>'Inactive'], null, ['class' => 'form-control']) !!}
                </div>

                <div>
                    {!! Form::submit(trans('global.save'), ['class' => 'btn btn-danger']) !!}
                </div>
                <br>
                <div>@include('errors.form-error')</div>

            {!! Form::close() !!}


            </div>
        </div>
    </div>
</div>

@endsection
