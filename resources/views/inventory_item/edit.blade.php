@extends('layouts.app')

@section('content')
    <div class="card-body">
        <inventory-item-edit-component :inventory_item="{{json_encode($inventoryItem)}}" :inventories="{{json_encode($inventories)}}"></inventory-item-edit-component>
    </div>
@endsection

