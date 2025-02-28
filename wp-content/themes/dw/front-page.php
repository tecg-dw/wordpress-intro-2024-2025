<?php get_header(); ?>
    
    <style type="text/css">
        .sro {
            position: absolute; 
            overflow: hidden; 
            clip: rect(0 0 0 0); 
            height: 1px; width: 1px; 
            margin: -1px; 
            padding: 0; 
            border: 0;
        }
        .trips {
            display: flex;
            flex-direction: row;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 1em;
        }
        .story {
            position: relative;
            width: calc((100% - 3em)/4);
        }
        .story__link {
            display: block;
            position: absolute;
            top:0;
            left:0;
            right:0;
            bottom:0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }
        /* L'effet hover s'applique sur la carte qui "suit" le "a" */
        .story__link:hover + .story__card,
        .story__link:focus + .story__card {
            transform: translate3d(0,-4px,0);
        }
        .story__card {
            display: block;
            background: white;
            border-radius: 4px;
            -webkit-box-shadow: 0px 4px 5px 0px rgba(0,0,0,0.14);
            -moz-box-shadow: 0px 4px 5px 0px rgba(0,0,0,0.14);
            box-shadow: 0px 4px 5px 0px rgba(0,0,0,0.14);
            border: 1px solid rgba(0,0,0,0.04);
            display: flex;
            flex-direction: column-reverse;
            overflow: hidden;
            transition: transform 200ms ease-out;
        }
        .story__fig {
            display: block;
            margin: 0;
            padding: 0;
            height: 0;
            padding: 60% 0 0 0;
            position: relative;
        }
        .story__thumb {
            display: block;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .story__head {
            padding: 0 1em;
        }
    </style>

    <h2>Bienvenue sur mon site&nbsp;!</h2>
    <?php 
    // On ouvre "la boucle" (The Loop), la structure de contrôle
    // de contenu propre à Wordpress:
    if(have_posts()): while(have_posts()): the_post(); ?>

        <div><?php the_content(); ?></div>

    <?php 
    // On ferme "la boucle" (The Loop):
    endwhile; else: ?>
        <p>Pas de contenu à afficher.</p>
    <?php endif; ?>

    <section>
        <h2>Récits de voyage</h2>

        <div class="trips">
        <?php

        $trips = new WP_Query([
            'post_type' => 'trip',
            'order' => 'DESC',
            'orderby' => 'date',
            'posts_per_page' => 8,
        ]);

        if($trips->have_posts()): while($trips->have_posts()): $trips->the_post(); ?>
            <article class="story">
                <?php /* Le "a" est en dehors de la carte "story__card" afin de pouvoir
                        garder un lien propre (accessibilité), rajouter du contenu utile
                        (référençabilité) tout en gardant un design attractif. */ ?>
                <a href="<?= get_permalink(); ?>" class="story__link">
                    <span class="sro">Découvrez mon voyage "<?= get_the_title(); ?>"</span>
                </a>
                <div class="story__card">
                    <header class="story__head">
                        <h3><?= get_the_title(); ?></h3>
                        <p><time datetime="<?= date('c', $departure = get_field('departure')); ?>"><?= date_i18n('F Y', $departure); ?></time></p>
                    </header>
                    <figure class="story__fig">
                        <?= get_the_post_thumbnail(size: 'medium', attr: ['class' => 'story__thumb']); ?>
                    </figure>
                </div>
            </article>
        <?php endwhile; else: ?>
            <p>Je n'ai aucun voyage à vous montrer pour l'instant.</p>
        <?php endif; ?>
        </div>
    </section>
<?php get_footer(); ?>