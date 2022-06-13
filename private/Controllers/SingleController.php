<?php

namespace Jerome\Blog\Controllers;

use Jerome\Blog\App\Database;
use Jerome\Blog\App\HitsManager;
use Jerome\Blog\App\RespondWith;
use ParsedownExtra;

class SingleController {

    public static function index(string $slug): void {
        if(array_key_exists('edit', $_GET) && ($_SESSION['logged_in'] ?? false)) RespondWith::redirect("/admin/$slug");

        $post = Database::query('
            SELECT *
            FROM posts
            WHERE
                slug = :slug AND
                date <= DATE() AND
                published > 0
        ', [
            'slug' => $slug
        ]);

        if(!$post) RespondWith::error_page(404);
        $post = $post[0];

        $read_time = round(count(explode(' ', $post['content'])) / 200);

        // $parser = new CustomMarkdownParser();
        $parser = new ParsedownExtra();
        $post['content'] = $parser->parse($post['content']);

        HitsManager::record($slug);
        $post['hits']++;

        view('single', post: $post, read_time: $read_time);
    }

}