<?php

// Désactiver l'éditeur de contenu en "blocks" de Wordpress, aussi appelé
// "Gutenberg", pour revenir à une version plus ancienne mais qui nous 
// convient mieux en tant que développeurs de thèmes:

// Disable Gutenberg on the back end.
add_filter('use_block_editor_for_post', '__return_false');
// Disable Gutenberg for widgets.
add_filter('use_widgets_block_editor', '__return_false');
// Disable front-end style injections
add_action('wp_enqueue_scripts', function() {
    // Remove CSS on the front end.
    wp_dequeue_style('wp-block-library');
    // Remove Gutenberg theme.
    wp_dequeue_style('wp-block-library-theme');
    // Remove inline global CSS on the front end.
    wp_dequeue_style('global-styles');
}, 20);

// Enregistrer de nouveaux "types de contenus" qui seront stockés dans la table
// "wp_posts", avec un identifiant de type spécifique dans la colonne "post_type":

register_post_type('recipe', [
    'label' => 'Recettes',
    'description' => 'Les recettes ramenées de nos périples',
    'public' => true,
    'menu_position' => 6,
    'menu_icon' => 'dashicons-carrot',
    'rewrite' => [
        'slug' => 'recettes',
    ]
]);















