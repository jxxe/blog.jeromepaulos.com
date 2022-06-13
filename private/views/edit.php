<?php /**
 * @var array $post
 * @var bool $error
 */ ?>

<?php view('parts/header', title: 'Edit Post') ?>

<main id="edit">
    <header>
        <h1>Edit Post</h1>
        <div>
            <?php if($post['slug'] ?? false): ?>
                <a href="/posts/<?= $post['slug'] ?>" class="button">View</a>
            <?php endif; ?>

            <a href="/admin" class="button">Admin</a>
        </div>
    </header>

    <form method="POST">
        <input maxlength="255" name="title" placeholder="Title" required type="text" value="<?= $post['title'] ?? '' ?>">
        <input name="slug" placeholder="slug" required type="text" value="<?= $post['slug'] ?? '' ?>" <?= ($post['slug'] ?? false) ? 'disabled' : '' ?>>

        <div class="buttons">
            <input name="date" step="1" required type="date" value="<?= $post['date'] ?? date('Y-m-d') ?>">
            <select name="status">
                <option value="draft" <?= !($post['published'] ?? false) ? 'selected' : '' ?>>Draft</option>
                <option value="published" <?= ($post['published'] ?? false) && !($post['tutorial'] ?? false) ? 'selected' : '' ?>>Published</option>
                <option value="tutorial" <?= ($post['tutorial'] ?? false) && ($post['published'] ?? false) ? 'selected' : '' ?>>Tutorial</option>
                <option value="delete">Delete</option>
            </select>
            <button class="save">Save</button>
        </div>

        <textarea id="markdown-editor" name="content" placeholder="Start typing..." required><?= $post['content'] ?? '' ?></textarea>
    </form>
</main>

<script src="/dist/editor.js"></script>

<?php view('parts/footer') ?>
