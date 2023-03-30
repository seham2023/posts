<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>

<body>
    <div class="col-md-6 offset-md-3 d-flex justify-content-between align-items-center">
        <a href="{{ route('posts.create') }}" class="btn btn-primary">Create Post</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1>Posts</h1>
                @foreach ($posts as $post)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{{ $post->content }}</p>
                        @if ($post->image)
                        <img src="{{ asset($post->image) }}" alt="">
                        @elseif ($post->images)
                        @foreach ($post->images as $image)
                        <img src="{{ asset($image->filename) }}" alt="" height="300px" width="300px">
                        @endforeach
                        @endif

                        <div class="d-flex justify-content-between mt-3">
                            <a href="#editPostModal{{ $post->id }}" data-toggle="modal">Edit</a>
                            <a href="#" data-toggle="modal" data-target="#deletePostModal{{ $post->id }}">Delete</a>
                        </div>
                        <div class="mb-3">
                            <form action="{{ route('comments.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="body">Add Comment</label>
                                    <textarea name="body" class="form-control" placeholder="Enter comment body"></textarea>
                                    <input type="hidden" name="post_id" value={{ $post->id }}>
                                </div>
                                <button type="submit" class="btn btn-primary">Add Comment</button>
                            </form>
                        </div>
                        @if (count($post->comments ?? []) > 0)
                        <h6 class="card-subtitle mb-2 text-muted">Comments</h6>
                        <div class="ml-3">
                            @foreach ($post->comments->where('parent_id', null) as $comment)
                            <div class="card mb-2">
                                <div class="card-body">
                                    <p class="card-text-comment">{{ $comment->body }}</p>
                                    <div class="d-flex justify-content-between">
                                        <div class="btn-group">
                                            <a href="#" class="btn btn-sm btn-outline-secondary edit-comment">Edit</a>
                                            <button type="button" class="btn btn-sm btn-outline-secondary delete-comment">Delete</button>
                                        </div>
                                    </div>
                                    @if (count($comment->replies ?? []) > 0)
                                    <div class="ml-3">
                                        @foreach ($comment->replies as $reply)
                                        <div class="card mb-2">
                                            <div class="card-body">
                                                <p class="card-text">{{ $reply->body }}</p>
                                                <div class="d-flex justify-content-between">
                                                    <div class="btn-group">
                                                        <a href="#" class="btn btn-sm btn-outline-secondary edit-reply">Edit</a>
                                                        <button type="button" class="btn btn-sm btn-outline-secondary delete-reply">Delete</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    @endif

                                    @include('partials.comments.comments')
                                    <form action="{{ route('replies.store') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="body">Add Reply</label>
                                            <textarea name="body" class="form-control" placeholder="Enter reply body"></textarea>
                                            <input type="hidden" name="post_id" value={{ $post->id }}>
                                            <input type="hidden" name="parent_id" value={{ $comment->id }}>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Add Reply</button>

                                    </form>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>

                @include('partials.posts.posts')
                @endforeach
            </div>
        </div>

            <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
                integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
            </script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
            </script>
            <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
                crossorigin="anonymous"></script>




      @stack('c-script')

</body>

</html>
