<?php  /**
 * @var array $posts
 * @var string $title
 */ ?>

<?php view('parts/header', title: $title ?? 'Archive', body: 'archive') ?>

<main>
    <h1><?= $title ?? 'Archive' ?></h1>

    <?php if($posts): ?>
        <ul class="posts">
            <?php foreach($posts as $post): ?>
                <li>
                    <a href="/posts/<?= $post['slug'] ?>"><?= htmlspecialchars($post['title']) ?></a>
                    <time datetime="<?= $post['date'] ?>"><?= format_date('M j, Y', $post['date']) ?></time>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No posts found</p>
    <?php endif; ?>

    <?php if($_SERVER['REQUEST_URI'] === '/posts'): ?>
        <hr>

        <p>
            <em>
                I also write <a href="/tutorials">strictly-technical</a> blog posts. They're designed to be found while frantically Googling. Given how much I owe to others' online resources, it’s only fair that I contribute some myself.
            </em>
        </p>
    <?php endif; ?>
</main>

<?php view('parts/footer') ?>
