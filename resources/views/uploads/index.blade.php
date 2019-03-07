@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <h3 class="card-header">Uploads</h3>
            <div class="card-body">
                <a href="/uploads/create" class="btn btn-block btn-success mb-4">Upload New File</a>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Owner</th>
                        <th scope="col" class="text-right">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(App\Upload::with('owner')->get() as $upload)
                        @can('view', $upload)
                            <tr>
                                <td scope="row">{{$upload->name}}</td>
                                <td>{{$upload->owner->username}}</td>
                                <td class="text-right">
                                    <a href="/uploads/{{$upload->id}}" class="btn btn-primary">View</a>
                                    @can('update', $upload)
                                        <a href="/uploads/{{$upload->id}}/edit" class="btn btn-warning">Edit</a>
                                    @endcan
                                    @can('delete', $upload)
                                        <a href="/uploads/{{$upload->id}}/delete" class="btn btn-danger">Delete</a>
                                    @endcan
                                </td>
                            </tr>
                        @endcan
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection