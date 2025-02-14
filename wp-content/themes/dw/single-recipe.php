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
        display: flex;
        flex-direction: column-reverse;
    }
    .recipe__fig {
        display: block;
        position: relative;
        width: 100%;
        height: 0;
        padding-top: 100%;
        margin: 0;
    }
    .recipe__img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>

    <?php 
    // On ouvre "la boucle" (The Loop), la structure de contrôle
    // de contenu propre à Wordpress:
    if(have_posts()): while(have_posts()): the_post(); ?>

        <h2><?= get_the_title(); ?></h2>

        <p><?= get_the_excerpt(); ?></p>

        <div class="recipe">
            
            <aside class="recipe__ingredients">
                <div>
                    <h3>Ingrédients</h3>
                    <p>À compléter...</p>
                </div>
                <figure class="recipe__fig">
                    <?= get_the_post_thumbnail(size: 'medium', attr: ['class' => 'recipe__img']); ?>
                </figure>
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