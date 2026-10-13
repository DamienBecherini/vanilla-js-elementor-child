# Vanilla JS Elementor Child

[![License: CC0-1.0](https://img.shields.io/badge/License-CC0_1.0-lightgrey.svg)](http://creativecommons.org/publicdomain/zero/1.0/)

Thème enfant WordPress pour [Hello Elementor](https://wordpress.org/themes/hello-elementor/).

C'est le socle de mes sites clients construits avec Elementor (2019-2024). Il s'agit d'un socle d'époque, conservé ici comme exemple : il ne reflète pas l'ensemble de mes projets WordPress, qui sont pour la plupart réalisés en WordPress natif (éditeur de blocs, thèmes FSE) ou en PHP sur mesure.

Le thème ne contient pas de design préconçu. Il apporte une structure PHP orientée objet, quelques composants JavaScript natifs (sans jQuery) et une chaîne de compilation Sass / JavaScript ; la mise en page de chaque site est faite dans Elementor.

## Composants JavaScript (`assets/js/`)

Écrits en JavaScript natif (modules ES, transpilés par Babel).

- **Panneaux coulissants / accordéons (`SlidingPanel.js`, `slidingPanels.js`)** : ouverture et fermeture animées en CSS (`transition` sur la hauteur, fin d'animation détectée par `transitionend`), méthodes asynchrones qui renvoient une promesse, animation désactivée si l'utilisateur a demandé `prefers-reduced-motion`. Les panneaux et leurs boutons sont déclarés en HTML par des attributs `data-lci-*`.
- **En-tête masqué au défilement (`header.js`)** : l'en-tête se cache quand on descend dans la page et réapparaît quand on remonte. Le sens du défilement est déduit d'un `IntersectionObserver` posé sur un élément témoin, plutôt que d'un écouteur `scroll`.
- **Bouton de retour en haut (`scrollTopButton.js`)** : le bouton apparaît ou disparaît selon la position de lecture, à l'aide d'un `IntersectionObserver` sur deux repères placés en CSS (gabarit `template-parts/scrolltopbutton.php`).
- **Correctif des popups Elementor (`main.js`)** : bloque le défilement de la page derrière la popup du menu mobile (Elementor Pro) tant qu'elle est ouverte. Le script écoute `elementor/popup/show` et `elementor/popup/hide`, déclenchés par Elementor Pro via jQuery, et accepte aussi les `CustomEvent` natifs. L'ID de la popup est la constante `MENU_ELEMENTOR_POPUP_ID` en tête de `main.js`.

Seuls le bouton de retour en haut et le correctif des popups sont activés par défaut ; les panneaux coulissants et l'en-tête s'activent en décommentant leur import et leur `init()` dans `main.js`.

## PHP (`functions.php`, `inc/`)

- **Chargeur de classes maison et espaces de noms** : `spl_autoload_register` associe l'espace de noms `VANILLA_JS_ELEMENTOR_CHILD\Inc` aux dossiers `inc/classes` et `inc/traits` ; les fonctions utilitaires de `inc/helpers` sont incluses au démarrage.
- **Singleton par trait** : les classes du thème (`Main`, `Assets`, `Shortcodes`) ne sont instanciées qu'une fois.
- **Chargement des ressources** : `style.css` et `assets/js/dist/main.js` sont versionnés par leur date de modification (`filemtime()`), ce qui force le navigateur à recharger les fichiers après chaque mise en production.
- **Tableau de bord allégé** : retrait des widgets inutiles pour le client (WordPress, Elementor, Yoast, Gravity Forms, WP Mail SMTP) et métaboxe Yoast placée en bas de l'écran d'édition.
- **Mises à jour pilotées à la main** : les mises à jour automatiques des extensions et des thèmes sont désactivées. Elles sont testées puis appliquées manuellement, pour éviter les régressions sur des sites clients sous contrat de maintenance.
- **Shortcodes** : `[lci-year]` (année en cours, pour le pied de page) et `[a href="slug-de-la-page" id="ancre"]texte[/a]` (lien interne construit à partir de l'URL du site).

## Styles (`assets/sass/`)

- Feuilles Sass découpées en partiels, compilées dans `style.css`.
- Requêtes de conteneur (`@container`, par exemple dans `_hero.scss`) pour adapter un composant à la largeur de son parent plutôt qu'à celle de l'écran.
- Surcharges ciblées de widgets Elementor (accordéon fermé à l'ouverture de la page, marges résiduelles, carrousel).

## Outillage

Compilation orchestrée par Grunt :

- Sass compilé par Dart Sass, préfixes navigateurs ajoutés par Autoprefixer (PostCSS) ;
- JavaScript regroupé par Browserify et transpilé par Babel (`@babel/preset-env`) ;
- en développement : cartes de source, rechargement automatique avec BrowserSync et surveillance des fichiers.

## Installation et compilation

Le thème parent Hello Elementor doit être installé. Les fichiers compilés `assets/js/dist/` ne sont pas versionnés : il faut lancer une compilation avant d'activer le thème.

```bash
# Dépendances Node.js
npm install

# Compilation de production (CSS compressé, sans cartes de source)
npm run build

# Développement : compilation, surveillance des fichiers et BrowserSync
# (adresse du site local à renseigner dans Gruntfile.js, option browserSync.proxy)
npm run dev

# Vérification du JavaScript avec ESLint
npm run lint:js

# Archive installable du thème, créée dans ../vanilla-js-elementor-child.zip
npm run bundle
```

## Licence

[CC0 1.0 Universal](LICENSE) : domaine public.
