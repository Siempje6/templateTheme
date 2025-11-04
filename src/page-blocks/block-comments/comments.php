<?php
if (!defined('ABSPATH')) exit;

$intro_text       = get_sub_field('intro_text');
$background_color = get_sub_field('background_color') ?: '';
$show_comments    = get_sub_field('show_comments');
?>

<section class="acf-comment-block" style="background-color: <?php echo esc_attr($background_color); ?>;">
    <div class="acf-comment-inner">
        <?php if ($intro_text): ?>
            <p class="acf-comment-intro"><?php echo esc_html($intro_text); ?></p>
        <?php endif; ?>

        <div id="acf-comment-toggle">
            <button id="show-comments-btn" class="acf-btn"><?php _e('Bekijk reacties', 'textdomain'); ?></button>
            <button id="show-form-btn" class="acf-btn" style="display:none;"><?php _e('Nieuwe reactie schrijven', 'textdomain'); ?></button>
        </div>

        <!-- ✅ Reactieformulier -->
        <div id="acf-comment-form">
            <?php
            if (comments_open()) {
                comment_form([
                    'title_reply'          => __('Laat een reactie achter', 'textdomain'),
                    'label_submit'         => __('Verzenden', 'textdomain'),
                    'comment_notes_before' => '',
                    'comment_notes_after'  => '',
                    'fields'               => [
                        'author' => '<p class="comment-form-author"><label for="author">' . __('Naam', 'textdomain') . '</label> ' .
                            '<input id="author" name="author" type="text" value="" size="30" required /></p>',
                        'email'  => '<p class="comment-form-email"><label for="email">' . __('E-mail', 'textdomain') . '</label> ' .
                            '<input id="email" name="email" type="email" value="" size="30" required /></p>',
                    ],
                    'comment_field' => '<p class="comment-form-comment"><label for="comment">' . __('Bericht', 'textdomain') . '</label>' .
                        '<textarea id="comment" name="comment" rows="5" required></textarea></p>',
                ]);
            } else {
                echo '<p>' . __('Reacties zijn gesloten voor dit bericht.', 'textdomain') . '</p>';
            }
            ?>
        </div>

        <!-- ✅ Reacties tonen -->
        <div id="acf-comment-list" style="display:none;">
            <?php
            if ($show_comments) {
                // Dit laadt automatisch alle bestaande reacties inclusief moderatie, threading, enz.
                comments_template();
            }
            ?>
        </div>
    </div>
</section>

<style>
.acf-comment-block {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    padding: 40px 20px;
    border-radius: 10px;
    margin: 40px auto;
    max-width: 800px;
}

.acf-comment-intro {
    font-size: 1.1rem;
    margin-bottom: 1.5rem;
    color: #444;
}

.comment-form label {
    display: block;
    font-weight: 600;
    margin-bottom: 4px;
}

.comment-form input[type="text"],
.comment-form input[type="email"],
.comment-form textarea {
    max-width: 97%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 6px;
    margin-bottom: 15px;
    font-size: 1rem;
}

.comment-form input[type="submit"] {
    background-color: #1a5428;
    color: #fff;
    padding: 10px 20px;
    border-radius: 6px;
    border: none;
    cursor: pointer;
}

.comment-form input[type="submit"]:hover {
    background-color: #005f8d;
}

.acf-comment-list-inner {
    margin-top: 30px;
}

.acf-comment-list-inner .comment {
    padding: 15px 0;
    border-bottom: 1px solid #eee;
}

.acf-comment-list-inner .comment-author {
    font-weight: 600;
}

.acf-comment-list-inner .comment-meta {
    font-size: 0.85rem;
    color: #777;
}

.acf-btn {
    background-color: #f1f1f1;
    border: 1px solid #ccc;
    color: #333;
    padding: 8px 15px;
    border-radius: 5px;
    cursor: pointer;
    margin-bottom: 15px;
}

.acf-btn:hover {
    background-color: #e2e2e2;
}

@media (max-width: 768px) {
    .acf-comment-block {
        padding: 20px 10px;
    }
}


</style>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("acf-comment-form");
    const list = document.getElementById("acf-comment-list");
    const showCommentsBtn = document.getElementById("show-comments-btn");
    const showFormBtn = document.getElementById("show-form-btn");

    if (showCommentsBtn) {
        showCommentsBtn.addEventListener("click", function() {
            form.style.display = "none";
            list.style.display = "block";
            showCommentsBtn.style.display = "none";
            showFormBtn.style.display = "inline-block";
        });
    }

    if (showFormBtn) {
        showFormBtn.addEventListener("click", function() {
            form.style.display = "block";
            list.style.display = "none";
            showFormBtn.style.display = "none";
            showCommentsBtn.style.display = "inline-block";
        });
    }

    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('unapproved') || urlParams.has('moderation-hash')) {
        form.style.display = "none";
        list.style.display = "block";
        showCommentsBtn.style.display = "none";
        showFormBtn.style.display = "inline-block";
    }
});
</script>


<style>
    .comment-body {
    background-color: #fff;
    border: 1px solid #e5e5e5;
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    transition: box-shadow 0.2s ease-in-out, transform 0.2s ease-in-out;
}

.comment-body:hover {
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    transform: translateY(-2px);
}

.comment-author {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}

.comment-author img {
    border-radius: 50%;
    margin-right: 10px;
    width: 40px;
    height: 40px;
    object-fit: cover;
}

.comment-author .fn {
    font-weight: 600;
    color: #222;
    text-decoration: none;
}

.comment-author .fn a {
    color: #1a5428;
    text-decoration: none;
}

.comment-author .fn a:hover {
    text-decoration: underline;
}

.comment-author .says {
    color: #666;
    font-size: 0.9rem;
    margin-left: 5px;
}

.comment-meta {
    font-size: 0.85rem;
    color: #888;
    margin-bottom: 10px;
}

.comment-meta a {
    color: #999;
    text-decoration: none;
}

.comment-meta a:hover {
    color: #1a5428;
    text-decoration: underline;
}

.comment-body p {
    color: #333;
    font-size: 1rem;
    line-height: 1.5;
    margin-bottom: 10px;
}

.comment-body .reply {
    text-align: right;
}

.comment-body .reply a {
    font-size: 0.9rem;
    color: #1a5428;
    text-decoration: none;
    padding: 4px 10px;
    border-radius: 5px;
    background: #f0f8ff;
    transition: all 0.2s ease-in-out;
}

.comment-body .reply a:hover {
    background-color: #1a5428;
    color: #fff;
}

@media (max-width: 600px) {
    .comment-body {
        padding: 15px;
    }

    .comment-author img {
        width: 32px;
        height: 32px;
    }

    .comment-body p {
        font-size: 0.95rem;
    }

    .comment-body .reply {
        text-align: left;
        margin-top: 10px;
    }
}

.acf-btn {
    background-color: #1a5428;
    border-radius: 50px;
    border: none;
    color: #fff;
}
.acf-btn:hover {
    background-color: #1a5428d1;
    border-radius: 50px;
    border: none;
    color: #fff;
}

</style>