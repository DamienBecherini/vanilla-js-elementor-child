/* eslint-disable lines-around-comment */
/**
 * COMMAND LINE : --mode=?
 * ----------------------
 * grunt              -> production
 * grunt --mode=dev   -> development
 *
 * Not specifying mode will trigger 'production' mode
 * Anything else than '--mode=production' will trigger 'development' mode
 */

module.exports = (grunt) => {
  const devMode = "production" !== (grunt.option("mode") || "production");
  grunt.log.writeln("Mode : " + (devMode ? "development" : "production"));

  require("load-grunt-tasks")(grunt); // https://github.com/sindresorhus/load-grunt-tasks

  grunt.initConfig({
    pkg: grunt.file.readJSON("package.json"),

    browserify: {
      target: {
        src: "./assets/js/main.js",
        dest: "./assets/js/dist/main.js",
        options: {
          browserifyOptions: { debug: devMode },
          transform: [["babelify", { presets: ["@babel/preset-env"] }]],
        },
      },
    },

    "dart-sass": {
      target: {
        options: {
          sourceMap: devMode,
          outputStyle: devMode ? "expanded" : "compressed",
        },
        files: {
          "style.css": "assets/sass/style.scss",
        },
      },
    },

    postcss: {
      // https://github.com/postcss/postcss

      options: {
        map: devMode, // inline sourcemaps if devmode == true
        processors: () => {
          return devMode
            ? [
                // https://github.com/postcss/postcss-url
                // require("postcss-url")(), // rebase, inline or copy on url().

                // 21_09_06 : no longer work, replaced by autoprefixer plugin + cssnano
                // https://github.com/csstools/postcss-preset-env
                // require('postcss-preset-env')({
                //   autoprefixer: {} // add vendor prefixes
                // }),
                require("autoprefixer")(),
                // https://github.com/postcss/postcss-reporter
                require("postcss-reporter")(), // console.log() the messages (warnings, etc.) registered by other PostCSS plugins.
              ]
            : [
                require("autoprefixer")(),
                //require('cssnano')(), // cssnano break sourcemap
                require("postcss-reporter")(),
              ];
        },
      },

      dist: {
        src: ["style.css"],
      },
    },

    watch: {
      // https://github.com/gruntjs/grunt-contrib-watch

      options: {
        spawn: false, // 20 times faster here
      },

      scss: {
        files: ["assets/sass/**/*.scss", "!node_modules/**"],
        tasks: ["dart-sass", "postcss"],
      },

      js: {
        files: ["assets/js/**/*.js"],
        tasks: ["browserify"],
      },
    },

    browserSync: {
      // https://www.browsersync.io/docs/grunt
      bsFiles: {
        src: ["*.css", "assets/js/**/*.js", "**/*.php", "!node_modules/**"],
      },
      options: {
        proxy: "https://localhost/monsite-exemple.local/", // our PHP server
        port: 80,
        open: true,
        watchTask: true,
      },
    },
  });

  // grunt.registerTask('default', ['img', 'fonts', 'security']);
  if (devMode) {
    grunt.registerTask("default", [
      "browserify",
      "dart-sass",
      "postcss",
      "browserSync",
      "watch",
    ]);
  } else {
    grunt.registerTask("default", ["browserify", "dart-sass", "postcss"]);
  }
};
