<?php
/**
 * @author    WP-Cloud <code@wp-cloud.org>
 * @copyright Copyright (c) 2015, WP-Cloud
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GPL-2.0+
 * @package   WPC\CorePrivacy
 * @version   1.0.0-dev
 */
/*
Plugin Name: Core Privacy
Plugin URI:  https://github.com/wp-cloud/core-privacy
Description: Improve privacy in WordPress core for usage in privacy-restrictive regions
Version:     1.0.0-dev
Author:      WP-Cloud
Author URI:  https://www.wp-cloud.eu
License:     GPL-2.0+
License URI: http://www.gnu.org/licenses/gpl-2.0.html
GitHub Plugin URI: wp-cloud/core-privacy

    Core Privacy
    Copyright (C) 2015 WP-Cloud (http://www.wp-cloud.org)

    This program is free software; you can redistribute it and/or
	modify it under the terms of the GNU General Public License
	as published by the Free Software Foundation; either version 2
	of the License, or (at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace WPC;

/**
 * @todo
 *
 * @since 1.0.0
 */
class CorePrivacy {

	/**
	 * Current Open-Sans Fontface version
	 *
	 * @since 1.0.0
	 */
	CONST open_sans_version = '1.4.0';

	/**
	 * Constructor. Hooks all interactions to initialize the class.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'open_sans' ) );
		add_action( 'init', array( $this, 'gravatar' ) );
	} // END __construct()

	/**
	 * Replace remote Open-Sans with local version
	 *
	 * @since 1.0.0
	 */
	public function open_sans() {

		wp_deregister_style( 'open-sans' );
		wp_register_style( 'open-sans', plugins_url( 'assets/open-sans/open-sans.css', __FILE__ ), array(), CorePrivacy::open_sans_version );
		wp_enqueue_style( 'open-sans' );

	} // END open_sans()

	/**
	 * @todo desc
	 *
	 * @since 1.0.0
	 */
	public function gravatar() {

		add_filter( 'get_avatar',            array( $this, 'replace_gravatar' ), 1, 5 );
		add_filter( 'default_avatar_select', array( $this, 'default_avatar'   )       );

	} // END gravatar()

	/**
	 * Replace all instances of gravatar with a local image file
	 * to remove the call to remote service.
	 *
	 * @author Andrew Norcross <andrew@andrewnorcross.com>
	 *
	 * @since  1.0.0
	 * @param  string            $avatar Image tag for the user's avatar.
	 * @param  int|object|string $id_or_email A user ID, email address, or comment object.
	 * @param  int               $size Square avatar width and height in pixels to retrieve.
	 * @param  string            $default URL to a default image to use if no avatar is available
	 * @param  string            $alt Alternative text to use in the avatar image tag.
	 * @return string `<img>` tag for the user's avatar.
	 */
	public function replace_gravatar( $avatar, $id_or_email, $size, $default, $alt ) {

		// swap out the file for a base64 encoded image
		$image  = 'data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==';
		$avatar = "<img alt='{$alt}' src='{$image}' class='avatar avatar-{$size} photo' height='{$size}' width='{$size}' style='background:#eee;' />";

		// return the item
		return $avatar;

	} // END replace_gravatar()

	/**
	 * Remove avatar images from the default avatar list
	 *
	 * @author Andrew Norcross <andrew@andrewnorcross.com>
	 *
	 * @since  1.0.0
	 * @param  string $avatar_list List of default avatars
	 * @return string              Updated list with images removed
	 */
	public function default_avatar( $avatar_list ) {

		// remove images
		$avatar_list_processed = preg_replace( '|<img([^>]+)> |i', '', $avatar_list );

		// send it back
		return $avatar_list_processed;

	} // END default_avatar()

} // class CorePrivacy

new CorePrivacy();
