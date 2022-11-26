#!/usr/bin/env node

/*!
 * Update plugin version.
 */

import inquirer from 'inquirer';
import replace from 'replace-in-file';

// Configuration.
import fs from 'node:fs/promises';
const packageJson = JSON.parse(await fs.readFile('package.json'));
const packageVersion = packageJson.version;

inquirer
  .prompt([
    {
      type: "input",
      name: "version",
      message:
        "What version are we moving to? (Current version is " +
        packageVersion +
        ")",
    },
  ])
  .then(function (res) {
    try {
      // Tags to update.
      const currentStableTag = "Current version:** " + res.version;
      const previousStableTag = "Current version:** " + packageVersion;

      const currentHeaderTag = "Version: " + res.version;
      const previousHeaderTag = "Version: " + packageVersion;

      const currentConstantTag =
        "'ROBOTSTXT_MANAGER_VERSION', '" + res.version + "'";
      const previousConstantTag =
        "'ROBOTSTXT_MANAGER_VERSION', '" + packageVersion + "'";

      const currentUpdatesTag = '"version": "' + res.version + '"';
      const previousUpdatesTag = '"version": "' + packageVersion + '"';

      // Update version.
      replace.sync({
        files: [
          "./readme.txt",
          "./README.md",
          "./robotstxt-manager.php",
          "./updates.json",
          "./package.json",
        ],
        from: [
          previousStableTag,
          previousHeaderTag,
          previousConstantTag,
          previousUpdatesTag,
        ],
        to: [
          currentStableTag,
          currentHeaderTag,
          currentConstantTag,
          currentUpdatesTag,
        ],
      });

      console.log("Version updated to: " + res.version);
    } catch (error) {
      console.log("Packages missing: Type `npm install`\n");
    }
  });
