<?php /* Template Name: Template "Contact" */ ?>
<?php get_header(); ?>
    <h2>Me contacter</h2>
    <?php 
    // On ouvre "la boucle" (The Loop), la structure de contrôle
    // de contenu propre à Wordpress:
    if(have_posts()): while(have_posts()): the_post(); ?>

        <section class="contact">
            <div class="contact__content">
                <?php the_content(); ?>
            </div>
            <div class="contact__form">
                <?= do_shortcode('[contact-form-7 id="e2c5c18" title="Contact form 1"]'); ?>
            </div>
        </section>

    <?php 
    // On ferme "la boucle" (The Loop):
    endwhile; else: ?>
        <p>Pas de contenu à afficher.</p>
    <?php endif; ?>
<?php get_footer(); ?>