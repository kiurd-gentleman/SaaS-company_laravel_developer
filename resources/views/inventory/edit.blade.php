@extends('layouts.app')

@section('content')
    <div class="card-body">
        <form action="{{route('inventories.update' ,$inventory->id)}}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="title">Name</label>
                <input type="text" value="{{ old('title') ?? $inventory->title}}" name="title"
                       class="form-control" id="title"
                       placeholder="Enter title">
                @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group" >
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control">
                    {{ old('description') ?? $inventory->description}}
                </textarea>
            </div>
            <div class="form-group mt-3">
                <button type="submit" class="btn btn-info waves-effect waves-light">Submit</button>
            </div>
        </form>

    </div>
@endsection

