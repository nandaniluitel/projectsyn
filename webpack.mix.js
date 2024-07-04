const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ])
    .react('resources/ProjectSynergy/src/index.js', 'public/js/react-app.js'); // Add this line
