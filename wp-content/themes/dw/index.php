<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= wp_title('·', false, 'right') . get_bloginfo('name') ?></title>
</head>
<body>
    <header>
        <h1><?= get_bloginfo('name') ?></h1>
        <p><?= get_bloginfo('description') ?></p>
    </header>

    <main>
        <?php 
        // On ouvre "la boucle" (The Loop), la structure de contrôle
        // de contenu propre à Wordpress:
        if(have_posts()): while(have_posts()): the_post(); ?>

            <h2><?= get_the_title(); ?></h2>

            <div><?= get_the_content(); ?></div>

        <?php 
        // On ferme "la boucle" (The Loop):
        endwhile; else: ?>
            <p>Pas de contenu à afficher.</p>
        <?php endif; ?>
    </main>
</body>
</html>