@extends('layouts.app')

@section('content')<div class="card-body">
    <a href="{{route('inventory-items.create')}}" class="btn btn-info mb-2 btn-sm text-white ">Add Inventory Item +</a>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Inventory</th>
            <th scope="col">Quantity</th>
            <th scope="col">Created at</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($inventoryItems as $key => $inventoryItem)
            <tr>
                <th scope="row">{{ $key }}</th>
                <td>{{ $inventoryItem->title }}</td>
                <td>{{ $inventoryItem->description ?? ''}}</td>
                <td>{{ $inventoryItem->inventory->title}}</td>
                <td>{{ $inventoryItem->inventory->quantity}}</td>
                <td>{{ $inventoryItem->created_at }}</td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{route('inventory-items.edit',$inventoryItem->id) }}"
                           class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{route('inventory-items.destroy', $inventoryItem->id)}}" method="POST">
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
    {{ $inventoryItems->links() }}

</div>
@endsection

