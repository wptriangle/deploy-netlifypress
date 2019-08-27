/**
 * NetlifyPress Webpack Configuration
 */

/*
 * Internal Dependencies
 */

const path = require( 'path' );

/*
 * Plugins
 */

const UnminifiedWebpackPlugin = require('unminified-webpack-plugin');

/*
 * Plugins
 */

var ExtractTextPlugin = require('extract-text-webpack-plugin');

/*
 * Configuration
 */

module.exports = {
	entry: {
		popper: './node_modules/popper.js/dist/popper.js',
		bootstrap: './node_modules/bootstrap/dist/js/bootstrap.js',
		main: './assets/src/js/main.js',
	},
	output: {
		filename: '[name].min.js',
		path: path.resolve( __dirname, './assets/dist/js/' )
	},

	module: {
		rules: [
			{
				test:/\.(s*)css$/,
				use: ExtractTextPlugin.extract({
					fallback:'style-loader',
                    use:['css-loader', 'resolve-url-loader', 'sass-loader'],
                })
			},
			{
		    test: /\.(woff2?|ttf|otf|eot|svg)$/,
			    loader: 'file-loader',
			    options: {
			        name: '[name].[ext]',
			        outputPath: '../fonts/'
			    }
			},
			{
		    test: /\.(jpg|png|jpeg)$/,
			    exclude: /node_modules/,
			    loader: 'file-loader',
			    options: {
			        name: '[name].[ext]',
			        outputPath: '../images/'
			    }
			}
		]
	},

	plugins: [
		new UnminifiedWebpackPlugin(),
		new ExtractTextPlugin('../css/main.min.css', {
            allChunks: true
        })
	],

	externals: {
		jquery: 'jQuery'
	}
};
