{{-- layouts/admin/profiles.blade.phpを読み込む --}}
@extends('layouts.profiles')


{{-- admin/profiles.blade.phpの@yield('title')に'プロフィールの新規作成'を埋め込む --}}
@section('title', 'プロフィール新規作成')

{{-- admin/profiles.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>プロフィール新規作成</h2>
            </div>
        </div>
    </div>
@endsection