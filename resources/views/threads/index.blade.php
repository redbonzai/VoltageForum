@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Voltage Q & A Forum Threads

                        @if(!auth()->check())
                            <p class="text-center">Please <a href="{{ route('login') }}" target="_blank">sign in</a> to participate in the discussion</p>
                        @endif
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="card-body">
                        @foreach( $threads as $thread)
                        <article>
                            <h4>
                                <a href="{{ $thread->path() }}">{{ $thread->title }}</a>
                            </h4>
                            <div class="body">{{ $thread->body }}</div>
                        </article>
                        @endforeach

                        <hr/>

                    </div>
                </div>

            </div>
        </div>
        @if(!auth()->check())
            <p class="text-center">Please <a href="{{ route('login') }}" target="_blank">sign in</a> to participate in the discussion</p>
        @endif

    </div>
@endsection
