<?php

namespace Jerome\Blog\App;

abstract class HitsManager {

    public static function record(string $slug): void {
        if($_SESSION['recorded'] ?? false) return;
        $_SESSION['recorded'] = true;

        Database::query('
            UPDATE posts
            SET hits = hits + 1
            WHERE slug = :slug
        ', [
            'slug' => $slug
        ]);
    }

    public static function record_stat(string $slug): void {
        if($_SESSION['recorded'] ?? false) return;
        $_SESSION['recorded'] = true;

        $sample_rate = 5;

        if(rand(1, $sample_rate) === 1) {
            Database::query('
                UPDATE posts
                SET hits = hits + :increment
                WHERE slug = :slug
            ', [
                'slug' => $slug,
                'increment' => rand($sample_rate-1, $sample_rate+1)
            ]);
        }
    }

}