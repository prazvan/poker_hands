@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">{{ __('Reports') }}</div>

        <div class="card-body">
            <reports-component :reports="{{$reports}}"></reports-component>
        </div>
    </div>


{{--    <div class="card">--}}
{{--        <div class="card-header">{{ __('Reports') }}</div>--}}



{{--        <div class="card-body">--}}
{{--            @if (session('status'))--}}
{{--                <div class="alert alert-success" role="alert">--}}
{{--                    {{ session('status') }}--}}
{{--                </div>--}}
{{--            @endif--}}

{{--            @dd($reports);--}}
{{--            --}}
{{--        </div>--}}
{{--    </div>--}}
@endsection
