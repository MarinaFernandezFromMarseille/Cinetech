<?php foreach ($movies['results'] as $movie): ?>
    <h2><?php echo $movie['title']; ?></h2>
    <p><?php echo $movie['overview']; ?></p>
<?php endforeach; ?>
