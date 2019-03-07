@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <h3 class="card-header">New Paste</h3>
                    <div class="card-body">
                        <form method="POST" action="/pastes">
                            @csrf
                            <div class="form-group">
                                <label for="name">Title</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
                            </div>
                            <div class="form-group">
                                <label for="body">Body</label>
                                <textarea class="form-control" rows="10" id="body" name="body" style="overflow-wrap: break-word; font-family: SFMono-Regular, Menlo, Monaco, Consolas, Liberation Mono, Courier New, monospace;"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="language">Syntax Highlighting:</label>
                                <select name="language" id="language" class="form-control">
                                    @foreach ($languages as $shortcode=>$friendlyname)
                                        <option value="{{$shortcode}}"
                                                @if($shortcode == "text")
                                                    selected
                                                @endif
                                            >{{$friendlyname}}</option>
                                    @endforeach
                                </select>
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
                            <small>You can allow more users and groups to see this paste on the next page.</small>
                            <button type="submit" class="btn btn-success btn-block">Create Paste</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection