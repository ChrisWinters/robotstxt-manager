#!/usr/bin/env node

/*!
 * Bump plugin version, required PHP version, and required/tested WordPress version.
 */

import inquirer from "inquirer";
import fs from "node:fs/promises";
import replacer from "./replacer.js";
import {
  pluginVersionFiles,
  pluginVersionFrom,
  pluginVersionTo,
} from "./configPluginVersion.js";
import {
  requiredPHPFiles,
  requiredPHPFrom,
  requiredPHPTo,
} from "./configRequiredPHP.js";
import {
  requiredWPFiles,
  requiredWPFrom,
  requiredWPTo,
} from "./configRequiredWP.js";
import {
  lastUpdatedFiles,
  lastUpdatedFrom,
  lastUpdatedTo,
} from "./configLastUpdated.js";
import { testedWPFiles, testedWPFrom, testedWPTo } from "./configTestedWP.js";
import { inquirerQuestions } from "./configInquirer.js";
import { getDateTime } from "./dateTime.js";

const extraLogging = false; // Set to true to display updated files.
const dateAndTime = getDateTime();
const updatesJson = JSON.parse(await fs.readFile("updates.json"));
const oldPluginVersion = updatesJson.version;
const requiredPHPVersion = updatesJson.required_php;
const requiredWPVersion = updatesJson.required_wp;
const testedWPVersion = updatesJson.tested_wp;
const lastUpdatedPlugin = updatesJson.last_updated;
const questions = inquirerQuestions(
  oldPluginVersion,
  requiredPHPVersion,
  requiredWPVersion,
  testedWPVersion
);

// Prompt questions and answers.
inquirer.prompt(questions).then((answers) => {
  let answer = false;

  // Bump plugin version.
  if (answers.new_plugin_version) {
    replacer(
      extraLogging,
      "Plugin version updated to: " + answers.new_plugin_version,
      pluginVersionFiles(),
      pluginVersionFrom(oldPluginVersion),
      pluginVersionTo(answers.new_plugin_version)
    );

    answer = true;
  }

  // Bump required php version.
  if (answers.new_required_php_version) {
    replacer(
      extraLogging,
      "Updated minimum PHP version to: " + answers.new_required_php_version,
      requiredPHPFiles(),
      requiredPHPFrom(requiredPHPVersion),
      requiredPHPTo(answers.new_required_php_version)
    );

    answer = true;
  }

  // Bump required WordPress version.
  if (answers.new_required_wp_version) {
    replacer(
      extraLogging,
      "Updated required WordPress Version to: " +
        answers.new_required_wp_version,
      requiredWPFiles(),
      requiredWPFrom(requiredWPVersion),
      requiredWPTo(answers.new_required_wp_version)
    );

    answer = true;
  }

  // Bump tested WordPress version.
  if (answers.new_tested_wp_version) {
    replacer(
      extraLogging,
      "Updated tested WordPress version to: " + answers.new_tested_wp_version,
      testedWPFiles(),
      testedWPFrom(testedWPVersion),
      testedWPTo(answers.new_tested_wp_version)
    );

    answer = true;
  }

  // Bump updated date and time.
  if (answer) {
    replacer(
      extraLogging,
      "Last updated: " + dateAndTime,
      lastUpdatedFiles(),
      lastUpdatedFrom(lastUpdatedPlugin),
      lastUpdatedTo(dateAndTime)
    );
  }

  if (!answer) {
    console.log("\nNo answers provided.\n");
  }
});
