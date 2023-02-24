#!/usr/bin/env node

/*!
 * Remove /zip/ directory
 */

import fs from "node:fs";

const removeZip = async () => {
    fs.rmSync('zip', { recursive: true, force: true });
};

removeZip();
