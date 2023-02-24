'use strict'

export function ctx() {
  return {
    map: false,
    plugins: {
      autoprefixer: {
        cascade: false
      }
    },
    rules: {
      exclude: '/node_modules/',
    }
  };
}