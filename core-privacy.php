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

} // class CorePrivacy

new CorePrivacy();
