# Robots.txt Manager

A very simple to use Robots.txt Manager Plugin for WordPress with 7 pre-created robots.txt files to help you get started.

* **Current version:** 1.1.0
* **Requires PHP:** 8.x
* **WordPress version:** 6.1.1

## Plugin features

* Updates like any other WordPress plugin once installed and activated
* Full control over your WordPress website robots.txt file
* 7 Pre-created robots.txt files to help you get started
* Auto-detects sitemap URL, active theme path, and media upload directory
* Quickly disable or delete the plugin settings within the plugin admin
* Scan and clean for old plugin data, a physical robots.txt file, and missing rewrite rules

## Installation

Manually download, install, and activate the plugin. Once activated the Robots.txt Manager plugin will update within the WordPress admin just like other WordPress plugins.

### Download

Select which download method works best for you.

#### Done for you

This is the simplest and quickest way to get started.

* Download the already prepared [robotstxt-manager.zip](https://github.com/ChrisWinters/robotstxt-manager/raw/master/robotstxt-manager.zip) to your personal computer

#### Do it yourself

* Download the [latest release](https://github.com/ChrisWinters/robotstxt-manager/releases)
  * On your personal computer, unzip file: robotstxt-manager-x.x.x.zip then open the directory: robotstxt-manager-x.x.x
  * Select the directory: robotstxt-manager-x.x.x and rename to robotstxt-manager
  * Reselect the robotstxt-manager directory and compress to a zip archive

#### Really do it yourself

* Clone it and do whatever
* Run npm install for basic development needs
  * Check the package.json for commands
* Avoid publishing: Keep things clean
  * The directories _src/ svn/ and node_modules/
  * All dot .files (.gitignore, etc)
  * The package.json and package-lock.json files
  * The README.md file
  * The robotstxt-manager.zip file

### Upload and Install

* Within the WordPress admin area access the Plugins menu > Add New link or the Upload Plugin button
  * Click the Choose File button
    * Find and select the robotstxt-manager.zip file on your local computer
    * Click the Install Now button
    * Click the Activate link to start the plugin.

## Arbitrary section

Extra tidbits of information.

### Frequently asked questions

#### Q) What does this plugin do?

A) It allows you to manage your websites robots.txt file on standalone WordPress.org installs.

#### Q) Does this plugin work on Multisite Networks?

A) Yes, but only if activated per-website. A better solution is to use the [Multisite Robots.txt Manager](https://github.com/ChrisWinters/multisite-robotstxt-manager).

#### Q) Does the plugin remove the settings when it is disabled or deleted?

A) No, however you can disable the plugin and delete settings within the plugin admin area.

#### Q) Where is the plugins admin menu link located?

Under the Settings menu > Robots.txt Manager link

#### Q) How easy is the plugin to set up?

* Access the plugin admin area
* Scroll down to the "Robots.txt file presets" section
* Select the first preset robots.txt file
* Click the "update saved robots.txt file" button

The plugin will now use the selected robots.txt file for your website.

### Testing robots.txt files

Use Google's Search Console to validate your websites robots.txt files.

* Log into your Google account with the verified website
* Open the [Robots Testing Tool](https://www.google.com/webmasters/tools/robots-testing-tool)
* Choose a verified property in the dropdown menu
* View results

### Screenshots

1. [Plugin Admin - Settings Tab - Fresh Install](https://raw.githubusercontent.com/ChrisWinters/robotstxt-manager/master/svn/screenshot-1.png)

2. [Plugin Admin - Settings Tab - Saved Robots.txt](https://raw.githubusercontent.com/ChrisWinters/robotstxt-manager/master/svn/screenshot-2.png)

3. [Plugin Admin - Cleaner Tab](https://raw.githubusercontent.com/ChrisWinters/robotstxt-manager/master/svn/screenshot-3.png)

## Issues and feature requests

[Submit an issue](https://github.com/ChrisWinters/robotstxt-manager/issues) if you need assistance, found a bug, or if you would like to request a feature.

## GNU GPLv3 License

Permissions of this strong copyleft license are conditioned on making available complete source code of licensed works and modifications, which include larger works using a licensed work, under the same license. Copyright and license notices must be preserved. Contributors provide an express grant of patent rights.

* **Allowed for**: Commercial use, modification, distribution, patent use, private use
* **Limitations**: No liability, no warranty
* **Conditions**: License and copyright notice, state changes, disclose source, same license

* [GNU General Public License v3.0](https://raw.githubusercontent.com/ChrisWinters/robotstxt-manager/master/LICENSE)
  