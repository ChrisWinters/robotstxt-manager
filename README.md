# Robots.txt Manager

A simple to use Robots.txt Manager Plugin for WordPress, with 7 pre-created robots.txt files to help you get started.

  ![The robots.txt manger WordPress plugin allows you to quickly and easily manage your websites robots.txt file.](https://raw.githubusercontent.com/ChrisWinters/robotstxt-manager/master/assets/images/icon-256x256.png)

**Current version:** 3.0.0 | **Requires PHP:** 7.2 | **WordPress version:** 6.1.1

## Plugin features

* Updates like any other WordPress plugin once installed and activated
* Full control over your WordPress website robots.txt file
* 7 Pre-created robots.txt files to help you get started
* Auto-detects sitemap URL, active theme path, and media upload directory
* Quickly disable or delete the plugin settings within the plugin admin
* Scan and clean for old plugin data, a physical robots.txt file, and missing rewrite rules

## Install and activate

[Download](https://github.com/ChrisWinters/robotstxt-manager/raw/master/robotstxt-manager.zip), install, and activate the plugin. Once activated the Robots.txt Manager plugin will update just like other WordPress plugin.

### Do it yourself

A little extra work, but handy when you need to use a past versions or just like to use releases.

* Download the [latest release](https://github.com/ChrisWinters/robotstxt-manager/releases)
  * On your personal computer, unzip file: robotstxt-manager-x.x.x.zip then open the directory: robotstxt-manager-x.x.x
  * Select the directory: robotstxt-manager-x.x.x and rename to robotstxt-manager
  * Reselect the robotstxt-manager directory and compress to a zip archive

#### Really do it yourself

Integrate and deploy the plugin however you like.

* Clone the plugin and have fun
* Run npm install for basic development needs
  * Check the package.json for commands

## Arbitrary section

Extra tidbits of information.

### Frequently asked questions

#### Question: What does this plugin do?

**Answer:** It allows you to manage your websites robots.txt file on standalone WordPress.org installs.

#### Question: Does this plugin work on Multisite Networks?

**Answer:** Yes, but only if activated per-website.

A better solution is to use the [Multisite Robots.txt Manager](https://github.com/ChrisWinters/multisite-robotstxt-manager).

#### Question: Does the plugin remove the settings when it is disabled or deleted?

**Answer:** No, however you can disable the plugin and delete settings within the plugin admin area.

#### Question: Where is the plugins admin menu link located?

**Answer:** Under the Settings menu > Robots.txt Manager link.

#### Question: How easy is the plugin to set up?

**Answer:** It is very easy to set up and use.

* Access the plugin admin area
* Scroll down to the "Robots.txt file presets" section
* Select the first preset robots.txt file
* Click the "update saved robots.txt file" button

The plugin will now use the selected robots.txt file for your website.

#### Question: Can I get the Robots.txt Manager plugin from the WordPress repo?

**Answer:** No, the Robots.txt Manager plugin is hosted on GitHub only.

#### Question: How do I update the Robots.txt Manager plugin then?

**Answer:** Once activated, the Robots.txt Manager plugin updates like any other WordPress plugin.

### Testing robots.txt files

Use the [Google Search Console](https://search.google.com/search-console) to validate your websites robots.txt files.

* Log into your Google account with the verified website
* Open the [Robots Testing Tool](https://www.google.com/webmasters/tools/robots-testing-tool)
* Choose a verified property in the dropdown menu
* View results

### Screenshots

1. [Plugin Admin - Settings Tab - Fresh Install](https://raw.githubusercontent.com/ChrisWinters/robotstxt-manager/master/assets/images/screenshot-1.png)
2. [Plugin Admin - Settings Tab - Saved Robots.txt](https://raw.githubusercontent.com/ChrisWinters/robotstxt-manager/master/assets/images/screenshot-2.png)
3. [Plugin Admin - Cleaner Tab](https://raw.githubusercontent.com/ChrisWinters/robotstxt-manager/master/assets/images/screenshot-3.png)

## Issue and feature requests

[Submit an issue](https://github.com/ChrisWinters/robotstxt-manager/issues) if you need assistance, found a bug, or if you would like to request a feature.

## GNU GPLv3 license

* [GNU General Public License v3.0](https://raw.githubusercontent.com/ChrisWinters/robotstxt-manager/master/LICENSE)

Permissions of this strong copyleft license are conditioned on making available complete source code of licensed works and modifications, which include larger works using a licensed work, under the same license. Copyright and license notices must be preserved. Contributors provide an express grant of patent rights.

* **Allowed for**: Commercial use, modification, distribution, patent use, private use
* **Limitations**: No liability, no warranty
* **Conditions**: License and copyright notice, state changes, disclose source, same license
