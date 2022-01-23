#!/usr/bin/env node

/*!
 * Update plugin version.
 */

'use strict'

const inquirer = require('inquirer')

// Configuration.
const packageJson = require('../package.json')
const packageVersion = packageJson.version

inquirer.prompt([{
  type: 'input',
  name: 'version',
  message: 'What version are we moving to? (Current version is ' + packageVersion + ')'
}]).then(function(res) {
  try {
    const replace = require('replace-in-file')

    // Tags to update.
    const currentStableTag = 'Stable tag:** ' + res.version
    const previousStableTag = 'Stable tag:** ' + packageVersion

    const currentHeaderTag = 'Version: ' + res.version
    const previousHeaderTag = 'Version: ' + packageVersion

    const currentConstantTag = '\'ROBOTSTXT_MANAGER_VERSION\', \'' + res.version + '\''
    const previousConstantTag = '\'ROBOTSTXT_MANAGER_VERSION\', \'' + packageVersion + '\''

    const currentUpdatesTag = '"version": "' + res.version + '"'
    const previousUpdatesTag = '"version": "' + packageVersion + '"'

    // Update version.
    replace.sync(
      {
        files: [
          './readme.txt',
          './README.md',
          './robotstxt-manager.php',
          './updates.json',
          './package.json',
        ],
        from: [
          previousStableTag,
          previousHeaderTag,
          previousConstantTag,
          previousUpdatesTag
        ],
        to: [
          currentStableTag,
          currentHeaderTag,
          currentConstantTag,
          currentUpdatesTag
        ],
      }
    )

    console.log('Version updated to: ' + res.version )
  } catch(error) {
      console.log('Packages missing: Type `npm install`\n')
  }
})
