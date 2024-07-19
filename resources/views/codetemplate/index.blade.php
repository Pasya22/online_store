@extends('layout.app')
@section('title', 'dashboard')
@section('content')
    <div>
        Welcome back, {{ session('user')->id_role }}!
    </div>
@endsection
