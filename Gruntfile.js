module.exports = function (grunt) {
  require('load-grunt-tasks')(grunt);
  require('time-grunt')(grunt);

  grunt.initConfig({
    sass: {
      options: {
        sourcemap: 'none',
        unixNewlines: true,
        style: 'compressed',
        precision: 10,
        loadPath: 'bower_components'
      },
      main: {
        files: [{
          expand: true,
          cwd: './sass',
          src: ['*.{scss,sass}'],
          dest: './css',
          ext: '.css'
        }]
      }
    },
    watch: {
      sass: {
        files: ['**/*.{scss,sass}'],
        tasks: ['sass:main']
      },
      livereload: {
        options: {
          livereload: true
        },
        files: [
          '{,*/}*.php',
          'css/*.css'
        ]
      }
    }
  });

  grunt.registerTask('default', ['sass:main', 'watch']);
}
