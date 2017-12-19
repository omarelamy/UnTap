<?php 
/**
 * @package Untap Products Plugin
 */

/*
Plugin Name: Untap Products 
Description: This is a plugin that creates a custom post type called "Products".
Author: Omar El-Elaimy
Author URI: https://github.com/omarelaimy
Version: 1.0.0
*/
/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2005-2015 Automattic, Inc.
*/

//Make sure that no one uses the plugin improperly.
if (! function_exists('add_action'))
{
	echo 'Hello, this is a plugin that must be used properly and in a legal way.. Please GET OUT!';
	die;
}

class UnTapProducts
{
	//The constructor of the class.
	function __construct()
	{
		add_action('init', array($this, 'custom_post_type'));

		//This function would be called to create the custom metabox within the constructor
		add_action( 'admin_init', array($this,'create_metabox'));

		//This function would be triggered when saving a new post to the products 
		add_action( 'save_post', array($this,'add_product_fields'), 10, 2 );
	}

	//Activate function that's called when the plugin is activated.
	function activate()
	{
			//create a CPT (Custom Post Type)
			$this->custom_post_type();
			//flush rewrite rules
			flush_rewrite_rules();
	}
	
	//Deactivate function that's called when the plugin is deactivated.
	function deactivate()
	{
			// flush rewrite rules
		    flush_rewrite_rules();
	}

	//Function that creates the custom post type within the plugin.
	function custom_post_type()
	{
		//Register the Custom Post Type using WordPress's built-in function.
		register_post_type('Product', array(
            'labels' => array(
                'name' => 'Products',
                'singular_name' => 'Product',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Product',
                'edit' => 'Edit',
                'edit_item' => 'Edit Product',
                'new_item' => 'New Product',
                'view' => 'View',
                'view_item' => 'View Product',
                'search_items' => 'Search Products',
                'not_found' => 'No Products found',
                'not_found_in_trash' => 'No Products found in Trash'
            ),'public' => true));
	}

	//Function that creates a metabox within the post type named 'Product'.
	function create_metabox() 
	{
    	add_meta_box( 'product_details_meta_box',
        'Product Details',
        array($this, 'display_product_details_meta_box'),
        'Product', 'normal', 'high'
    );
	}

	//Function that displays the details for the Product Details metabox associated with the given product.
	function display_product_details_meta_box($product)
	{
		// Retrieve the stock and Price based on Product ID
    	$product_stock = get_post_meta( $product->ID, 'Product_Stock', true );
    	$product_price = get_post_meta( $product->ID, 'Product_Price', true );
    	?>
    	 <table>
        <tr>
            <td style="width: 100%">Stock</td>
            <td><input type="text" size="80" name="product_stock" id="product-stock" value="<?php echo $product_stock; ?>" /></td>
        </tr>

        <tr>
            <td style="width: 100%">Price</td>
            <td><input type="text" size="80" name="product_price" id="product-price" value="<?php echo $product_price; ?>" /></td>
        </tr>
    	</table>
    <?php	
	}

	//Function that adds the product fields to the database.
	function add_product_fields($product_id,$product)
	{
		// Check post type for product
	    if ( $product->post_type == 'product' ) 
	    {
	        // Store data in post meta table if present in post data
	        if ( isset( $_POST['product_stock'] ) && $_POST['product_stock'] != '' ) 
	        {
	            update_post_meta( $product_id, 'Product_Stock', $_POST['product_stock'] );
	        }
	        if ( isset( $_POST['product_price'] ) && $_POST['product_price'] != '' ) 
	        {
	            update_post_meta( $product_id, 'Product_Price', $_POST['product_price'] );
	        }	
	    }
	}

}

if (class_exists('UnTapProducts'))
{
	$untapProducts = new UnTapProducts();
}

//Activate the plugin 
register_activation_hook(__FILE__, array($untapProducts, 'activate'));

//Deactivate the plugin 
register_deactivation_hook(__FILE__, array($untapProducts, 'deactivate'));
?>


