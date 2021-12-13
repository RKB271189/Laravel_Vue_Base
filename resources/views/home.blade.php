@extends('layouts.app')
@section('content')
<example-component :app_name="{{json_encode(config('app.name'))}}"></example-component>
@endsection