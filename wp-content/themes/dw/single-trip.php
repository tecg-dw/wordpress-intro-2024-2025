<?php get_header(); ?>

<style type="text/css">
    .trip__header {
        height: 400px;
        width: 100%;
        position: relative;
    }
    .trip__back,
    .trip__back:before,
    .trip__head {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }
    .trip__back {
        z-index: 0;
        margin: 0;
        padding: 0;
    }
    .trip__back:before {
        content:'';
        display: block;
        background: rgb(100,20,40);
        opacity: 0.6;
    }
    .trip__cover {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .trip__head {
        z-index: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color: white;
    }
    .trip__container {
        display: flex;
        flex-direction: row-reverse;
        justify-content: space-between;
    }
    .trip__ingredients {
        width: 320px;
        padding: 20px;
        background: #f1f1f1;
        display: flex;
        flex-direction: column-reverse;
    }
    .trip__fig {
        display: block;
        position: relative;
        width: 100%;
        height: 0;
        padding-top: 100%;
        margin: 0;
    }
    .trip__img {
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

        <div class="trip">

            <header class="trip__header">
                <div class="trip__head">        
                    <h2><?= get_the_title(); ?></h2>
                    <p><?= get_the_excerpt(); ?></p>
                </div>
                <figure class="trip__back">
                    <?= get_the_post_thumbnail(size: 'trip-header', attr: ['class' => 'trip__cover']); ?>
                </figure>
            </header>

            <div class="trip__container">
                <aside class="trip__ingredients">
                    <div>
                        <h3>Points-clés</h3>
                        <p>À compléter...</p>
                    </div>
                    <figure class="trip__fig">
                        <?= get_the_post_thumbnail(size: 'trip-side', attr: ['class' => 'trip__img']); ?>
                    </figure>
                </aside>

                <section class="trip__steps">
                    <h3>Récit de voyage</h3>
                    <div><?php the_content(); ?></div>
                </section>
            </div>

        </div>

    <?php 
    // On ferme "la boucle" (The Loop):
    endwhile; else: ?>
        <p>Cette recette n'existe pas...</p>
    <?php endif; ?>
<?php get_footer(); ?>