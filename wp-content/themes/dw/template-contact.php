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
                <form action="<?= esc_url(admin_url('admin-post.php')); ?>" method="POST" class="form">
                    <fieldset class="form__fields">
                        <div class="field">
                            <label for="firstname" class="field__label">Prénom</label>
                            <input type="text" name="firstname" id="firstname" class="field__input">
                        </div>
                        <div class="field">
                            <label for="lastname" class="field__label">Nom</label>
                            <input type="text" name="lastname" id="lastname" class="field__input">
                        </div>
                        <div class="field">
                            <label for="email" class="field__label">Adresse mail</label>
                            <input type="email" name="email" id="email" class="field__input">
                        </div>
                        <div class="field">
                            <label for="subject" class="field__label">Sujet</label>
                            <input type="text" name="subject" id="subject" class="field__input">
                        </div>
                        <div class="field">
                            <label for="message" class="field__label">Message</label>
                            <textarea name="message" id="message" class="field__input"></textarea>
                        </div>
                    </fieldset>
                    <div class="form__submit">
                        <?php
                        // Cet input hidden permet de spécifier à WP (via l'appel d'URL "admin-post.php") que c'est notre fonction de traitement "dw_handle_contact_form_submit" qu'il faut appeler lorsque ces données seront envoyées.
                        ?>
                        <input type="hidden" name="action" value="dw_contact_form_submit">
                        <button type="submit" class="btn">Envoyer</button>
                    </div>
                </form>
            </div>
        </section>

    <?php 
    // On ferme "la boucle" (The Loop):
    endwhile; else: ?>
        <p>Pas de contenu à afficher.</p>
    <?php endif; ?>
<?php get_footer(); ?>