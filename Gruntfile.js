/* jshint node: true */
/* global module: true */
module.exports = function(grunt) {

	// load plugins 'just-in-time'
	require('jit-grunt')(grunt);

	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		bowercopy: {
			options: {
				// Bower components folder will be removed afterwards
				clean: true
			},
			open_sans_fontface: {
				options: {
					destPrefix: 'assets'
				},
				files: {
					// Note: when copying folders, the destination (key) will be used as the location for the folder
					'open-sans/fonts/Italic': 'open-sans-fontface/fonts/Italic',
					'open-sans/fonts/Light': 'open-sans-fontface/fonts/Light',
					'open-sans/fonts/LightItalic': 'open-sans-fontface/fonts/LightItalic',
					'open-sans/fonts/Regular': 'open-sans-fontface/fonts/Regular',
					'open-sans/fonts/Semibold': 'open-sans-fontface/fonts/Semibold',
					'open-sans/fonts/SemiboldItalic': 'open-sans-fontface/fonts/SemiboldItalic',
					'open-sans/sass': 'open-sans-fontface/sass'
				}
			}
		},

		sass: {
			dist: {
				options: {
					style: 'expanded'
				},
				files: {
					'assets/open-sans/open-sans.css': 'assets/open-sans/open-sans.scss'
				}
			}
		},

		watch: {
			sass: {
				files: ['assets/open-sans/open-sans.scss'],
				tasks: ['sass'],
				options: {
					spawn: false
				}
			}
		},

	});

	// register tasks
	grunt.registerTask('default', [ 'bowercopy' ]);
	grunt.registerTask('update', [ 'bowercopy' ]);
};
