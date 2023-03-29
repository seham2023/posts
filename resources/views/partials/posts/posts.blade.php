<!-- Edit Post Modal -->
<div class="modal fade" id="editPostModal{{ $post->id }}" tabindex="-1" role="dialog" aria-labelledby="editPostModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPostModalLabel">Edit Post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editPostForm" action="{{route('posts.update','test')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editPostTitle">Title</label>
                        <input type="text" class="form-control" id="editPostTitle" name="title" value="">
                    </div>
                    <div class="form-group">
                        <label for="editPostContent">Content</label>
                        <textarea class="form-control" id="editPostContent" name="content" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="editPostImage">Image</label>
                        <input type="file" class="form-control-file" id="editPostImage" name="images[]" multiple>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" class="form-control" id="editPostTitle" name="id" value="{{$post->id}}">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- ///////////////////////////// --}}

<!-- Delete Post Modal -->
<div class="modal fade" id="deletePostModal{{ $post->id }}" tabindex="-1" role="dialog" aria-labelledby="deletePostModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletePostModalLabel">Delete Post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="deletePostForm" action="{{route('posts.destroy','post')}}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <input type="hidden" name="id" id="deletePostId" value="{{$post->id}}">
                    <p>Are you sure you want to delete this post?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

