#!/usr/bin/env node

/*!
 * Replace config: Required PHP version
 */

// Files replace will update.
export function requiredPHPFiles() {
  return [
    "./README.md",
    "./updates.json",
  ];
}

// Items replace to search for.
export function requiredPHPFrom(oldVersion) {
  return [
    "Requires PHP:** " + oldVersion, // File: README.md
    '"required_php": "' + oldVersion + '"', // File: updates.json
  ];
}

// Items replace will update to.
export function requiredPHPTo(newVersion) {
  return [
    "Requires PHP:** " + newVersion, // File: README.md
    '"required_php": "' + newVersion + '"', // File: updates.json
  ];
}
