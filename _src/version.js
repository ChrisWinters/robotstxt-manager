#!/usr/bin/env node

/*!
 * Copy wordpress files from project to theme.
 */

'use strict'

// Configuration.
const packageJson = require('../package.json')
const currentVersion = packageJson.currentVersion
const previousVersion = packageJson.previousVersion

// Tags to update.
const currentStableTag = 'Stable tag: ' + currentVersion
const previousStableTag = 'Stable tag: ' + previousVersion

const currentChangeLogTag = '### ' + currentVersion
const previousChangeLogTag = '### ' + previousVersion

const currentHeaderTag = 'Version: ' + currentVersion
const previousHeaderTag = 'Version: ' + previousVersion

const currentConstantTag = '\'' + currentVersion + '\''
const previousConstantTag = '\'' + previousVersion + '\''

const currentUpdatesTag = '"' + currentVersion + '"'
const previousUpdatesTag = '"' + previousVersion + '"'

const currentPackageTag = '"' + currentVersion + '"'
const previousPackageTag = '"' + previousVersion + '"'

try {
  const replace = require('replace-in-file')

  // All child theme files.
  const files = [
    './readme.txt',
    './README.md',
    './robotstxt-manager.php',
    './updates.json',
    './package.json',
  ]

  // Update version.
  const updateVersions = {
    files: files,
    from: [
      previousStableTag,
      previousChangeLogTag,
      previousHeaderTag,
      previousConstantTag,
      previousUpdatesTag,
      previousPackageTag
    ],
    to: [
      currentStableTag,
      currentChangeLogTag,
      currentHeaderTag,
      currentConstantTag,
      currentUpdatesTag,
      currentPackageTag
    ],
  };

  replace.sync(updateVersions)

  console.log('Version updated to: ' + currentVersion )
} catch(error) {
    console.log('Packages missing: Type `npm install`\n')
}
