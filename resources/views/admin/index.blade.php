@extends('layouts.admin')
@section('content')

    <example-component></example-component>

    <script>
        import ExampleComponent from "../../js/Components/ExampleComponent";
        export default {
            components: {ExampleComponent}
        }
    </script>

@endsection
