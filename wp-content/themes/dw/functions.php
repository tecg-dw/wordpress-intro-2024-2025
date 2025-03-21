<?php

// Charger la configuration de champs d'ACF :
include_once('acf.php');

// Activer la session PHP
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}

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

// Activer l'utilisation d'images "de couverture" sur les post_types customs.
add_theme_support('post-thumbnails', ['recipe','trip']);

// Enregistrer de nouveaux "types de contenus" qui seront stockés dans la table
// "wp_posts", avec un identifiant de type spécifique dans la colonne "post_type":

register_post_type('recipe', [
    'label' => 'Recettes',
    'description' => 'Les recettes ramenées de nos périples',
    'public' => true,
    'menu_position' => 7,
    'menu_icon' => 'dashicons-carrot',
    'rewrite' => [
        'slug' => 'recettes',
    ],
    'supports' => ['title','editor','excerpt','thumbnail'],
]);

register_post_type('trip', [
    'label' => 'Voyages',
    'description' => 'Les voyages que nous avons effectués',
    'public' => true,
    'menu_position' => 6,
    'menu_icon' => 'dashicons-location-alt',
    'rewrite' => [
        'slug' => 'voyages',
    ],
    'supports' => ['title','editor','excerpt','thumbnail'],
]);

// Ajouter des "catégories" (taxonomies) sur ces post_types :

register_taxonomy('course', ['recipe'], [
    'labels' => [
        'name' => 'Services',
        'singular_name' => 'Service'
    ],
    'description' => 'À quel moment du repas ce plat intervient-il ?',
    'public' => true,
    'hierarchical' => true,
    'show_tagcloud' => false,
]);

register_taxonomy('diet', ['recipe'], [
    'labels' => [
        'name' => 'Régimes alimentaires',
        'singular_name' => 'Régime'
    ],
    'description' => 'À quel type de régime appartient cette recette ?',
    'public' => true,
    'hierarchical' => true,
    'show_tagcloud' => false,
]);

// Paramétrer des tailles d'images pour le générateur de thumbnails de Wordpress :

// Sans recadrage :
add_image_size('trip-side', 420, 420);
// Avec recadrage : 
add_image_size('trip-header', 1920, 400, true);

// Enregistrer les menus de navigation en fonction de l'endroit où ils sont exploités :

register_nav_menu('header', 'Le menu de navigation principal en haut de la page.');
register_nav_menu('footer', 'Le menu de navigation de fin de page.');

// Créer une nouvelle fonction qui permet de retourner un menu de navigation formaté en un
// tableau d'objets afin de pouvoir l'afficher à notre guise dans le template.

function dw_get_navigation_links(string $location): array
{
    // Récupérer l'objet WP pour le menu à la location $location
    $locations = get_nav_menu_locations();

    if(! isset($locations[$location])) {
        return [];
    }

    $nav_id = $locations[$location];
    $nav = wp_get_nav_menu_items($nav_id);

    // Transformer le menu en un tableau de liens, chaque lien étant un objet personnalisé

    $links = [];

    foreach ($nav as $post) {
        $link = new stdClass();
        $link->href = $post->url;
        $link->label = $post->title;
        $link->icon = get_field('icon', $post);

        $links[] = $link;
    }

    // Retourner ce tableau d'objets (liens).

    return $links;
}

// Ajouter une fonctionnalité de formulaire de contact totalement sur-mesure:

add_action('admin_post_dw_contact_form_submit', 'dw_handle_contact_form_submit');
add_action('admin_post_nopriv_dw_contact_form_submit', 'dw_handle_contact_form_submit');

require_once(__DIR__.'/forms/ContactForm.php');

register_post_type('contact_message', [
    'label' => 'Messages',
    'description' => 'Les formulaires envoyés sur la page de contact',
    'public' => false,
    'show_ui' => true,
    'menu_position' => 10,
    'menu_icon' => 'dashicons-email',
    'supports' => ['title','editor'],
]);

function dw_handle_contact_form_submit()
{
    (new DW_Theme\Forms\ContactForm())
        ->rule('firstname', 'required')
        ->rule('lastname', 'required')
        ->rule('email', 'required')
        ->rule('email', 'valid_email')
        ->rule('subject', 'required')
        ->rule('message', 'required')
        ->rule('message', 'no_test')
        ->sanitize('firstname', 'sanitize_text_field')
        ->sanitize('lastname', 'sanitize_text_field')
        ->sanitize('email', 'sanitize_text_field')
        ->sanitize('subject', 'sanitize_text_field')
        ->sanitize('message', 'sanitize_textarea_field')
        ->handle($_POST);
}











