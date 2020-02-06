@extends('layouts.admin')

@section('content')
    <h1>Post</h1>
@can('post_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.posts.create") }}">
                Create Post
            </a>
        </div>
    </div>
@endcan
    <div class="card">
        <div class="card-header">
            Posts
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Image</th>
                            <th>Owner</th>
                            <th>Category</th>
                            <th>Title</th>
                            <th>Post</th>
                            <th>Created</th>
                            <th>Updated</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($posts)
                            @foreach($posts as $post)
                        <tr>
                            <td>{{$post->id}}</td>
                            <td><img height="50" src="{{$post->photo ? $post->photo->file : 'http://placehold.it/400x400'}}" alt=""></td>
                            <td>{{$post->user->name}}</td>
                            <td>{{$post->category_id}}</td>
                            <td>{{$post->title}}</td>
                            <td>{{$post->body}}</td>
                            <td>{{$post->created_at->diffForHumans()}}</td>
                            <td>{{$post->updated_at->diffForHumans()}}</td>

                        </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
