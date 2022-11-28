#!/usr/bin/env node

/*!
 * Replace config: Update last tested WordPress version
 */

// Files replace will update.
export function testedWPFiles() {
  return [
    "./readme.txt",
    "./README.md",
    "./updates.json",
  ];
}

// Items replace to search for.
export function testedWPFrom(oldVersion) {
  return [
    "Tested up to: " + oldVersion, // File: readme.txt file
    "WordPress version:** " + oldVersion, // File: README.MD
    '"tested_wp": "' + oldVersion, // File: updates.json
  ];
}

// Items replace will update to.
export function testedWPTo(newVersion) {
  return [
    "Tested up to: " + newVersion, // File: readme.txt file
    "WordPress version:** " + newVersion, // File: README.MD
    '"tested_wp": "' + newVersion, // File: updates.json
  ];
}
