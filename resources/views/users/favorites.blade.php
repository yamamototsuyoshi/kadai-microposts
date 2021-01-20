@extends('layouts.app')

@section('content')
    <div class="row">
        <aside class="col-sm-4">
            {{-- ユーザ情報 --}}
            @include('users.card')
        </aside>
        <div class="col-sm-8">
            {{-- タブ --}}
            @include('users.navtabs')
            @if (count($favorites) > 0)
                <ul class="list-unstyled">
                    @foreach ($favorites as $favorite)
                        <li class="media mb-3">
                            {{-- 投稿の所有者のメールアドレスをもとにGravatarを取得して表示 --}}
                            <img class="mr-2 rounded" src="{{ Gravatar::get($favorite->user->email, ['size' => 50]) }}" alt="">
                            <div class="media-body">
                                <div>
                                    {{-- 投稿の所有者のユーザ詳細ページへのリンク --}}
                                    {!! link_to_route('users.show', $favorite->user->name, ['user' => $favorite->user->id]) !!}
                                    <span class="text-muted">posted at {{ $favorite->created_at }}</span>
                                </div>
                                <div>
                                    {{-- 投稿内容 --}}
                                    <p class="mb-0">{!! nl2br(e($favorite->content)) !!}</p>
                                </div>
                                    {{-- アンフォローボタンのフォーム --}}
                                {!! Form::open(['route' => ['favorites.unfavorite', $favorite->id], 'method' => 'delete']) !!}
                                    {!! Form::submit('Unfavorite', ['class' => "btn btn-success btn-sm"]) !!}
                                {!! Form::close() !!}
                                {{--<div>
                                    @if (Auth::id() == $micropost->user_id)
                                        {{-- 投稿削除ボタンのフォーム 
                                        {!! Form::open(['route' => ['microposts.destroy', $micropost->id], 'method' => 'delete']) !!}
                                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                        {!! Form::close() !!}
                                    @endif
                                </div> --}}
                            </div>
                        </li>
                    @endforeach
                </ul>
                {{-- ページネーションのリンク --}}
                {{ $favorites->links() }}
@endif
        </div>
    </div>
@endsection