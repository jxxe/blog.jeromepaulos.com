<?php /**
 * @var array $posts
 * @var string $ambiance
 */ ?>

<?php view('parts/header') ?>

<main id="home">

    <p>I'm a developer and multimedia journalist from Berkeley, California. I was a senior at Berkeley High School and will be attending Macalester College in St Paul, Minnesota this fall.</p>
    <p>Previously, I was the web editor and a <a href="https://jeromepaulos.com">photographer</a> for my high school newspaper, the <a href="https://berkeleyhighjacket.com/"><em>Berkeley High Jacket</em></a>. I've also been a news platforms intern at <a href="https://citysidejournalism.org/about/">Berkeleyside</a> for two summers, and a data "science" intern at the <a href="https://www.sfaf.org/">San Francisco AIDS Foundation</a>.</p>
    <p>Feel free to send me an email, it would make my day. It's not weird unless you make it weird, I promise: <a href="mailto:hello@jeromepaulos.com">hello@jeromepaulos.com</a>.</p>

    <hr>

    <p>This website is dynamic and changes with the weather, season, and time. It's home to my personal blog, which I try to update a few times a month. I also write <a href="/tutorials">strictly-technical</a> blog posts that are designed to be found through Google.</p>

    <?php if($posts): ?>
        <hr>

        <ul class="posts">
            <?php foreach($posts as $post): ?>
                <li>
                    <a href="/posts/<?= $post['slug'] ?>"><?= htmlspecialchars($post['title']) ?></a>
                    <time datetime="<?= $post['date'] ?>"><?= format_date('M j, Y', $post['date']) ?></time>
                </li>
            <?php endforeach; ?>
        </ul>

        <p class="load-more">
            <a href="/posts">more posts</a>
        </p>
    <?php else: ?>
        <p>No posts found</p>
    <?php endif; ?>

</main>

<?php view('parts/footer') ?>