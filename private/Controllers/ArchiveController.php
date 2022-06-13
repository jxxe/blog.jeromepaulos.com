<?php

namespace Jerome\Blog\Controllers;

use Jerome\Blog\App\Database;
use DateTime;

class ArchiveController {

    public static function index(): void {
        $posts = Database::query('
            SELECT title, slug, date
            FROM posts
            WHERE
                date <= DATE() AND
                published > 0 AND
                tutorial = 0
            ORDER BY date DESC
        ');

        view('archive', title: 'Posts', posts: $posts);
    }

    public static function tutorials(): void {
        $posts = Database::query('
            SELECT title, slug, date
            FROM posts
            WHERE
                date <= DATE() AND
                published > 0 AND
                tutorial > 0
            ORDER BY date DESC
        ');

        view('archive', title: 'Tutorials', posts: $posts);
    }

}