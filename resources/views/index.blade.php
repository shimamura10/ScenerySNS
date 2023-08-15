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
        <div id='search'>
            <form method="GET" antion='{{ route('index') }}'>
                @csrf
                <input type="text" name='target' placeholder="投稿を検索">
            </form>
        </div>
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
        <button>setting</button>
    </div>

    <div class="post_window">
        <form method="POST" action="{{ route('store') }}" enctype="multipart/form-data">
            @csrf
            <div class=" post_tweet">
                <img src={{ findIconPath(Auth::user()->id) }}  alt="プロフィール画像">
                <div class="content">
                    <h2>{{ Auth::user()->name }}</h2>
                    <p></p>
                    <textarea maxlength="120" placeholder="どんな景色ですか?" style="width: 100%; height: 80px;" name="body"></textarea>
                    <input type="file"  name="image">
                    <!-- <div class="scene">
                        <img src="test.jpeg" alt="景色">
                    </div> -->
                </div>
                <button>POST</button>
            </div>
            <input type="hidden" name="user_id" value={{ Auth::user()->id }}>
        </form>
    </div>
    
    <div class="timeline">
        @forelse ($posts as $post)
            <div class='tweet'>
                <img src={{ findIconPath($post->user_id) }}  alt="アイコン画像">
                <div class="content">
                    <h2></h2>
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
</body>
</html>