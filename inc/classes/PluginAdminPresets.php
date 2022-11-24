<?php
/**
 * Manager Class.
 *
 * @author Chris W. <chrisw@null.net>
 * @license GNU GPL
 */

namespace RobotstxtManager;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Manage Robots.txt File Presets.
 */
final class PluginAdminPresets
{
    use TraitOptionManager;

    /**
     * Plugin Admin Post Object.
     *
     * @var array
     */
    public $postObject = [];

    /**
     * Plugin Admin Notices.
     *
     * @var object
     */
    public $notices;

    /**
     * Init Class.
     *
     * @param array  $postObject Post Object Array.
     * @param object $notices    Notices Class Object.
     */
    public function init($postObject = [], $notices = [])
    {
        $this->postObject = $postObject;
        $this->notices = $notices;
    }

    /**
     * Save Preset Robots.txt As Main Robots.txt.
     */
    public function setPresetRobotstxt()
    {
        $message = false;
        $preset = '';

        if (true !== empty($this->postObject['preset'])) {
            $preset = $this->postObject['preset'];
        }

        switch ($preset) {
            case 'default-robotstxt':
                $this->updateOption(['robotstxt' => $this->defaultRobotstxt()]);
                $message = true;
                break;

            case 'defaultalt-robotstxt':
                $this->updateOption(['robotstxt' => $this->defaultAltRobotstxt()]);
                $message = true;
                break;

            case 'wordpress-robotstxt':
                $this->updateOption(['robotstxt' => $this->wordpressRobotstxt()]);
                $message = true;
                break;

            case 'open-robotstxt':
                $this->updateOption(['robotstxt' => $this->openRobotstxt()]);
                $message = true;
                break;

            case 'blogger-robotstxt':
                $this->updateOption(['robotstxt' => $this->bloggerRobotstxt()]);
                $message = true;
                break;

            case 'block-robotstxt':
                $this->updateOption(['robotstxt' => $this->blockedRobotstxt()]);
                $message = true;
                break;

            case 'google-robotstxt':
                $this->updateOption(['robotstxt' => $this->googleRobotstxt()]);
                $message = true;
                break;
        }

        if (true === $message) {
            \add_action(
                'admin_notices',
                [
                    $this->notices,
                    'presetSuccess',
                ]
            );
        } else {
            \add_action(
                'admin_notices',
                [
                    $this->notices,
                    'presetError',
                ]
            );
        }
    }

    /**
     * Default Robots.txt File.
     */
    private function defaultRobotstxt()
    {
        $txt = "# robots.txt\n";
        $txt .= "User-agent: *\n";
        $txt .= "Disallow: /feed\n";
        $txt .= "Disallow: /feed/\n";
        $txt .= "Disallow: /cgi-bin/\n";
        $txt .= "Disallow: /comment\n";
        $txt .= "Disallow: /comments\n";
        $txt .= "Disallow: /trackback\n";
        $txt .= "Disallow: /comment/\n";
        $txt .= "Disallow: /comments/\n";
        $txt .= "Disallow: /trackback/\n";
        $txt .= "Disallow: /wp-admin/\n";
        $txt .= "Disallow: /wp-content/\n";
        $txt .= "Disallow: /wp-includes/\n";
        $txt .= "Disallow: /wp-login.php\n";
        $txt .= "Allow: /wp-admin/admin-ajax.php\n";

        return $txt;
    }

    /**
     * Default-Alt Robots.txt File.
     */
    private function defaultAltRobotstxt()
    {
        $txt = "# robots.txt\n";
        $txt .= "User-agent: *\n";
        $txt .= "Disallow: */feed\n";
        $txt .= "Disallow: */feed/\n";
        $txt .= "Disallow: */comment/\n";
        $txt .= "Disallow: */comments/\n";
        $txt .= "Disallow: */trackback/\n";
        $txt .= "Disallow: */comment\n";
        $txt .= "Disallow: */comments\n";
        $txt .= "Disallow: */trackback\n";
        $txt .= "Disallow: /feed\n";
        $txt .= "Disallow: /feed/\n";
        $txt .= "Disallow: /cgi-bin/\n";
        $txt .= "Disallow: /comment\n";
        $txt .= "Disallow: /comment/\n";
        $txt .= "Disallow: /comments\n";
        $txt .= "Disallow: /comments/\n";
        $txt .= "Disallow: /trackback\n";
        $txt .= "Disallow: /trackback/\n";
        $txt .= "Disallow: /wp-admin/\n";
        $txt .= "Disallow: /wp-content/\n";
        $txt .= "Disallow: /wp-includes/\n";
        $txt .= "Disallow: /wp-login.php\n";
        $txt .= "Allow: /wp-admin/admin-ajax.php\n";

        return $txt;
    }

    /**
     * WordPress Only Robots.txt File.
     */
    private function wordpressRobotstxt()
    {
        $txt = "# robots.txt\n";
        $txt .= "User-agent: *\n";
        $txt .= "Disallow: /wp-admin/\n";
        $txt .= "Disallow: /wp-includes/\n";
        $txt .= "Allow: /wp-admin/admin-ajax.php\n";

        return $txt;
    }

