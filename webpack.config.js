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

var ExtractTextPlugin = require('extract-text-webpack-plugin');

/*
 * Configuration
 */

module.exports = {
	entry: './assets/src/js/main.js',
	output: {
		filename: 'main.min.js',
		path: path.resolve(__dirname, './assets/dist/js/')
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
			    exclude: /node_modules/,
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
		new ExtractTextPlugin('../css/main.min.css', {
            allChunks: true
        })
	]
};
