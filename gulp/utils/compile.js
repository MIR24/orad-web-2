var gulp = require('gulp');
var yargs = require('yargs');
var sequence = require('run-sequence');
var build = require('./build');
var func = require('./helpers');
var rename = require('gulp-rename');
var rtlcss = require('gulp-rtlcss');
var glob = require('glob');
var fs = require('fs');
var pretty = require('pretty');
var sass = require('gulp-sass');
var rev = require('gulp-rev');
var del = require('del');
var vendorToPublicCustom = [
	{
		vendor: '/almasaeed2010/adminlte',
		public: '/adminlte'
	},
];

const webpack = require('webpack');
const webpackStream = require('webpack-stream');
const browserSync = require('browser-sync').create();
const vinylNamed = require('vinyl-named');
const gulpSourcemaps = require('gulp-sourcemaps');
const gulpBabel = require('gulp-babel');
const WebpackAssetsManifest = require('webpack-assets-manifest');
const path = require('path');


// Supported Browsers
const supportedBrowsers = [
  'last 3 versions', // http://browserl.ist/?q=last+3+versions
  'ie >= 10', // http://browserl.ist/?q=ie+%3E%3D+10
  'edge >= 12', // http://browserl.ist/?q=edge+%3E%3D+12
  'firefox >= 28', // http://browserl.ist/?q=firefox+%3E%3D+28
  'chrome >= 21', // http://browserl.ist/?q=chrome+%3E%3D+21
  'safari >= 6.1', // http://browserl.ist/?q=safari+%3E%3D+6.1
  'opera >= 12.1', // http://browserl.ist/?q=opera+%3E%3D+12.1
  'ios >= 7', // http://browserl.ist/?q=ios+%3E%3D+7
  'android >= 4.4', // http://browserl.ist/?q=android+%3E%3D+4.4
  'blackberry >= 10', // http://browserl.ist/?q=blackberry+%3E%3D+10
  'operamobile >= 12.1', // http://browserl.ist/?q=operamobile+%3E%3D+12.1
  'samsung >= 4', // http://browserl.ist/?q=samsung+%3E%3D+4
];

// merge with default parameters
var args = Object.assign({'prod': false, 'rtl': '', 'metronic': false, 'keen': false}, yargs.argv);

if (args.prod !== false) {
	// force disable debug for production
	// build.config.debug = false;
	build.config.compile = Object.assign(build.config.compile, {
		'jsUglify': true,
		'cssMinify': true,
		'jsSourcemaps': false,
		'cssSourcemaps': false,
	});
}

if (args.rtl !== '') {
	build.config.compile.rtl.enabled = args.rtl;
}

gulp.task('rtl', function (cb) {
	var stream = null;
	func.objectWalkRecursive(build.build, function (val, key, userdata) {
		if (userdata.indexOf(key) === -1 && typeof val.styles !== 'undefined' && key !== 'bundle') {
			// rtl conversion in each plugins
			for (var i in val.styles) {
				if (!val.styles.hasOwnProperty(i)) continue;
				var toRtlFile = func.dotPath(val.styles[i]);

				// exclude scss file for now
				if (toRtlFile.indexOf('.scss') === -1) {
					stream = gulp.src(toRtlFile)
						.pipe(rtlcss())
						.pipe(rename({
							suffix: '.rtl'
						}))
						.pipe(gulp.dest(func.pathOnly(toRtlFile)));
				}
			}
		}
	}, build.config.compile.rtl.skip);
	return stream;
});

// task to bundle js/css
gulp.task('build-bundle', function (cb) {
	// build by demo, leave demo empty to generate all demos
	if (build.config.demo !== '') {
		for (var demo in build.build.demo) {
			if (!build.build.demo.hasOwnProperty(demo)) continue;
			if (build.config.demo !== demo) {
				delete build.build.demo[demo];
			}
		}
	}

	func.objectWalkRecursive(build.build, function (val, key) {
		if (val.hasOwnProperty('src')) {
			if (val.hasOwnProperty('bundle')) {
				func.bundle(val);
			}
			if (val.hasOwnProperty('output')) {
				func.output(val);
			}
		}
	});

	cb();
});


gulp.task('copy-vendor-to-public-custom', (cb) => {
	for (var one in vendorToPublicCustom) {
	    gulp.src('./vendor'+ vendorToPublicCustom[one].vendor +'/**/*')
	        .pipe(gulp.dest('./public/vendor'+  vendorToPublicCustom[one].public));
	}

	cb();
});

gulp.task('bundle-custom-js', (cb) => {
	gulp.src('resources/js/custom/custom.js')
	.pipe(vinylNamed())
	.pipe(webpackStream({
		mode: 'development',
		devtool: 'inline-cheap-source-map',
		output: {
			filename: '[name].js',
		}
	}, webpack))
	.pipe(rev())
	.pipe(gulpSourcemaps.init({ loadMaps: true }))
	.pipe(gulpBabel({
		presets: [
			[
				'env', {
					targets: {
						browsers: supportedBrowsers
					},
					debug: false,
					useBuiltIns: true,
					include: [
						"transform-es2015-arrow-functions",
					],
				}
			]
		],
		compact: true,
	}))
	.pipe(gulpSourcemaps.write('./'))
	.pipe(gulp.dest('public/assets/custom'))
	.pipe(browserSync.stream())
	.pipe(rev.manifest({
		merge: true
	}))
	.pipe(gulp.dest('./'));

	cb();
});

var tasks = ['clean', 'bundle-custom-js'];
if ((/true/i).test(build.config.compile.rtl.enabled)) {
	tasks.push('rtl');
}

// entry point
gulp.task('default', tasks, function (cb) {
	// clean first and then start bundling
	return sequence(['build-bundle'], 'copy-vendor-to-public-custom', cb);
});

// html formatter
gulp.task('html-formatter', [], function (cb) {
	var theme = 'metronic';
	if (args.keen !== false) {
		theme = 'keen';
	}

	var format = function (dir) {
		glob(dir + '/**/*.html', {}, function (er, files) {
			files.forEach(function (path) {
				fs.readFile(path, {encoding: 'UTF-8'}, function (err, data) {
					if (err) throw err;
					var formatted = pretty(data, {ocd: true, indent_size: 1, indent_char: '	', unformatted: ['code', 'pre', 'em', 'strong']});
					fs.writeFile(path, formatted, function (err) {
						if (err) throw err;
						// console.log(path + ' formatted!');
					});
				});
			});
		});
	};

	format('../themes/themes/' + theme + '/dist/default');
	cb();
});

// scss compiler
gulp.task('classic-css', function (cb) {
	for (var demo in build.build.demo) {
		if (!build.build.demo.hasOwnProperty(demo)) continue;
		var obj = build.build.demo[demo].base;
		if (typeof obj.src.styles !== 'undefined' && obj.src.styles[0].indexOf('.scss') !== -1 && obj.hasOwnProperty('bundle')) {
			gulp.src(obj.src.styles).pipe(func.cssChannel()()).pipe(gulp.dest('../'));
		}
	}
	cb();
});