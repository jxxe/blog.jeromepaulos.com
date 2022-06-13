<?php /**
 * @var array $post
 * @var int $read_time
 */?>

<?php view('parts/header', title: $post['title'], body: 'single') ?>

<main id="post">
    <header>
        <h1><?= htmlspecialchars($post['title']) ?></h1>

        <div>
            <p>Date Published</p>
            <time datetime="<?= $post['date'] ?>"><?= format_date('M j, Y', $post['date']) ?></time>
        </div>

        <div>
            <p>Time Commitment</p>
            <p><?= $read_time ?> minute<?= s($read_time) ?></p>
        </div>

        <div>
            <p>Ego Number</p>
            <p><?= number_format($post['hits']) ?> view<?= s($post['hits']) ?></p>
        </div>
    </header>

    <article>
        <?= $post['content'] ?>
    </article>
</main>

<?php view('parts/footer') ?>