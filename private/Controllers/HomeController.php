<?php

namespace Jerome\Blog\Controllers;

use Jerome\Blog\App\Database;
use DateTime;

class HomeController {

    public static function index(): void {
        $posts = Database::query('
            SELECT title, slug, date, tutorial
            FROM posts
            WHERE
                date <= DATE() AND
                published > 0 AND
                tutorial = 0
            ORDER BY date DESC
            LIMIT 10
        ');

        view('home', posts: $posts);
    }

}