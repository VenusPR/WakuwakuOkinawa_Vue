const mix = require("laravel-mix");
const path = require("path");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js("resources/js/src/main.js", "public/js")
    .webpackConfig({
        resolve: {
            alias: {
                "@": path.resolve(__dirname, "resources/js/src/"),
                "@themeConfig": path.resolve(
                    __dirname,
                    "resources/js/theme.config.js"
                ),
            },
        },
        module: {
            rules: [
                {
                    test: /\.s[ac]ss$/i,
                    use: [
                        {
                            loader: "sass-loader",
                            options: {
                                sassOptions: {
                                    includePaths: [
                                        "node_modules",
                                        "resources/js/src/assets",
                                    ],
                                },
                            },
                        },
                    ],
                },
            ],
        },
    })
    .override((webpackConfig) => {
        webpackConfig.module.rules.forEach((rule) => {
            if (
                rule.test.toString() ===
                "/(\\.(png|jpe?g|gif|webp|avif)$|^((?!font).)*\\.svg$)/"
            ) {
                if (Array.isArray(rule.use)) {
                    rule.use.forEach((ruleUse) => {
                        ruleUse.options.esModule = false;
                        ruleUse.options.name =
                            "images/[path][name]-[hash].[ext]";
                        ruleUse.options.context =
                            "resources/js/src/assets/images";
                    });
                }
            }
        });
    })
    .sass("resources/js/src/assets/sass/app.scss", "public/css")
    .vue()
    .version();

mix.webpackConfig({
    output: {
        chunkFilename: "js/chunks/[name].[chunkhash].js",
    },
});
