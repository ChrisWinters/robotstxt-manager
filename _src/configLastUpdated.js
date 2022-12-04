#!/usr/bin/env node

/*!
 * Replace config: Set last updated date and time
 */

// Files replace will update.
export function lastUpdatedFiles() {
  return [
    "./updates.json",
  ];
}

// Items replace to search for.
export function lastUpdatedFrom(lastUpdatedPlugin) {
  return [
    '"last_updated": "' + lastUpdatedPlugin + '"', // File: updates.json
  ];
}

// Items replace will update to.
export function lastUpdatedTo(dateAndTime) {
  return [
    '"last_updated": "' + dateAndTime + '"', // File: updates.json
  ];
}
