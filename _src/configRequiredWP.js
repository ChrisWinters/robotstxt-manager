#!/usr/bin/env node

/*!
 * Replace config: Update required WordPress version
 */

// Files replace will update.
export function requiredWPFiles() {
  return [
    "./readme.txt",
    "./inc/classes/PluginActivate.php",
    "./updates.json",
  ];
}

// Items replace to search for.
export function requiredWPFrom(oldVersion) {
  return [
    "Requires at least: " + oldVersion, // File: readme.txt file
    "requiredWPVersion = " + oldVersion, // File: inc/classes/PluginActivate.php
    '"required_wp": "' + oldVersion + '"', // File: updates.json
  ];
}

// Items replace will update to.
export function requiredWPTo(newVersion) {
  return [
    "Requires at least: " + newVersion, // File: readme.txt file
    "requiredWPVersion = " + newVersion, // File: inc/classes/PluginActivate.php
    '"required_wp": "' + newVersion + '"', // File: updates.json
  ];
}
