<?php 

function findIconPath($user_id)
{
    $file_path = 'storage/icons/' . $user_id;
    if (file_exists($file_path . '.jpg')) {
        return $file_path . '.jpg';
    } elseif (file_exists($file_path . '.png')) {
        return $file_path . '.png';
    } else { 
        return 'storage/icons/no_icon.png';
    }
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="{{ url('css/styles.css') }}">
    <title>Scenery</title>
</head>
<body>
    <div class="header", style="z-index:10000">
        <h1>Scenery</h1>
        <form method="GET" antion='{{ route('index') }}'>
            @csrf
            <input type="text" name='target' placeholder="投稿を検索">
        </form>
    </div>
    
    <div class="setting">
        <div class="profile">
            <img src={{ findIconPath(Auth::user()->id) }}  alt="プロフィール画像">
            <div class="content">
                <h2>{{ Auth::user()->name }}</h2>
                <p></p>
                <p>123456789</p>
            </div>
        </div>
        <form method="post" action="{{ route('logout') }}">
            @csrf
            <button>Log Out</button>
        </form>
    </div>

    <form method="POST" action="{{ route('store') }}" enctype="multipart/form-data">
        @csrf
        <div class="post_window">
            <div class=" post_tweet">
                <img src={{ findIconPath(Auth::user()->id) }}  alt="プロフィール画像">
                <div class="content">
                    <h2>{{ Auth::user()->name }}</h2>
                    <p></p>
                    <textarea maxlength="120" placeholder="どんな景色ですか?" style="width: 100%; height: 80px;" name="body"></textarea>
                    <label class="custom-file-input">
                        <span>画像選択</span>
                        <input type="file" name="image" id="imageInput">
                    </label>
                    <div class="image-preview">
                        <img id="previewImage" src="#" alt="">
                    </div>
                </div>
            </div>
            <button>POST</button>
            <input type="hidden" name="user_id" value={{ Auth::user()->id }}>
        </div>
    </form>
    
    <div class="timeline">
        @forelse ($posts as $post)
            <div class='tweet'>
                <img src={{ findIconPath($post->user_id) }}  alt="アイコン画像">
                <div class="content">
                    <h2>{{ $users->find($post->user_id)->name }}</h2>
                    <p></p>
                    <p>{{ $post->body }}</p>
                    <div class="scene">
                        <img src="{{ asset($post->image_path) }}" alt="景色">
                    </div>
                    <form method="post" action="{{ route('destroy', $post) }}" id="delete_post">
                        @method('DELETE')
                        @csrf
                        <button>[x]</button>
                    </form>
                </div>
            </div>
        @empty
            <div class='post'>No posts yet!</div>
        @endforelse
    </div>
    <script src="{{ url('js/script.js') }}"></script>
</body>
</html>