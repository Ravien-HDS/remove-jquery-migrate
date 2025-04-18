<?php
/**
 * Plugin Name: Remove jQuery Migrate
 * Plugin URI:  https://github.com/icaru12/remove-jquery-migrate
 * Description: A very lightweight plugin that removes jQuery Migrate script from your WordPress site's front end when the plugin is active.
 * Version:     1.0.3
 * Author:      Hendy Tan
 * Author URI:  https://github.com/icaru12
 * Text Domain: remove-jquery-migrate
 * License:     GPLv3
 */

/**
 * Copyright (C) 2017-2022 Hendy Tan (https://github.com/icaru12)
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'twf_remove_jquery_migrate' ) ) {
    /**
     * Remove jQuery Migrate script from the jQuery bundle only in front end.
     *
     * @since 1.0.0
     *
     * @param \WP_Scripts $scripts WP_Scripts instance.
     * @return void
     */
    function twf_remove_jquery_migrate( WP_Scripts $scripts ) {
        // Only proceed if not in admin and jQuery is registered
        if ( is_admin() || ! isset( $scripts->registered['jquery'] ) ) {
            return;
        }

        $script = $scripts->registered['jquery'];

        // Early exit if no dependencies exist
        if ( empty( $script->deps ) ) {
            return;
        }

        // Remove jquery-migrate from dependencies
        $script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
    }

    add_action( 'wp_default_scripts', 'twf_remove_jquery_migrate' );
}
