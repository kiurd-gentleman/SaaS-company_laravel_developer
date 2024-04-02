@extends('layouts.app')

@section('content')<div class="card-body">
    <a href="{{route('inventories.create')}}" class="btn btn-info mb-2 btn-sm ">Add Inventory +</a>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Created at</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($inventories as $key => $inventory)
            <tr>
                <th scope="row">{{ $key }}</th>
                <td>{{ $inventory->name }}</td>
                <td>{{ $inventory->description}}</td>
                <td>{{ $inventory->created_at }}</td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{route('inventories.edit',$inventory->id) }}"
                           class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{route('inventories.destroy', $inventory->id)}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Delete
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>
@endsection

