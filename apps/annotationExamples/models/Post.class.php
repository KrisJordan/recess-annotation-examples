<?php
/**
 * !Database Default
 * !Table posts
 */
class Post extends Model {
	/** !Column PrimaryKey, Integer, AutoIncrement */
	public $id;

	/**
	 * !Column String
	 * !SlugIt titleSlugged
	 **/
	public $title;

	/** !Column Text */
	public $body;

}
?>