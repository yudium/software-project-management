/**
 * Thanks to: https://stackoverflow.com/a/36444134
 */

if (! window.performance) {
  console.info("window.performance doesn't work on this browser, please use newer browser");
}

function isReload() {
    if (performance.navigation.type == 1) return true;
    return false;
}
