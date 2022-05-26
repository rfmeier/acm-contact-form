// Extends the default `webpack.config.js` from the @wordpress/scripts package.
// - Generate one output file per input file, instead of combining as index.js.
// - Each new input file must be named in the entry object.
//
// Build for production with `npm run build`.
// Build for development with `npm start`. (Live reload, source maps, Ctrl-C to exit.)

const defaultConfig = require( './node_modules/@wordpress/scripts/config/webpack.config' );
const resourcePath = __dirname + '/resources/js/';
const buildPath = __dirname + '/assets/js/';

module.exports = {
	...defaultConfig,
	entry: {
		'acm-contact-form': resourcePath + 'acm-contact-form.js',
	},
	output: {
		filename: '[name].js',
		path: buildPath,
	},
};
