<?php
// search_engine.php (new file to handle search logic)

$input = strtolower(trim($_GET['genre'] ?? ''));

$genreMap = [
  'abs' => ['abs', 'core', 'ab', 'abdominal'],
  'cardio' => ['cardio', 'running', 'aerobic'],
  'strength' => ['strength', 'weight', 'power', 'resistance'],
  'stretching' => ['stretch', 'flex', 'mobility','streach'],
  'wellness' => ['wellness', 'yoga', 'relax', 'recovery'],
];

$matched = '';

foreach ($genreMap as $genre => $keywords) {
    foreach ($keywords as $keyword) {
        if (str_contains($input, $keyword)) {
            $matched = $genre;
            break 2; // exit both loops
        }
    }
}

if ($matched) {
    header("Location: gallery.php?genre=$matched");
    exit;
} else {
    header("Location: gallery.php?genre=invalid");
    exit;
}
?>
