@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <h3 class="card-header">New Upload</h3>
                    <div class="card-body">
                        <form method="POST" action="/uploads" enctype="multipart/form-data" name="form1">
                            @csrf
                            <div class="form-group">
                                <label for="name">Title</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
                            </div>
                            <div class="form-group">
                                <label for="file">File</label>
                                <input type="file" name="file" id="file">
                            </div>
                            <div class="form-group">
                                <label for="shareoptions">Share with:</label>
                                <select name="shareoptions" id="shareoptions" class="form-control">
                                    <option value="none">Only Me (You can change this later.)</option>
                                    @foreach (Auth::user()->groups as $group)
                                        <option value="{{$group->id}}">{{$group->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <small>You can allow more users and groups to see this file on the next page.</small>
                            <button type="submit" class="btn btn-success btn-block">Upload File</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection