@extends('user.layout')
@section('title', __('page.grStats'))
@section('content')

    <main role="main" class="container">
        <div class="{{--d-flex --}} p-3 my-3 text-white-50 bg-purple rounded shadow-sm ">
            @include('includes.messages')
            <div class="lh-100 ">
                <h2 class="text-center mb-0 text-white lh-100">
                    @lang('page.grStats') @auth {{Auth::user()->group->name}} @endauth
                </h2>
            </div>
        </div>

        <div class="my-3 p-3 bg-white rounded shadow-sm text-center">
            @guest
                @lang('page.cantSee')
            @else
                @if(Auth::user()->results->count() > 0)
                    <a class="btn btn-primary mb-2" href="{{route('user.stats.graph.group')}}">
                        @lang('page.grInform')
                    </a>
                    <div class="text-right">
                        <a href="#"><i data-feather="printer" onclick="printData()"></i></a>
                        <a href="#"><i data-feather="mail" onclick="mailData()"></i></a>
                    </div>
                @else @endif
                    <div id="res">
                        <h3 id="tableName" class="d-none">@lang('page.grStats') {{Auth::user()->group->name}}</h3>
                <table class="table" cellpadding="7" border="2" width="100%">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col" align="center">#</th>
                        <th scope="col" align="center">@lang('page.curTest')</th>
                        <th scope="col" align="center">@lang('page.langLevel')</th>
                        <th scope="col" align="center">@lang('page.dateTime')</th>
                        <th scope="col" align="center">@lang('page.testRes')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse(Auth::user()->group->users->sortBy('name') as $user)
                        <thead class="thead-dark">
                        <tr>
                            <th colspan="5" scope="col" align="center">{{$user->name}}</th>
                        </tr>
                        </thead>
                        @forelse($user->results->sortByDesc('level_id') as $result)
                            <tr>
                                <td scope="col" align="center">{{$loop->iteration}}</td>
                                <td scope="col" align="center">
                                    {{isset($result->topic->name) ? $result->topic->name : __('page.testName')}}
                                </td>
                                <td scope="col" align="center">
                                    {{$result->level->level}}
                                </td>
                                <td scope="col" align="center">{{$result->updated_at}}</td>
                                <td scope="col" align="center">{{$result->result}}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" scope="col" align="center">@lang('page.noRes')</td>
                            </tr>

                        @endforelse
                    @empty
                        <tr>
                            <td colspan="5" align="center">@lang('page.noRes')</td>
                        </tr>
                        @endforelse
                        </tbody>
                </table>
            @endguest
                    </div>

        </div>
    </main>
@endsection

@section('scriptSection')
    @include('user._printOrMail')
@endsection
