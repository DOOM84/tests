@extends('user.layout')
@section('title', __('page.stats'))
@section('content')

    <main role="main" class="container">
        <div class="{{--d-flex --}} p-3 my-3 text-white-50 bg-purple rounded shadow-sm ">
            @include('includes.messages')

            <div class="lh-100 ">
                <h2 class="text-center mb-0 text-white lh-100">@lang('page.stats'). @auth {{Auth::user()->name}} @endauth</h2>
            </div>

        </div>

        <div class="my-3 p-3 bg-white rounded shadow-sm text-center">
            @guest
                @lang('page.cantSee')
            @else
                @if(Auth::user()->results->count() > 0)
                    <a class="btn btn-primary mb-2 " href="{{route('user.stats.graph.student')}}">
                        @lang('page.grInform')
                    </a>
                    <div class="text-right">
                        <a href="#"><i data-feather="printer" onclick="printData()"></i></a>
                        <a href="#"><i data-feather="mail" onclick="mailData()"></i></a>
                    </div>
                @else @endif
                <div id="res">
                    <h3 id="tableName" class="d-none">@lang('page.stats'). {{Auth::user()->name}}</h3>
                    @forelse(Auth::user()->results->sortByDesc('level_id')->groupBy('level_id') as $level => $results)
                        <table class="table" cellpadding="7" border="2" width="100%">
                            <thead class="thead-dark">
                            <tr>
                                <th colspan="4" scope="col" align="center">@lang('page.level') {{$results[0]->level->level}}</th>

                            </tr>
                            </thead>
                            <thead class="thead-light">
                            <tr>
                                <th scope="col" align="center">#</th>
                                <th scope="col" align="center">@lang('page.curTest')</th>
                                <th scope="col" align="center">@lang('page.dateTime')</th>
                                <th scope="col" align="center">@lang('page.curRate')</th>


                            </tr>
                            </thead>
                            <tbody>
                            @foreach($results as $result)
                                <tr>
                                    <td scope="col" align="center">{{$loop->iteration}}</td>
                                    <td scope="col" align="center">
                                        <a href="{{route('user.stats.detail', $result->id)}}">{{isset($result->topic->name) ? $result->topic->name : __('page.testName')}}</a>
                                    </td>
                                    <td scope="col" align="center">{{$result->start}} <br> (@lang('page.duration'): {{$result->duration}})
                                    </td>
                                    <td scope="col" align="center">{{$result->result}}</td>
                                </tr>

                            @endforeach
                            <tr>
                                <td colspan="4" scope="col" align="center">@lang('page.average')
                                    {{Auth::user()->getMidRes($level)}}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    @empty
                        <tr>
                            <td colspan="4" align="center">@lang('page.noRes')</td>
                        </tr>
                    @endforelse
                </div>
            @endguest
        </div>


    </main>

@endsection

@section('scriptSection')
    @include('user._printOrMail')
@endsection


