<?php /* @var string $title */ ?>

<!DOCTYPE html>
<html lang="en" data-ambiance="<?= $ambiance = get_ambiance_string($_ENV['WEATHER_ENDPOINT']) ?>">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= htmlspecialchars(empty($title) ? '' : "$title — ") ?><?= $_ENV['SITE_TITLE'] ?></title>
    <meta name="description" content="This is Jerome Paulos' personal blog">
    <link rel="shortcut icon" href="https://emojicdn.elk.sh/duck">

    <link rel="stylesheet" href="/dist/style.css">
    <link rel="stylesheet" href="https://use.typekit.net/jsm6zml.css">
</head>
<body>

<header id="header">
    <div>
        <a href="/"><h1>Hey, I’m Jerome</h1></a>
        <span>It’s a <?= $ambiance ?> in <abbr title="I'm currently in Saint Paul, Minnesota">St Paul</abbr></span>
    </div>

    <img src="/dist/selfie.webp" alt>
</header>