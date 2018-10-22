@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <a href="#">{{ $thread->user->name }}</a> posted:
                            {{ $thread->title }}
                    </div>

                    <div class="card-body">
                        {{ $thread->body }}

                        <hr/>

                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center ">
            <div class="col-md-8">
                @foreach($thread->replies as $reply)

                    @include('replies.reply')

                @endforeach
            </div>
        </div>

        @if(auth()->check())
            <div class="row justify-content-center">
                <div class="col-md-8">
                @if($errors->any())

                    @foreach($errors->all() as $error)
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">


                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            {{ $error }}
                        </div>
                    @endforeach
                @endif
                </div>
            </div>

            <div class="row justify-content-center ">
                <div class="col-md-8">

                    <form method="post" action="{{ $thread->path() . '/replies' }}">
                        @csrf
                        <div class="form-group">
                            <label for="thread-reply-body">Reply Body</label>
                            <textarea
                                name="threadReply"
                                id="threadReply"
                                class="form-control"
                                placeholder="Have something to say?"
                                rows="5">

                            </textarea>
                        </div>

                        <button type="submit" class="btn btn-success">Post A Reply</button>
                    </form>
                </div>
            </div>


        @else
            <p class="text-center">Please <a href="{{ route('login') }}" target="_blank">sign in</a> to participate in the discussion</p>
        @endif
    </div>
@endsection
