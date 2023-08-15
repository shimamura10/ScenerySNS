<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ScenerySNS</title>
</head>
<body>
    <h1>ScenerySNS</h1>
    
    <div id='search'>
        <form method="GET" antion='{{ route('index') }}'>
            @csrf
            <input type="text" name='target'>
        </form>
    </div>
    
    <div id='setting'>
        <h2>Setting</h2>
        <?php $file_path = 'storage/icons/' . Auth::user()->id; ?>
        @if (file_exists($file_path . '.jpg'))
            <img src={{ $file_path . '.jpg' }}>
        @elseif (file_exists($file_path . '.png'))
            <img src={{ $file_path . '.png' }}>
        @endif
        <p>ユーザー名：{{ Auth::user()->name }}</p>
    </div>
    
    <div id='post-window'>
        <h2>投稿フォーム</h2>
        <form method="POST" action="{{ route('store') }}" enctype="multipart/form-data">
            @csrf
            <input type="file" name="image">
            <input type="text" name="body">
            <button>アップロード</button>
        </form>
    </div>
    
    <div id='timeline'>
        <h2>Timeline</h2>
        @forelse ($posts as $post)
            <div class='post'>
                <p>{{ $post->body }}</p>
                <img src="{{ asset($post->image_path) }}">
                <form method="post" action="{{ route('destroy', $post) }}" id="delete_post">
                    @method('DELETE')
                    @csrf
                    <button>[x]</button>
                </form>
            </div>
        @empty
            <div class='post'>No posts yet!</div>
        @endforelse
    </div>
</body>
</html>