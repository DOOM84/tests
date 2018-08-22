@if(count($errors)>0)
    @foreach($errors->all() as $error)
        <p class="alert alert-danger text-center">{{$error}}</p>
    @endforeach
@endif

@if (session('status'))
    <div class="alert alert-success text-center">
        {{ session('status') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger text-center">
        {{ session('error') }}
    </div>
@endif

<div id="ratemes" class="alert alert-success text-center" style="display: none">

</div>

<div id="rateerr" class="alert alert-danger text-center" style="display: none">

</div>


