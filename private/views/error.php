<?php /**
* @var int $code
 */

use Jerome\Blog\App\RespondWith; ?>

<?php view('parts/header', title: 'Error') ?>

<main>
    <h1><?= RespondWith::code_to_name($code) ?></h1>
</main>

<?php view('parts/footer') ?>
