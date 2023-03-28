<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <h1>Posts</h1>
                        @foreach($posts as $post)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $post->title }}</h5>
                                    <p class="card-text">{{ $post->body }}</p>
                                    @if($post->image)
                                        <img src="{{ asset($post->image->url) }}" alt="{{ $post->image->name }}">
                                    @endif
                                    <div class="mb-3">
                                        <form action="{{ route('comments.store') }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label for="body">Add Comment</label>
                                                <textarea name="body" class="form-control" placeholder="Enter comment body"></textarea>
                                                <input type="hidden" name="post_id" value={{$post->id}}>

                                            </div>
                                            <button type="submit" class="btn btn-primary">Add Comment</button>
                                        </form>
                                    </div>
                                    @if(count($post->comments ?? []) > 0)
                                    <h6 class="card-subtitle mb-2 text-muted">Comments</h6>
                                        <div class="ml-3">
                                            @foreach($post->comments as $comment)
                                                <div class="card mb-2">
                                                    <div class="card-body">
                                                        <p class="card-text">{{ $comment->body }}</p>
                                                        <form action="{{ route('replies.store') }}" method="POST">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label for="body">Add Reply</label>
                                                                <textarea name="body" class="form-control" placeholder="Enter reply body"></textarea>
                                                                <input type="hidden" name="post_id" value={{$post->id}}>
                                                                <input type="hidden" name="parent_id" value={{$comment->id}}>

                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Add Reply</button>
                                                        </form>
                                                        @if(count($comment->replies ?? []) > 0)
                                                        <h6 class="card-subtitle mb-2 text-muted">Replies</h6>
                                                            <div class="ml-3">
                                                                @foreach($comment->replies as $reply)
                                                                    <div class="card mb-2">
                                                                        <div class="card-body">
                                                                            <p class="card-text">{{ $reply->body }}</p>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>
</html>
