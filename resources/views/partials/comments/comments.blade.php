<form
action="{{ route('comments.update', ['comment' => $comment->id]) }}"
method="POST" class="edit-comment-form"
style="display:none;">
@csrf
@method('PUT')
<div class="form-group">
    <label for="body">Edit Comment</label>
    <textarea name="body" class="form-control">{{ $comment->body }}</textarea>
</div>
<button type="submit" class="btn btn-primary">Update
    Comment</button>
</form>

<form
action="{{ route('comments.destroy', ['comment' => $comment->id]) }}"
method="POST" class="delete-comment-form"
style="display:none;">
@csrf
@method('DELETE')
<button type="submit" class="btn btn-danger">Delete
    Comment</button>
</form>

@push('c-script')
<script>
    $(document).ready(function() {
        $('.edit-comment').click(function() {
        $(this).closest('.card-body').find('.edit-comment-form').show();
        $(this).closest('.card-body').find('.card-text-comment').hide();
    });

        $('.edit-comment-form').submit(function(e) {
            e.preventDefault();

            var form = $(this);
            var commentBody = form.find('textarea[name="body"]').val();
            var commentId = form.closest('.card').data('comment-id');
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            var url = form.attr('action');
            console.log(url);

            $.ajax({
                url: url,
                method: 'PUT',
                data: {
                    body: commentBody,
                    _token: '{{ csrf_token() }}'

                },
                success: function(response) {
                    form.closest('.card-body').find('.card-text-comment').text(response.body)
                .show();
                    form.hide();
                },
                error: function(response) {
                    console.log(response);
                }
            });
        });
    });
</script>
<script>
    $('.delete-comment').click(function() {
        $(this).closest('.card-body').find('.delete-comment-form').show();
        $(this).closest('.card-body').find('.card-text').hide();
    });
    $('.delete-comment-form').submit(function(e) {
        e.preventDefault();

        var form = $(this);
        var commentId = form.closest('.card').data('comment-id');
        var url = form.attr('action');

        $.ajax({
            url: url,
            method: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}'

            },
            success: function(response) {
                form.closest('.card').remove();
            },
            error: function(response) {
                console.log(response);
            }
        });
    });
</script>
@endpush
