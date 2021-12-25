@extends('adminlte::page')

@section('title', 'Admin Panel')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <h4>Welcome <strong>{{ auth()->user()->name }}</strong> to your dashboard.</h4>
    <p>use the left menu to manage your content.</p>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
