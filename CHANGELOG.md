# Changelog

# 1.0.5
**2020-07-25- Hotfix**

* Simplified how plugin loads features
* Refactor robotstxt class and robots.txt detection

# 1.0.4
**2020-07-24- Hotfix**

* Update Plugin Update Checker from v4 to v4.9
* Corrected Robotstxt class instance callable

# 1.0.3
**2020-04-12- Hotfix**

* Removed esc_html output around WordPress robots_txt filter in class-robotstxt.php
* Corrected/added strict comparison in class-robotstxt.php
* Added namespaces to admin and public class instantiate calls
* WordPress 5.4 Tested

# 1.0.2
**2019-08-07 - Hotfix**

* Moved register_activation_hook to robotstxt-manager.php
* Removed register-plugin-hooks.php

# 1.0.1
**2019-08-06 - Hotfix**

* Corrected plugin translation file being called incorrectly
* Moved admin/public class calls into plugins_loaded hook
* Moved /svn/ directory to root directory
* Corrected screenshot links in README file
* Corrected bump.js gulp task

# 1.0.0
**2019-06-27 - Release**

* Official Release
* Migrated to new plugin format, added gulpfile.js to manage plugin admin styling
* Set activation hook to get website robots.txt file and set as saved robots.txt for plugin
* Add Plugin Update Checker for Github release updates via the WordPress admin
* Created viewable examples of preset robots.txt files
* Migrated settings to use single array option

# 0.1.0
**2016-09-06 - Feature**

* Beta Release
* Plugin format upgrade
* Added Cleaner

# 0.0.1
**2016-09-06 - Release**

* Alpha Release
