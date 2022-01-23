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
  
    const currentChangeLogTag = '### ' + res.version
    const previousChangeLogTag = '### ' + packageVersion
  
    const currentHeaderTag = 'Version: ' + res.version
    const previousHeaderTag = 'Version: ' + packageVersion
  
    const currentConstantTag = '\'' + res.version + '\''
    const previousConstantTag = '\'' + packageVersion + '\''
  
    const currentUpdatesTag = '"' + res.version + '"'
    const previousUpdatesTag = '"' + packageVersion + '"'
  
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
          previousChangeLogTag,
          previousHeaderTag,
          previousConstantTag,
          previousUpdatesTag
        ],
        to: [
          currentStableTag,
          currentChangeLogTag,
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
