module.exports = function(grunt) {

  grunt.initConfig({
    concat: {
      dist: {
        src: [
              '_js/libs/*.js', // All JS in the libs folder
              '_js/functions.js'  // This specific file
        ],
        dest: '_js/production.js',
      }
    },
    uglify: {
      build: {
          src: '_js/production.js',
          dest: '_js/production.min.js'
      }
    },
    sass: {                              // Task
      dist: {                            // Target
        options: {                       // Target options
          style: 'compressed'
        },
        files: {                         // Dictionary of files
          'style.css': '_scss/base.scss'       // 'destination': 'source'
        }
      }
    },
    watch: {
      options: {
        livereload: true,
      },
      markup: {
        files: ['*.php'],
        options: {
            livereload: true,
        }
      },
      css: {
        files: ['_scss/*.scss'],
        tasks: ['sass'],
        options: {
            spawn: false,
        }
      },
      scripts: {
        files: ['_js/*.js'],
        tasks: ['concat', 'uglify'],
        options: {
            spawn: false,
        },
      }
    }
  });

  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-watch');


  grunt.registerTask('default', ['concat', 'sass', 'uglify']);

};