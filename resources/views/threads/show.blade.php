@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-md-offset-2">
                <div class="card">
                    <div class="card-header">
                        <a href="#" class="href">{{ $thread->creatorName() }}</a> posted:
                        {{ $thread->title }}
                    </div>
                    <div class="card-body">
                        {{ $thread->body }}
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12 col-md-offset-2">
                @foreach ($thread->replies as $reply)
                    @include ('threads.reply')
                @endforeach
            </div>
        </div>
        @if (auth()->check())
            <div class="row justify-content-center mt-4">
                <div class="col-md-12 col-md-offset-2">
                        <form method="POST" action="/threads/{{ $thread->channel->slug }}/{{ $thread->id  }}/replies">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <textarea name="body" id="body" class="form-control" placeholder="Have something to say?" rows="5"></textarea>
                            </div>
                            <button type="submit" class="btn btn-default">Post</button>
                        </form>
                </div>
            </div>
        @else
            <div>
                <p class="mt-4">Please <a href="{{ route('login') }}">sign in</a> to participate in this discussion.</p>
            </div>
        @endif
    </div>
@endsection
