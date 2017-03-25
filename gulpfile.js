// Grab our gulp packages
var gulp  			= require('gulp'),
    gutil 			= require('gulp-util'),
    sass 			= require('gulp-sass'),
    cssnano 		= require('gulp-cssnano'),
    autoprefixer 	= require('gulp-autoprefixer'),
    sourcemaps 		= require('gulp-sourcemaps'),
    jshint 			= require('gulp-jshint'),
    stylish 		= require('jshint-stylish'),
    uglify 			= require('gulp-uglify'),
    concat 			= require('gulp-concat'),
    rename 			= require('gulp-rename'),
    plumber 		= require('gulp-plumber'),
	svgSprite 		= require('gulp-svg-sprite'),
    bower 			= require('gulp-bower'),
	newer 			= require('gulp-newer'),
	notify 			= require('gulp-notify'),
	imagemin 		= require('gulp-imagemin'),
	pngquant 		= require('imagemin-pngquant'),
	del 			= require('del'),
    babel 			= require('gulp-babel'),
    browserSync 	= require('browser-sync').create();

// Compile Sass, Autoprefix and minify
gulp.task('styles', function() {
    return gulp.src('./assets/scss/**/*.scss')
        .pipe(plumber(function(error) {
            gutil.log(gutil.colors.red(error.message));
            this.emit('end');
        }))
        .pipe(sourcemaps.init()) // Start Sourcemaps
        .pipe(sass())
        .pipe(autoprefixer({
            browsers: ['last 2 versions'],
            cascade: false
        }))
        .pipe(gulp.dest('./assets/css/'))
        .pipe(rename({suffix: '.min'}))
        .pipe(cssnano()) // Uncomment for production release
        .pipe(sourcemaps.write('.')) // Creates sourcemaps for minified styles
        .pipe(gulp.dest('./assets/css/'))
		.pipe(notify({ message: 'Styles task complete'}))
});

// JSHint, concat, and minify JavaScript
gulp.task('site-js', function() {
  return gulp.src([

           // Grab your custom scripts
  		  './assets/js/scripts/*.js'

  ])
    .pipe(plumber())
    .pipe(sourcemaps.init())
    .pipe(jshint())
    .pipe(jshint.reporter('jshint-stylish'))
    .pipe(concat('scripts.js'))
    .pipe(gulp.dest('./assets/js'))
    .pipe(rename({suffix: '.min'}))
    .pipe(uglify())
    .pipe(sourcemaps.write('.')) // Creates sourcemap for minified JS
    .pipe(gulp.dest('./assets/js'))
	.pipe(notify({ message: 'Site-JS task complete'}))

});

// JSHint, concat, and minify Foundation JavaScript
gulp.task('foundation-js', function() {
  return gulp.src([

  		  // Foundation core - needed if you want to use any of the components below
          './vendor/foundation-sites/js/foundation.core.js',
          './vendor/foundation-sites/js/foundation.util.*.js',

          // Pick the components you need in your project
          './vendor/foundation-sites/js/foundation.abide.js',
          './vendor/foundation-sites/js/foundation.accordion.js',
          './vendor/foundation-sites/js/foundation.accordionMenu.js',
          './vendor/foundation-sites/js/foundation.drilldown.js',
          './vendor/foundation-sites/js/foundation.dropdown.js',
          './vendor/foundation-sites/js/foundation.dropdownMenu.js',
          './vendor/foundation-sites/js/foundation.equalizer.js',
          './vendor/foundation-sites/js/foundation.interchange.js',
          './vendor/foundation-sites/js/foundation.magellan.js',
          './vendor/foundation-sites/js/foundation.offcanvas.js',
          './vendor/foundation-sites/js/foundation.orbit.js',
          './vendor/foundation-sites/js/foundation.responsiveMenu.js',
          './vendor/foundation-sites/js/foundation.responsiveToggle.js',
          './vendor/foundation-sites/js/foundation.reveal.js',
          './vendor/foundation-sites/js/foundation.slider.js',
          './vendor/foundation-sites/js/foundation.sticky.js',
          './vendor/foundation-sites/js/foundation.tabs.js',
          './vendor/foundation-sites/js/foundation.toggler.js',
          './vendor/foundation-sites/js/foundation.tooltip.js',
          './vendor/foundation-sites/js/foundation.zf.responsiveAccordionTabs.js',
  ])
	.pipe(babel({
		presets: ['es2015'],
	    compact: true
	}))
    .pipe(sourcemaps.init())
    .pipe(concat('foundation.js'))
    .pipe(gulp.dest('./assets/js'))
    .pipe(rename({suffix: '.min'}))
    .pipe(uglify())
    .pipe(sourcemaps.write('.')) // Creates sourcemap for minified Foundation JS
    .pipe(gulp.dest('./assets/js'))
});

// Update Foundation with Bower and save to /vendor
gulp.task('bower', function() {
  return bower({ cmd: 'update'})
    .pipe(gulp.dest('vendor/'))
});



