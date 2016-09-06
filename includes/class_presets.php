<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if ( count( get_included_files() ) == 1 ){ exit(); }


/**
 * Preset Robots.txt Files
 */
if ( ! class_exists( 'RobotstxtManager_Presets' ) )
{
    class RobotstxtManager_Presets
    {
        // Plugin Extension Parser
        private $parser;

        
        /**
         * Default Robots.txt File
         * 
         * @return string
         */
        final public function defaultRobotstxt() {
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
            $txt .= "Disallow: /wp-login.php";
            if ( $this->parser() ) { $txt .= $this->parser(); }

            return $txt;
        }


        /**
         * Default-Alt Robots.txt File
         * 
         * @return string
         */
	public function defaultAltRobotstxt() {
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
            $txt .= "Disallow: /wp-login.php";
            if ( $this->parser() ) { $txt .= $this->parser(); }

            return $txt;
	}


        /**
         * Wordpress Only Robots.txt File
         * 
         * @return string
         */
	public function wordpressRobotstxt() {
            $txt = "# robots.txt\n";
            $txt .= "User-agent: *\n";
            $txt .= "Disallow: /wp-admin/\n";
            $txt .= "Disallow: /wp-includes/";
            if ( $this->parser() ) { $txt .= $this->parser(); }

            return $txt;
	}


        /**
         * Open Robots.txt File
         * 
         * @return string
         */
	public function openRobotstxt() {
            $txt = "# robots.txt\n";
            $txt .= "User-agent: *\n";
            $txt .= "Disallow:";

            return $txt;
	}


        /**
         * Blogger Robots.txt File
         * 
         * @return string
         */
	public function bloggerRobotstxt() {
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
            $txt .= "Disallow: /wp-content/plugins/";
            if ( $this->parser() ) { $txt .= $this->parser(); }

            return $txt;
	}


        /**
         * Disallow Website Robots.txt File
         * 
         * @return string
         */
	public function blockedRobotstxt() {
            $txt = "# robots.txt\n";
            $txt .= "User-agent: *\n";
            $txt .= "Disallow: /";

            return $txt;
	}


        /**
         * Google Friendly Robots.txt File
         * 
         * @return string
         */
	public function googleRobotstxt() {
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
            $txt .= "Disallow: /wp-content/plugins/";
            if ( $this->parser() ) { $txt .= $this->parser(); }
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

        /**
         * Plugin Extension Parser
         * 
         * @return string/void
         */
        final private function parser()
        {
            if ( defined( 'RTM_Api' ) ) {
                $this->rtm = new RTM_Extension();
                $this->parser = $this->rtm->parseRobotstxt();
            }
        }
    }
}
