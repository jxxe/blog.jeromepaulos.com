<?php /**
 * @var array[] $posts
 * @var int $comments_all_time
 * @var int $posts_this_week
 */ ?>

<?php view('parts/header', title: 'Admin') ?>

<main id="admin">
    <header>
        <h1>Admin</h1>
        <div>
            <a href="/logout" class="button">Logout</a>
            <a href="/admin/new" class="button">New</a>
        </div>
    </header>

    <?php if($posts): ?>
        <ul class="posts">
            <?php foreach($posts as $post): ?>
                <li>
                    <a href="/admin/<?= $post['slug'] ?>"><?= htmlspecialchars($post['title']) ?></a>
                    <?php if($post['published'] || $post['tutorial']): ?>
                        <time datetime="<?= $post['date'] ?>"><?= format_date('M j, Y', $post['date']) ?></time>
                    <?php else: ?>
                        <span>Draft</span>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No posts found</p>
    <?php endif; ?>
</main>

<script>
    window.history.replaceState(null, null, window.location.href);
</script>

<?php view('parts/footer') ?>