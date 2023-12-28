@extends('layouts.admin')
@section('title', '登録済みニュースの一覧')

@section('content')
    <div class="container">
        <div class="row">
            <h2>ニュース一覧</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                <a href="{{ route('admin.posts.create') }}" role="button" class="btn btn-primary">新規作成</a>
            </div>
            <div class="col-md-8">
                <form action="{{ route('admin.posts.index') }}" method="get">
                    <div class="form-group row">
                        <label class="col-md-2">タイトル</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="cond_title" value="{{ $cond_title }}">
                        </div>
                        <div class="col-md-2">
                            @csrf
                            <input type="submit" class="btn btn-primary" value="検索">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="list-news col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th width="10%">ID</th>
                                <th width="20%">投稿者名</th>
                                <th width="30%">タイトル</th>
                                <th width="30%">本文</th>
                                <th width="10%">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <th>{{ $post->id }}</th>
                                    <th>{{ $post->user->name }}</th>
                                    <td>{{ Str::limit($post->title, 100) }}</td>
                                    <td>{{ Str::limit($post->body, 250) }}</td>
                                    <td>
                                        @if($post->user_id == Auth::id())
                                        <div>
                                            <a href="{{ route('admin.posts.edit', ['id' => $post->id]) }}">編集</a>
                                        </div>
                                        <div>
                                            <a href="{{ route('admin.posts.destroy', ['id' => $post->id]) }}">削除</a>
                                        </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection