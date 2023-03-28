# WOOEnableGutenberg Plugin for Wordpress/WOOCommerce

A quick and dirty solution to enable the Wordpress Block Editor on Products within WooCommerce and Wordpress, which at the time of creation 2023/03, and WooCommerce v7.2 still required this solution.

## Description

To enable the Wordpress block editor on WooCommerce. An excellent example was found by [@KalimahApps](https://github.com/kalimahapps/), however this was not working for the theme I was provided. A distinct repository, this one, was created to work through the problem for myself.

The issue proved to be that for the theme I was tackling the priority of the filters for post_type had to be increased to take precedence over the theme-default. However with the investigation, no problems were found in using the WooCommerce default WP_Admin_Types class and method to display the product_visibility metabox.

## Technologies

* PHP
* WooCommerce: <=7.2
* Wordpress: >= 5.0

## Getting Started

### Installing and Setup

* Copy the single file within src to wp-content/plugins/WOOEnableGutenberg/ within your Wordpress installation
* Activate the plugin in your WP Dashboard > Plugins > WOOEnableGutenberg

## Use

By default Products will now be editable with the Wordpress Block Editor. After Kalimah Apps work [@KalimahApps](https://github.com/kalimahapps) [https://dev.to/kalimahapps](https://dev.to/kalimahapps), appending the URL with the GET var 'classic-editor' will allow you to drop back to the classic editor.

## Version History

* 0.1
    * Initial Release

## Authors

* Jim Brittain: [@jimbrittain](https://github.com/jimbrittain/) [immaturedawn](http://www.immaturedawn.co.uk)

## License

MIT License Copyright (c) 2023 Immature Dawn. This project is licensed under the terms of the MIT license. See the LICENSE.md file for details.

## Acknowledgements
* [@KalimahApps](https://github.com/kalimahapps/)
* [@woocommerce](https://github.com/woocommerce/)
* [@WordPress](https://github.com/wordpress/)
