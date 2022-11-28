#!/usr/bin/env node

/*!
 * Inquirer config: Questions for inquirer.
 */

export function inquirerQuestions(
  oldPluginVersion,
  requiredPHPVersion,
  requiredWPVersion,
  testedWPVersion
) {
  return [
    {
      type: "input",
      name: "new_plugin_version",
      message:
        "Enter the new plugin version number (Current version is " +
        oldPluginVersion +
        "):",
    },
    {
      type: "input",
      name: "new_required_php_version",
      message:
        "Enter the minimum required PHP version (Current version is " +
        requiredPHPVersion +
        "):",
    },
    {
      type: "input",
      name: "new_required_wp_version",
      message:
        "Enter minimum required WordPress version (Current version is " +
        requiredWPVersion +
        "):",
      when(answers) {
        return answers;
      },
    },
    {
      type: "input",
      name: "new_tested_wp_version",
      message:
        "Enter the highest tested WordPress version (Current version is " +
        testedWPVersion +
        "):",
      when(answers) {
        return answers;
      },
    },
  ];
}
