<?php get_header(); ?>

<style type="text/css">
    .recipe {
        display: flex;
        flex-direction: row-reverse;
        justify-content: space-between;
    }
    .recipe__ingredients {
        width: 320px;
        padding: 20px;
        background: #f1f1f1;
    }
</style>

    <?php 
    // On ouvre "la boucle" (The Loop), la structure de contrôle
    // de contenu propre à Wordpress:
    if(have_posts()): while(have_posts()): the_post(); ?>

        <h2><?= get_the_title(); ?></h2>

        <div class="recipe">
            
            <aside class="recipe__ingredients">
                <h3>Ingrédients</h3>
                <p>À compléter...</p>
            </aside>

            <section class="recipe__steps">
                <h3>Étapes</h3>
                <div><?php the_content(); ?></div>
            </section>

        </div>

    <?php 
    // On ferme "la boucle" (The Loop):
    endwhile; else: ?>
        <p>Cette recette n'existe pas...</p>
    <?php endif; ?>
<?php get_footer(); ?>