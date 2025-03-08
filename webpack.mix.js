const mix = require("laravel-mix");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.scripts(
    [
        "resources/js/jquery.js",
        "resources/js/popper.js",
        "resources/js/bootstrap.min.js",
        "resources/js/fontawesome.js",
        "resources/js/jquery.lazy.js",
        "resources/js/app.js"
    ],
    "public/js/hartpiece.js"
).styles(
    [
        "resources/css/bootstrap.min.css",
        "resources/css/font.css",
        "resources/css/app.css"
    ],
    "public/css/hartpiece.css"
);

mix.scripts("resources/js/home.js", "public/js/home.js");
mix.scripts("resources/js/index.js", "public/js/index.js");
mix.scripts("resources/js/search.js", "public/js/search.js");
mix.scripts("resources/js/followers.js", "public/js/followers.js");
mix.scripts("resources/js/following.js", "public/js/following.js");
mix.scripts("resources/js/compose.js", "public/js/compose.js");
mix.scripts("resources/js/feed.js", "public/js/feed.js");
mix.scripts("resources/js/post.js", "public/js/post.js");
mix.scripts("resources/js/tags.js", "public/js/tags.js");
