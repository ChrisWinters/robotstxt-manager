#!/usr/bin/env node

/*!
 * Update plugin version.
 */

import inquirer from "inquirer";
import replace from "replace-in-file";
import fs from "node:fs/promises";

const packageJson = JSON.parse(await fs.readFile("package.json"));
const packageVersion = packageJson.version;

const updatesJson = JSON.parse(await fs.readFile("updates.json"));
const packageLastUpdated = updatesJson.last_updated;

const getDateTime = function () {
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

  return (
    year +
    "-" +
    month +
    "-" +
    date +
    " " +
    hours +
    ":" +
    minutes +
    ":" +
    seconds
  );
};

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
    // File: readme.txt file
    const currentStableTag = "Current version:** " + res.version;
    const previousStableTag = "Current version:** " + packageVersion;

    // File: README.MD
    const currentHeaderTag = "Version: " + res.version;
    const previousHeaderTag = "Version: " + packageVersion;

    // File: robotstxt-manager.php
    const currentConstantTag =
      "'ROBOTSTXT_MANAGER_VERSION', '" + res.version + "'";
    const previousConstantTag =
      "'ROBOTSTXT_MANAGER_VERSION', '" + packageVersion + "'";

    // Fils: package.json, package-lock.json, updates.json
    const currentVersionTag = '"version": "' + res.version + '"';
    const previousVersionTag = '"version": "' + packageVersion + '"';

    // File: updates.json
    const currentZipFileTag = "tag/" + res.version;
    const previousZipFileTag = "tag/" + packageVersion;

    // File: updates.json
    const currentUpdatedTag = '"last_updated": "' + packageLastUpdated;
    const previousUpdatedTag = '"last_updated": "' + getDateTime();

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
        currentUpdatedTag,
      ],
      to: [
        currentStableTag,
        currentHeaderTag,
        currentConstantTag,
        currentVersionTag,
        currentZipFileTag,
        previousUpdatedTag,
      ],
    });

    console.log("Version updated to: " + res.version);
  });
