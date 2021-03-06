@extends('user.layout')
@section('title', __('page.register'))
@section('content')

    <main role="main" class="container">
        <div class="{{--d-flex --}} p-3">

        </div>
        <div class="card">
            <div class="card-header">@lang('page.register')</div>

            <div class="card-body">
                <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">@lang('page.name')</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">@lang('page.email')</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="group_id" class="col-md-4 col-form-label text-md-right">@lang('page.group')</label>
                        <div class="col-md-6">
                        <select id="group_id" name="group_id" class="form-control" required>
                            @foreach($groups as $group)
                                <option value="{{$group->id}}">{{$group->name}}
                                    ({{isset($group->institute->name) ? $group->institute->name : __('page.noEdu')}})
                                    ({{isset($group->branch->name) ? $group->branch->name : ''}})
                                </option>
                            @endforeach
                        </select>
                            @if ($errors->has('group_id'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('group_id') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">@lang('page.password')</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">@lang('page.again')</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                @lang('page.register')
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </main>
@endsection
