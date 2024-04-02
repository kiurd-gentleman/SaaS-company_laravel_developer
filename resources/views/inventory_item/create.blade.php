@extends('layouts.app')

@section('content')
    <div class="card-body">
        <inventory-item-create-component :inventories="{{json_encode($inventories)}}"></inventory-item-create-component>
    </div>
@endsection

