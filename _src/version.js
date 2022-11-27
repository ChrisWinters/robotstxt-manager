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

const getDateTime = function() {
  const dateObject = new Date();

  // current date
  // adjust 0 before single digit date
  const date = ("0" + dateObject.getDate()).slice(-2);

  // current month
  const month = ("0" + (dateObject.getMonth() + 1)).slice(-2);

  // current year
  const year = dateObject.getFullYear();

  // current hours
  const hours = dateObject.getHours();

  // current minutes
  const minutes = dateObject.getMinutes();

  // current seconds
  const seconds = dateObject.getSeconds();

  return year + "-" + month + "-" + date + " " + hours + ":" + minutes + ":" + seconds;
}

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

    // updates.json
    const currentZipFileTag = 'tag/' + res.version;
    const previousZipFileTag = 'tag/' + packageVersion;

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
        previousZipFileTag,
      ],
      to: [
        currentStableTag,
        currentHeaderTag,
        currentConstantTag,
        currentVersionTag,
        currentZipFileTag,
      ],
    });

    console.log("Version updated to: " + res.version);
  });
