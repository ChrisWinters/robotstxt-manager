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
    // readme.txt file.
    const currentStableTag = "Current version:** " + res.version;
    const previousStableTag = "Current version:** " + packageVersion;

    // README.MD file.
    const currentHeaderTag = "Version: " + res.version;
    const previousHeaderTag = "Version: " + packageVersion;

    // robotstxt-manager.php file.
    const currentConstantTag =
      "'ROBOTSTXT_MANAGER_VERSION', '" + res.version + "'";
    const previousConstantTag =
      "'ROBOTSTXT_MANAGER_VERSION', '" + packageVersion + "'";

    // package.json, package-lock.json, updates.json
    const currentVersionTag = '"version": "' + res.version + '"';
    const previousVersionTag = '"version": "' + packageVersion + '"';

    // Update version.
    replace.sync({
      files: [
        "./readme.txt",
        "./README.md",
        "./robotstxt-manager.php",
        "./package.json",
        "./package-lock.json",
        "./updates.json",
      ],
      from: [
        previousStableTag,
        previousHeaderTag,
        previousConstantTag,
        previousVersionTag,
      ],
      to: [
        currentStableTag,
        currentHeaderTag,
        currentConstantTag,
        currentVersionTag,
      ],
    });

    console.log("Version updated to: " + res.version);
  });
