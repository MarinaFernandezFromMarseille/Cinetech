<?php
$type = $tags[0];
$type = strtolower($type);

if ($type == 'TV') {
    $type = 'tv';
}
$id = $tags[1];

$apiKey = 'cb5b4d9e55721b38a4fb8f7988f5a804';
$infoUrl = "https://api.themoviedb.org/3/{$type}/{$id}?api_key={$apiKey}&language=en-US&append_to_response=videos,credits,images";


$infoResponse = file_get_contents($infoUrl);
$data = json_decode($infoResponse, true);


if (!empty($data['number_of_seasons'])) {
    $seasoncounts = $data['number_of_seasons'];
} 
if (!empty($data['number_of_episodes'])) {
    $episodecounts = $data['number_of_episodes'];
} else {
    $seasoncounts = null;
    $episodecounts = null;
}



$similarmovies_url = "https://api.themoviedb.org/3/{$type}/{$id}/similar?api_key={$apiKey}&language=en-US&page=1";

$similarmovies_response = file_get_contents($similarmovies_url);
$similarmovies_data = json_decode($similarmovies_response, true);

$idinfo = $type . "-" . $id;





if (isset($_POST['watchlist'])) {
    if ($isFavorite) {
        $favorite->removeFromFavorite($idinfo);
    } else {
        $favorite->addToFavorite($idinfo);
    }
    header("Location: /cinetech/info/{$type}/{$id}");
}


$comments_url = "https://api.themoviedb.org/3/{$type}/{$id}/reviews?api_key={$apiKey}";

$comments_response = file_get_contents($comments_url);
$comments_data = json_decode($comments_response, true);

$local_comments = $comment->getComments($id);

foreach ($local_comments as $individualComment) {
    $authorname = $user->getUsernameFromUid($individualComment['uid']);
    $formattedComment = [
        "author" => $authorname,
        "content" => $individualComment['comment'],
        "created_at" => $individualComment['added_at'],
        "local_comment" => true,
        "id" => $individualComment['id']
    ];

    $comments_data['results'][] = $formattedComment;
}

$already_replied = [];

function checkreplies() {
    global $comments_data, $already_replied, $comment, $user;
    foreach ($comments_data['results'] as $key => $singularComment) {
        $replies = $comment->getComments($singularComment['id']);
        if ($replies) {
            foreach ($replies as $reply) {
                if (in_array($reply['id'], $already_replied)) {
                    continue;
                }
                $authorname = $user->getUsernameFromUid($reply['uid']);
                $formattedComment = [
                    "author" => $authorname,
                    "content" => $reply['comment'],
                    "created_at" => $reply['added_at'],
                    "local_comment" => true,
                    "id" => $reply['id'],
                    "reply_to" => $singularComment['author']
                ];
                array_splice($comments_data['results'], $key + 1, 0, [$formattedComment]);
                $already_replied[] = $reply['id'];
                checkreplies();
            }
        }
    }
}

checkreplies();



if (isset($_POST['comment_submit'])) {
    if (!$user->isLoggedIn()) {
        echo "Please log in to add a comment.";
        exit;
    }
    if (isset($_POST['reply_to'])) {
        $reply_to = $_POST['reply_to'];
    } else {
        $reply_to = null;
    }
    $user_id = $user->getUid();
    $content = $_POST['comment'];

    if ($reply_to !== null) {
        $comment->addComment($user_id, $reply_to, $content);
        header("Location: /cinetech/info/{$type}/{$id}");
    } else {
        $comment->addComment($user_id, $id, $content);
        header("Location: /cinetech/info/{$type}/{$id}");
    }
}


