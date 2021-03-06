<?php

namespace Jerome\Blog\Controllers;

use Jerome\Blog\App\RespondWith;

class AuthController {

    public static function login_page(bool $error = false): void {
        if($_SESSION['logged_in'] ?? false) RespondWith::redirect('/admin');
        view('login', error: $error);
    }

    public static function POST_login(): void {
        if(
            empty($_POST['email']) ||
            trim(strtolower($_POST['email'])) !== strtolower($_ENV['EMAIL']) ||

            empty($_POST['password']) ||
            !password_verify($_POST['password'], $_ENV['PASSWORD'])
        ) {
            self::login_page(true);
        } else {
            $_SESSION['logged_in'] = true;
            RespondWith::redirect('/admin');
        }
    }

    public static function logout(): void {
        session_destroy();
        RespondWith::redirect('/login');
    }

    public static function guard(): void {
        if(!($_SESSION['logged_in'] ?? false)) {
            RespondWith::redirect('/login');
        }
    }

}