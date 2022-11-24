<?php
/**
 * Class Trait.
 *
 * @author Chris W. <chrisw@null.net>
 * @license GNU GPL
 */

namespace RobotstxtManager;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Process Plugin Admin Query String.
 */
trait TraitQueryString
{
    /**
     * Get Query String Item & Sanitize.
     *
     * @param string $get Query String Get Item.
     *
     * @return string Query String Item Sanitized
     */
    final public function queryString($get): string
    {
        $string = filter_input(
            INPUT_GET,
            $get,
            FILTER_UNSAFE_RAW,
            FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK
        );

        if (true !== isset($string)) {
            return '';
        }

        $string = strtolower($string);

        $string = preg_replace('/\s/', '', $string);

        return sanitize_text_field($string);
    }
}
