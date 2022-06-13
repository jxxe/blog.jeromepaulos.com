<?php

use Jerome\Blog\App\MemoryCache;
use Jerome\Blog\App\Paths;

/**
 * Render a specific PHP view
 * @param string $_name The path of the view, excluding extension and preceding directories
 * @param mixed ...$_args Use named parameters to pass arguments to the view
 * @return void
 */
function view(string $_name, mixed ...$_args): void {
    extract($_args);
    require Paths::PRIVATE . '/views/' . $_name . '.php';
}

/**
 * Add an s if the number requires it
 * @param int $n
 * @return string
 */
function s(int $n): string {
    return $n != 1 ? 's' : '';
}

/**
 * Generate a slug from a given string
 * @param string $text
 * @return string
 */
function slugify(string $text): string {
    $slug = strtolower($text);

    $slug = preg_replace('/[^\da-z- ]/', '-', $slug);
    $slug = str_replace(' ', '-', $slug);
    $slug = preg_replace('/-+/', '-', $slug);

    $slug = str_replace('-', ' ', $slug);
    $slug = trim($slug);
    $slug = str_replace(' ', '-', $slug);

    return $slug;
}

/**
 * @param string $endpoint
 * @param string|null $timezone
 * @return string
 */
function get_ambiance_string(string $endpoint, string $timezone = null): string {
    return MemoryCache::fetch('ambiance_string', 60*15, function() use($endpoint, $timezone) {
        $context = stream_context_create(['http' => ['header' => 'User-Agent: ' . $_ENV['EMAIL']]]);
        $data = json_decode(file_get_contents($endpoint, context: $context), true);

        $temperature = $data['properties']['periods'][0]['temperature'];
        $wind_speed = str_replace(' mph', '', $data['properties']['periods'][0]['windSpeed']);

        $old_timezone = date_default_timezone_get();
        date_default_timezone_set($timezone ?? $_ENV['TIME_ZONE']);

        $adjective = match(true) {
            $temperature <= 10 => 'freezing',
            $temperature <= 25 => 'frigid',
            $temperature <= 40 => 'cold',
            $temperature <= 50 => 'chilly',
            $temperature <= 70 => 'pleasant',
            $temperature <= 75 => 'warm',
            $temperature <= 90 => 'hot',
            $temperature <= 100 => 'blistering',
            $temperature > 100 => 'scorching'
        };

        if($wind_speed >= 25 && $adjective === 'pleasant') {
            $adjective = 'blustery';
        }

        $today = time();

        $spring = strtotime('March 20');
        $summer = strtotime('June 20');
        $fall = strtotime('September 22');
        $winter = strtotime('December 21');

        $season = match(true) {
            $today >= $spring && $today < $summer => 'spring',
            $today >= $summer && $today < $fall => 'summer',
            $today >= $fall && $today < $winter => 'fall',
            default => 'winter'
        };

        $morning = strtotime('6:00 AM');
        $day = strtotime('12:00 PM');
        $afternoon = strtotime('2:00 PM');
        $evening = strtotime('5:45 PM');
        $night = strtotime('8:00 PM');

        $time = match(true) {
            $today >= $morning && $today < $day => 'morning',
            $today >= $day && $today < $afternoon => 'day',
            $today >= $afternoon && $today < $evening => 'afternoon',
            $today >= $evening && $today < $night => 'evening',
            default => 'night'
        };

        date_default_timezone_set($old_timezone);

        $value = "$adjective $season $time";
        apcu_add('ambiance_string', $value, 60*15);

        return $value;
    });
}

/**
 * Like {@link gmdate()} but for any date format
 * @param string $format
 * @param string $date
 * @return string
 */
function format_date(string $format, string $date): string {
    return date_format(date_create($date), $format);
}