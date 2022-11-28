#!/usr/bin/env node

/*!
 * Bump minimum Required WordPress version number.
 */

import replace from "replace-in-file";

export default function replacer(
  log,
  message,
  replaceFiles,
  replaceFrom,
  replaceTo
) {
  try {
    const replaceResults = replace.sync({
      files: replaceFiles,
      from: replaceFrom,
      to: replaceTo,
    });

    if (log && replaceResults) {
      console.log("\nLog:\n", replaceResults);
    }

    if (message && replaceResults) {
      console.log(message);
    }
  } catch (error) {
    console.error("An error occurred in version bump:", error);
  }
}
