@extends('layouts.profiles')
@section('title', 'プロフィールの一覧')

@section('content')
    <div class="container">
        <div class="row">
            <h2>プロフィール一覧</h2>
        </div>
        <div class="row">
            <div class="list-news col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th width="10%">ID</th>
                                <th width="20%">投稿者名</th>
                                <th width="20%">名前</th>
                                <th width="10%">性別</th>
                                <th width="10%">趣味</th>
                                <th width="20%">自己紹介</th>
                                <th width="20%">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($profiles as  $profile)
                                <tr>
                                    <th>{{ $profile->id }}</th>
                                    <th>{{ $profile->user->name }}</th>
                                    <th>{{ $profile->name }}</th>
                                    <th>{{ $profile->gender }}</th>
                                    <th>{{ $profile->hobby }}</th>
                                    <td>{{ Str::limit($profile->introduction, 250) }}</td>
                                    <td>
                                        @if($profile->user_id == Auth::id())
                                        <div>
                                            <a href="{{ route('admin.profiles.edit', ['id' => $profile->id]) }}">編集</a>
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