// Images: Compression and move to build folder
gulp.task('images', function() {
  return gulp.src('assets/images/*')
  	.pipe(newer('assets/build/images'))
	//.pipe(imagemin({ optimizationLevel: 7, progressive: true, interlaced: true }))
	    .pipe(imagemin({
		    //optimizationLevel: 7,
            progressive: true,
            svgoPlugins: [{removeViewBox: false}],
            use: [pngquant()],
        }))
	.pipe(gulp.dest('assets/build/images/'))
    //.pipe(browserSync.stream())
	.pipe(notify({ message: 'Images task complete'}));
});

// Images: Removes images not in src folder
gulp.task('clean', function(){
  del(['assets/build/images/**/*', '!assets/images', '!assets/images/**/*'])
});



// SVG:
// Basic configuration example for SVG Sprite
var config                  = {
    shape               : {
        dimension       : {               // Set maximum dimensions
            maxWidth    : 32, 			 // Max. shape width
            maxHeight   : 32, 			// Max. shape width
            precision   : 2,           // Floating point precision
            attributes  : true,      // Width and height attributes on embedded shapes

        },
        id         		: {            // Adds icon- to the ID
			generator: 'icon-%s',
        },
        spacing         : {            // Spacing related options
            padding     : 0,		  // Padding around all shapes
            box         : 'content'  // Padding strategy (similar to CSS `box-sizing`)
        },
        dest            : 'intermediate-svg'    // Keep the intermediate files
    },
    svg                     : {                           // General options for created SVG files
        xmlDeclaration      : false,                     // Add XML declaration to SVG sprite
        doctypeDeclaration  : false,                    // Add DOCTYPE declaration to SVG sprite
        namespaceIDs        : true,                    // Add namespace token to all IDs in SVG shapes
        dimensionAttributes : true,                   // Width and height attributes on the sprite
        //namespaceClassnames	: true,
        rootAttributes: {
            width: 0,
            height: 0,
            style: 'position:absolute; background:none !important'
        },
    },
    mode                : {
        view            : {         // Activate the «view» mode
            bust        : false,
            render      : {
                scss    : true      // Activate Sass output (with default options)
            }
        },
        css             : {
            example     : true
        },
        inline          : true,
        symbol          : true     // Activate the «symbol» mode
    }
};

// Build SVG sprites and move to build folder
gulp.task('svgSprite', function() {
	return gulp.src('assets/svg/*.svg')
		.pipe(svgSprite(config))
		.pipe(gulp.dest('assets/build/svg'))
		.pipe(notify({ message: 'SVG task complete'}));
});

// Images: Removes images not in src folder
gulp.task('cleanSVG', function(){
  del(['assets/build/svg/**/*', '!assets/svg', '!assets/svg/**/*'])
});


// Rename and create symbols php file
gulp.task('rename', function() {
	return gulp.src('assets/build/svg/symbol/svg/*.svg')
		.pipe(rename({
			basename: "svg",
			suffix: "-symbols",
			extname: '.php'
	}))
	.pipe(gulp.dest('parts'))
	.pipe(browserSync.stream())
	.pipe(notify({ message: 'Rename task complete'}))
});



// Browser-Sync watch files and inject changes
gulp.task('browsersync', function() {
    // Watch files
    var files = [
    	'./assets/css/*.css',
    	'./assets/js/*.js',
    	'**/*.php',
    	'assets/images/**/*.{png,jpg,gif,svg,webp}',
    	'assets/svg/**/*/.svg',
    ];

    browserSync.init(files, {
	    // Replace with URL of your local site
	    proxy: "http://local.zurbflash/",
		// Don't show any notifications in the browser.
        notify: false,
		//browser: ["Google Chrome", "FireFox", "Safari"]
	    browser: ["Safari"],
        // Dont'auto reload wp-admin pages
        snippetOptions: {
            ignorePaths: ["wp-admin/**"]
        },
    });

    gulp.watch('./assets/scss/**/*.scss', ['styles']);
    gulp.watch('./assets/js/scripts/*.js', ['site-js']).on('change', browserSync.reload);

});

// Watch files for changes (without Browser-Sync)
gulp.task('watch', function() {

	// Watch .scss files
	gulp.watch('./assets/scss/**/*.scss', ['styles']);

	// Watch site-js files
	gulp.watch('./assets/js/scripts/*.js', ['site-js']);

	// Watch foundation-js files
	gulp.watch('./vendor/foundation-sites/js/*.js', ['foundation-js']);

	// Watch Image files
	gulp.watch('assets/images/*', ['images']);

	gulp.watch('assets/images/*', ['clean']);

	// Watch SVG files
	gulp.watch('assets/svg/*', ['svgSprite']);

	gulp.watch('assets/svg/*', ['cleanSVG']);

	// Watch SVG output and rename file
	gulp.watch('assets/build/svg/symbol/svg/*.svg', ['rename']);

});

// Run styles, site-js and foundation-js
gulp.task('default', function() {
  gulp.start('styles', 'site-js', 'foundation-js', 'svgSprite', 'clean', 'cleanSVG', 'images', 'browsersync','watch');
});