    /**
     * Open Robots.txt File.
     */
    private function openRobotstxt()
    {
        $txt = "# robots.txt\n";
        $txt .= "User-agent: *\n";
        $txt .= 'Disallow:';

        return $txt;
    }

    /**
     * Blogger Robots.txt File.
     */
    private function bloggerRobotstxt()
    {
        $txt = "# robots.txt\n";
        $txt .= "User-agent: *\n";
        $txt .= "Disallow: *?\n";
        $txt .= "Disallow: *.inc$\n";
        $txt .= "Disallow: *.php$\n";
        $txt .= "Disallow: */feed\n";
        $txt .= "Disallow: */feed/\n";
        $txt .= "Disallow: */author\n";
        $txt .= "Disallow: */comment/\n";
        $txt .= "Disallow: */comments/\n";
        $txt .= "Disallow: */trackback/\n";
        $txt .= "Disallow: */comment\n";
        $txt .= "Disallow: */comments\n";
        $txt .= "Disallow: */trackback\n";
        $txt .= "Disallow: /wp-\n";
        $txt .= "Disallow: /wp-*\n";
        $txt .= "Disallow: /feed\n";
        $txt .= "Disallow: /feed/\n";
        $txt .= "Disallow: /author\n";
        $txt .= "Disallow: /cgi-bin/\n";
        $txt .= "Disallow: /wp-admin/\n";
        $txt .= "Disallow: /comment/\n";
        $txt .= "Disallow: /comments/\n";
        $txt .= "Disallow: /trackback/\n";
        $txt .= "Disallow: /comment\n";
        $txt .= "Disallow: /comments\n";
        $txt .= "Disallow: /trackback\n";
        $txt .= "Disallow: /wp-admin/\n";
        $txt .= "Disallow: /wp-content/\n";
        $txt .= "Disallow: /wp-includes/\n";
        $txt .= "Disallow: /wp-login.php\n";
        $txt .= "Disallow: /wp-content/cache/\n";
        $txt .= "Disallow: /wp-content/themes/\n";
        $txt .= "Disallow: /wp-content/plugins/\n";
        $txt .= "Allow: /wp-admin/admin-ajax.php\n";

        return $txt;
    }

    /**
     * Disallow Website Robots.txt File.
     */
    private function blockedRobotstxt()
    {
        $txt = "# robots.txt\n";
        $txt .= "User-agent: *\n";
        $txt .= 'Disallow: /';

        return $txt;
    }

    /**
     * Google Friendly Robots.txt File.
     */
    private function googleRobotstxt()
    {
        $txt = "# robots.txt\n";
        $txt .= "User-agent: *\n";
        $txt .= "Disallow: /wp-\n";
        $txt .= "Disallow: /feed\n";
        $txt .= "Disallow: /feed/\n";
        $txt .= "Disallow: /author\n";
        $txt .= "Disallow: /cgi-bin/\n";
        $txt .= "Disallow: /wp-admin/\n";
        $txt .= "Disallow: /comment/\n";
        $txt .= "Disallow: /comments/\n";
        $txt .= "Disallow: /trackback/\n";
        $txt .= "Disallow: /comment\n";
        $txt .= "Disallow: /comments\n";
        $txt .= "Disallow: /trackback\n";
        $txt .= "Disallow: /wp-content/\n";
        $txt .= "Disallow: /wp-includes/\n";
        $txt .= "Disallow: /wp-login.php\n";
        $txt .= "Disallow: /wp-content/cache/\n";
        $txt .= "Disallow: /wp-content/themes/\n";
        $txt .= "Disallow: /wp-content/plugins/\n";
        $txt .= "Allow: /wp-content/uploads\n";
        $txt .= "Allow: /wp-content/uploads/\n";
        $txt .= "Allow: /wp-admin/admin-ajax.php\n";
        $txt .= "\n";
        $txt .= "# google bot\n";
        $txt .= "User-agent: Googlebot\n";
        $txt .= "Disallow: /wp-*\n";
        $txt .= "Disallow: *?\n";
        $txt .= "Disallow: *.inc$\n";
        $txt .= "Disallow: *.php$\n";
        $txt .= "Disallow: */feed\n";
        $txt .= "Disallow: */feed/\n";
        $txt .= "Disallow: */author\n";
        $txt .= "Disallow: */comment/\n";
        $txt .= "Disallow: */comments/\n";
        $txt .= "Disallow: */trackback/\n";
        $txt .= "Disallow: */comment\n";
        $txt .= "Disallow: */comments\n";
        $txt .= "Disallow: */trackback\n";
        $txt .= "\n";
        $txt .= "# google image bot\n";
        $txt .= "User-agent: Googlebot-Image\n";
        $txt .= "Allow: /*\n";

        return $txt;
    }
}
