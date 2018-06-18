var webpack = require('webpack');

var config = {

    module: {
        loaders: [
            {
                test   : /\.js$/,
                exclude: /node_modules/,
                loader : 'babel-loader',
                query  : {
                    presets: [ 'es2015' ]
                }
            }
        ],
        rules: [
            {
                test: /\.css$/,
                use: [
                    'style-loader',
                    'css-loader'
                ]
            },
            {
                test: /\.(jpe?g|png|gif|svg)$/i,
                use: [
                    'url-loader?limit=10000',
                    'img-loader'
                ]
            },
            {
                test: /\.(woff|woff2|eot|ttf)$/,
                use: [
                    'url-loader?limit=100000'
                ]
            }
        ]
    },
    plugins:[
        new webpack.ProvidePlugin({
            $: "jquery/dist/jquery.min.js",
            jQuery: "jquery/dist/jquery.min.js",
            "window.jQuery": "jquery/dist/jquery.min.js",
            "window.$": "jquery/dist/jquery.min.js",
        })]
};

var siteConfig = Object.assign({}, config, {
    entry : './public/js/sites/main.js',
    output: {
        filename: './public/js/sites/bundle.js'
    },

});
var directoryConfig = Object.assign({}, config, {
    entry : './public/js/directory/main.js',
    output: {
        filename: './public/js/directory/bundle.js'
    },

});
var featuredConfig = Object.assign({}, config, {
    entry : './public/js/featured/main.js',
    output: {
        filename: './public/js/featured/bundle.js'
    },

});
var aboutConfig = Object.assign({}, config, {
    entry : './public/js/about/main.js',
    output: {
        filename: './public/js/about/bundle.js'
    },

});
var blogConfig = Object.assign({}, config, {
    entry : './public/js/blog/main.js',
    output: {
        filename: './public/js/blog/bundle.js'
    },

});
var templateConfig = Object.assign({}, config, {
    entry : './public/Template/js/sitescript.js',
    output: {
        filename: './public/Template/js/bundle.js'
    },

});



// Return Array of Configurations
module.exports = [
    siteConfig,directoryConfig,featuredConfig,aboutConfig,blogConfig,templateConfig
];

