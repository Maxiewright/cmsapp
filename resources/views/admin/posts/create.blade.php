@extends('layouts.admin')

@section('content')

<div class="card">

    <div class="card-body">

        {!! Form::open(['method'=>'POST', 'action'=>'Admin\PostsController@store', 'enctype'=>'multipart/form-data'])!!}
            <div class="form-group">
                {!! Form::label('title', 'Title', ['class' => 'control-label']) !!}
                {!! Form::text('title', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('category_id', 'Category', ['class' => 'control-label']) !!}
                {!! Form::select('category_id', [$categories] , null,['placeholder' => 'Choose Category', 'class' => 'form-control'] ) !!}
            </div>
            <div class="form-group">
                {!! Form::label('photo_id', 'Post Image', ['class' => 'control-label']) !!}
                {!! Form::file('photo_id', ['class'=>'form-control-file'])!!}
            </div>
            <div class="form-group">
                {!! Form::label('body', 'Description', ['class' => 'control-label']) !!}
                {!! Form::textarea('body', null, ['class' => 'form-control', 'rows'=>3]) !!}
            </div>
            <div>
                {!! Form::submit('Add Post', ['class' => 'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}
            <br>
            <div>
                @include('errors.form-error')
            </div>
    </div>

</div>
@endsection
