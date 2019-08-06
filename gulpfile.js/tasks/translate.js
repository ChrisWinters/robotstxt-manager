/**
 * Generate Translation POT File
 *
 * Compiles:
 *      lang/robotstxt-manager.pot
 *
 * @command gulp translate
 */
var gulp 				= require('gulp');
var sort 				= require('gulp-sort');
var notify 				= require('gulp-notify');
var wpPot 				= require('gulp-wp-pot');
var text_domain         = 'robotstxt-manager';
var bug_report          = 'https://github.com/ChrisWinters/robotstxt-manager/issues';
var translator_contact 	= 'ChrisW. <chrisw@null.net>';
var team_contact        = 'ChrisW. <chrisw@null.net>';


/**
 * Create Translation File
 */
gulp.task('translate', function () {
    return gulp.src(['!/node_modules', '!/css', '!/fonts', '!/js', '!/lang', './**/*.php', './*.php'])
    .pipe(sort())
    .pipe(wpPot({domain: text_domain, package: text_domain, bugReport: bug_report, lastTranslator: translator_contact, team: team_contact}))
    .pipe(gulp.dest('./lang/robotstxt-manager.pot'))
    .pipe(notify({message: 'Task "translate" created robotstxt-manager.pot', onLast: true}))
    .on('error', console.error.bind(console))
});