?>
<script>
document.addEventListener("DOMContentLoaded", function(event) {
    const commentContainer = document.querySelector('.comments-container');
    const allComments = <?php echo json_encode($comments_data); ?>;
    const commentCharLimit = 200;
    const initialCommentsToShow = 5;
    const isuseradmin = <?php echo $isadmin; ?>;
    let currentCommentsShown = initialCommentsToShow;

    if (!allComments.results || allComments.results.length === 0) {
        commentContainer.innerHTML = '<p>No comments available.</p>';
        return;
    }

    function escapeHtml(text) {
        const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return text.replace(/[&<>"']/g, function(m) { return map[m]; });
    }

    function nl2br(str) {
        return str.replace(/\n/g, '<br>');
    }

    function renderComment(commentData) {
        
        const commentDiv = document.createElement('div');
        commentDiv.classList.add('comment');

        const replyForm = document.createElement('form');
        replyForm.classList.add('reply-form');
        replyForm.setAttribute('method', 'POST');

        const replyTo = document.createElement('input');
        replyTo.setAttribute('type', 'hidden');
        replyTo.setAttribute('name', 'reply_to');
        replyTo.setAttribute('value', commentData.id);
        replyForm.appendChild(replyTo);

        const replyInput = document.createElement('input');
        replyInput.setAttribute('type', 'text');
        replyInput.setAttribute('name', 'comment');
        replyInput.setAttribute('placeholder', 'Reply to ' + commentData.author);
        replyForm.appendChild(replyInput);

        const replyButton = document.createElement('button');
        replyButton.setAttribute('type', 'submit');
        replyButton.classList.add('reply-button');
        replyButton.setAttribute('name', 'comment_submit');
        replyButton.textContent = 'Reply';
        replyForm.appendChild(replyButton);

        
        const headerDiv = document.createElement('div');
        headerDiv.classList.add('comment-header');
        if (isuseradmin && commentData.local_comment) {
            const DeleteButton = document.createElement('button');
            DeleteButton.classList.add('delete-button');
            DeleteButton.textContent = 'Delete';
            DeleteButton.addEventListener('click', function() {
                window.location.href = `/cinetech/delete/comment/${commentData.id}`;
            });
            commentDiv.appendChild(DeleteButton);
        }

        const authorSpan = document.createElement('span');
        authorSpan.classList.add('comment-author');
        authorSpan.textContent = commentData.author || 'Anonymous';

        headerDiv.appendChild(authorSpan);

        if (commentData.created_at) {
            const dateSpan = document.createElement('span');
            dateSpan.classList.add('comment-date');
            const date = new Date(commentData.created_at);
            dateSpan.textContent = date.toLocaleString();
            headerDiv.appendChild(dateSpan);
        }

        if (commentData.reply_to) {
            const replyToSpan = document.createElement('span');
            replyToSpan.classList.add('comment-reply-to');
            replyToSpan.textContent = 'Replying to ' + commentData.reply_to;
            headerDiv.appendChild(replyToSpan);
            commentDiv.classList.add('reply');
        }

        commentDiv.appendChild(headerDiv);

        const commentTextP = document.createElement('p');
        commentTextP.classList.add('comment-text');
        commentTextP.innerHTML = nl2br(escapeHtml(commentData.content));

        commentDiv.appendChild(commentTextP);

        // Apply read more/hide functionality
        const originalText = commentData.content;
        if (originalText.length > commentCharLimit) {
            const truncatedText = originalText.slice(0, commentCharLimit) + '...';
            commentTextP.innerHTML = nl2br(escapeHtml(truncatedText));

            const readMoreButton = document.createElement('button');
            readMoreButton.classList.add('read-more-button');
            readMoreButton.textContent = 'See More';
            commentDiv.appendChild(readMoreButton);

            const hideButton = document.createElement('button');
            hideButton.classList.add('hide-button');
            hideButton.textContent = 'Hide';
            hideButton.style.display = 'none';
            commentDiv.appendChild(hideButton);

            

            readMoreButton.addEventListener('click', function() {
                commentTextP.innerHTML = nl2br(escapeHtml(originalText));
                readMoreButton.style.display = 'none';
                hideButton.style.display = 'inline-block';
            });

            hideButton.addEventListener('click', function() {
                commentTextP.innerHTML = nl2br(escapeHtml(truncatedText));
                hideButton.style.display = 'none';
                readMoreButton.style.display = 'inline-block';
            });
        }
        commentDiv.appendChild(replyForm);

        return commentDiv;
    }

    function renderComments(startIndex, endIndex) {
        const fragment = document.createDocumentFragment();

        endIndex = Math.min(endIndex, allComments.results.length);
        for (let i = startIndex; i < endIndex; i++) {
            const commentData = allComments.results[i];
            const commentElement = renderComment(commentData);
            fragment.appendChild(commentElement);
        }

        commentContainer.appendChild(fragment);
    }

    // Initially render first 'initialCommentsToShow' comments
    renderComments(0, initialCommentsToShow);

    // If there are more comments, add 'See more' button
    if (allComments.results.length > currentCommentsShown) {
        const seeMoreButton = document.createElement('button');
        seeMoreButton.classList.add('see-more-button');
        seeMoreButton.textContent = 'See More Comments';
        const seeMoreContainer = document.querySelector('.see-more-container');
        seeMoreContainer.appendChild(seeMoreButton);

        seeMoreButton.addEventListener('click', function() {
            const previousCommentsShown = currentCommentsShown;
            currentCommentsShown += 5;
            if (currentCommentsShown >= allComments.results.length) {
                currentCommentsShown = allComments.results.length;
                seeMoreButton.remove();
            }
            renderComments(previousCommentsShown, currentCommentsShown);
        });
    }
});
</script>