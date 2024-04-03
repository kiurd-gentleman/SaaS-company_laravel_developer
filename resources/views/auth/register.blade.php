@extends('layouts.app')

@section('content')
<div>
    <register-component></register-component>
</div>
@endsection
<script>
    import RegisterComponent from "@/components/auth/RegisterComponent.vue";
    export default {
        components: {RegisterComponent}
    }
</script>
