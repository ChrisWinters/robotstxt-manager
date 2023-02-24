#!/usr/bin/env node

/*!
 * Zip project for release
 */

import fs from "node:fs";
import archiver from "archiver";

const createZipFile = async () => {
  try {
    const output = fs.createWriteStream("./robotstxt-manager.zip");
    const archive = archiver("zip", {
      zlib: { level: 9 },
    });

    // Listen for all archive data to be written
    // The 'close' event is fired only when a file descriptor is involved
    output.on("close", function () {
      console.log(archive.pointer() + " total bytes");
      console.log("Archiver has been finalized and the output file descriptor has closed.");
    });

    // This event is fired when the data source is drained no matter what was the data source.
    // It is not part of this library but rather from the NodeJS Stream API.
    // @see: https://nodejs.org/api/stream.html#stream_event_end
    output.on("end", function () {
      console.log("Data has been drained");
    });

    archive.on("warning", function (err) {
      if (err.code === "ENOENT") {
        // log warning
      } else {
        throw err;
      }
    });

    archive.on("error", function (err) {
      throw err;
    });

    // Zip files within the root of the /zip directory.
    archive.directory("./zip/", false);

    archive.pipe(output);

    archive.finalize();
  } catch (error) {
    console.log("Packages missing: Type `npm install`\n");
  }
};

createZipFile();
