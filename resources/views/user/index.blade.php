@extends('user.layout')
@section('content')

<main role="main" class="container">
    <div class="{{--d-flex --}} p-3 my-3 text-white-50 bg-purple rounded shadow-sm ">
        <div class="lh-100 ">
            <h2 class="text-center mb-0 text-white lh-100">Welcome to testing system!</h2>
        </div>
    </div>

    <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="border-bottom border-gray pb-2 mb-0">Task1: </h6>
        <div class="media text-muted pt-3">
            <div class="custom-control custom-checkbox">
                <div>
                <input type="checkbox" value="1" class="custom-control-input" id="customCheck1">
                <label class="custom-control-label" for="customCheck1">Check this custom checkbox</label>
                </div>
                <div>
                    <input type="checkbox" value="2" class="custom-control-input" id="customCheck2">
                    <label class="custom-control-label" for="customCheck2">Check this custom checkbox</label>
                </div>
                <div>
                    <input type="checkbox" value="3" class="custom-control-input" id="customCheck3">
                    <label class="custom-control-label" for="customCheck3">Check this custom checkbox</label>
                </div>

            </div>
        </div>
    </div>
    <div class="container text-right">
        <button type="button" id="sendRes" class="btn btn-success ">Send</button>
    </div>



</main>
@endsection
