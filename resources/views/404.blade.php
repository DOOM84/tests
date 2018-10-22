@extends('user.layout')
@section('title', __('page.404'))
@section('content')

    <!-- Main Content -->
    <main role="main" class="container">
        <div class="{{--d-flex --}} p-3 my-3 text-white-50 bg-purple rounded shadow-sm ">
            @include('includes.messages')
            <div class="lh-100 ">
                <h2 class="text-center mb-0 text-white lh-100">@lang('page.404')</h2>
            </div>
        </div>
        <div class="my-3 p-3 bg-white rounded shadow-sm text-center">
            <a href="{{route('user.tasks')}}" class="btn btn-success"><strong>@lang('page.toTest')</strong></a>
        </div>

    </main>
    <!-- Main Content -->

@endsection