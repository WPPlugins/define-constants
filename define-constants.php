<?php
/*
Plugin Name: Define Constants
Description: Lets you define constants from your admin panel.
Version: 1.2.1
License: GPL2
Author: Ramon Fincken, Danny van Kooten
Author URI: http://www.mijnpress.nl
*/

/*  Copyright 2010  Danny van Kooten  (email : danny@vkimedia.com)
 *  Idea and code changes by Ramon Fincken

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

require_once('php/frontend.php');
$Define_Constants = new Define_Constants();

if(is_admin()) {
	require_once('php/backend.php');
	$Define_Constants_Admin = new Define_Constants_Admin();
}

?>