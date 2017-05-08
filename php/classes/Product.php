<?php
/**
 * Created by PhpStorm.
 * User: Tucker
 * Date: 4/20/2017
 * Time: 8:10 AM
 */

namespace Edu\Cnm\DataDesign;
require_once("autoload.php");
class Product implements  \JsonSerializable {
	use ValidateDate;

//	This is the id of the product
	private $productId;

//	This is the id of the profile that owns the product
	private $productProfileId;

//	This is the description of the product
	private $productDescription;

//	This is the date that the product was added
	private $productDateTime;

	//Constructor for this favorite
	public function __construct(int $newFavoriteProfileId, int $newFavoriteProductId, $newFavoriteDate) {
		try {
			$this->setProductId($newProductId);
			$this->setProductProfileId($newProductProfileId);
			$this->setProductDescription($newProductDescription);
			$this->setProductDateTime($newProductDateTime);
		}
			//determine what exception type was thrown
		catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	/**		START PRODUCT ID SECTION		**/

	/*
	 * Accessor method for product id
	 */
	public function getProductId() : ?int {
		return($this->productId);
	}

	/*
	 * Mutator method for product id
	 */
	public function setProductId(?int $newProductId) : void {
		//if product id is null immediately return it
		if($newProductId === null) {
			$this->productId = null;
			return;
		}
		// verify the product id is positive
		if($newProductId <= 0) {
			throw(new \RangeException("product id is not positive"));
		}
		// convert and store the product id
		$this->productId = $newProductId;
	}

	/**		START PRODUCT PROFILE ID SECTION		**/

	/*
	 * Accessor method for product profile id
	 */
	public function getProductProfileId() : int {
		return($this->productProfileId);
	}

	/*
	 * Mutator method for product profile id
	 */
	public function setProductProfileId(int $newProductProfileId) : void {
		// verify the profile id is positive
		if($newProductProfileId <= 0) {
			throw(new \RangeException("product profile id is not positive"));
		}
		// convert and store the profile id
		$this->productProfileId = $newProductProfileId;
	}

	/**		START PRODUCT DESCRIPTION SECTION		**/

	/*
	 * Accessor method for product description
	 */
	public function getProductDescription() :string {
		return($this->productDescription);
	}

	/*
	 * Mutator method for product description
	 */
	public function setProductDescription(string $newProductDescription) : void {
		// verify the product description is secure
		$newProductDescription = trim($newProductDescription);
		$newProductDescription = filter_var($newProductDescription, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newProductDescription) === true) {
			throw(new \InvalidArgumentException("product description is empty or insecure"));
		}
		// verify the product description will fit into the database
		if(strlen($newProductDescription) > 140) {
			throw(new \RangeException("product description too large"));
		}
		// store the product description
		$this->productDescription = $newProductDescription;
	}

	/**		START PRODUCT DATETIME SECTION		**/
	/*
	 * Accessor method for product date
	 */
	public function getProductDateTime() : \DateTime {
		return($this->productDateTime);
	}

	/*
	 * Mutator method for product date
	 */
	public function setProductDateTime($newProductDateTime = null) : void {
		// base case: if the date is null, use the current date and time
		if($newProductDateTime === null) {
			$this->productDateTime = new \DateTime();
			return;
		}
		// store the like date using the ValidateDate trait
		try {
			$newProductDateTime = self::validateDateTime($newProductDateTime);
		} catch(\InvalidArgumentException | \RangeException $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		$this->productDateTime = $newProductDateTime;
	}






}