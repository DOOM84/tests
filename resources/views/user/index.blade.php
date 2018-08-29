@extends('user.layout')
@section('title', 'Welcome')
@section('content')

<main role="main" class="container">
    <div class="{{--d-flex --}} p-3 my-3 text-white-50 bg-purple rounded shadow-sm ">
        @include('includes.messages')
        <div class="lh-100 ">
            <h2 class="text-center mb-0 text-white lh-100">Welcome to the testing system!</h2>
        </div>
    </div>
    <div class="my-3 p-3 bg-white rounded shadow-sm text-center">
        <a href="{{route('user.tasks')}}" class="btn btn-success"><strong>Go to the testing</strong></a>
    </div>

</main>
@endsection
