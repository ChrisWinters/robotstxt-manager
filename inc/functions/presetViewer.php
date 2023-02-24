<?php
/**
 * Public facing function: Viewer for preset robots.txt files.
 *
 * Not included within any other files.
 * Directly call with ?preset=preset_name to view preset robots.txt files.
 * Example: https://domain.com/wp-content/plugins/robotstxt-manager/inc/functions/presetViewer.php?p=open
 */
function presetViewer()
{
    // Get preset from query string.
    $presetFunction = filter_input(
        INPUT_GET,
        'p',
        FILTER_UNSAFE_RAW,
        FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK
    );

    // Silent bail if no query string.
    if (true === empty($presetFunction)) {
        exit;
    }

    // Presets allowed to be viewed.
    $allowedPresets = [
        'alternative',
        'blocked',
        'blogger',
        'google',
        'open',
        'simplified',
        'wordpress',
    ];

    // Silent bail if preset is not allowed.
    if (false === in_array($presetFunction, $allowedPresets, true)) {
        exit;
    }

    // ABSPATH is required to include preset functions.
    define('ABSPATH', $_SERVER['DOCUMENT_ROOT'].'/wp-content/plugins/robotstxt-manager/');

    $presetFile = ABSPATH.'inc/functions/plugin-admin/preset/'.$presetFunction.'.php';

    // Silent bail if preset file is missing.
    if (false === file_exists($presetFile)) {
        exit;
    }

    // Include preset.
    require_once $presetFile;

    // Silent bail if preset function is missing.
    if (false === function_exists('\RobotstxtManager\PluginAdmin\Preset\\'.$presetFunction)) {
        exit;
    }

    // Call preset.
    $preset = call_user_func('\RobotstxtManager\PluginAdmin\Preset\\'.$presetFunction);
    ?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title></title>
</head>
<meta name="robots" content="noindex, nofollow" />
<body style="padding:0;margin:0;">
    <textarea cols="65" rows="20" style="height:99vh;width:99%;padding:0;margin:0"><?php echo $preset; ?></textarea>
</body>
</html>
<?php
}

// View preset.
presetViewer();
