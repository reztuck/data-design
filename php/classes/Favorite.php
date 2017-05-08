<?php
/**
 * Created by PhpStorm.
 * User: Tucker
 * Date: 4/24/2017
 * Time: 10:53 PM
 */

namespace Edu\Cnm\DataDesign;
require_once("autoload.php");
class Favorite implements  \JsonSerializable {
	use ValidateDate;

//	 id for profile that has favored the product
	private $favoriteProfileId;

// id for product that has been favored
	private $favoriteProductId;

//	 date that the profile favored the product
	private $favoriteDate;

//Constructor for this favorite
public function __construct(int $newFavoriteProfileId, int $newFavoriteProductId, $newFavoriteDate) {
	try {
		$this->setFavoriteProfileId($newFavoriteProfileId);
		$this->setFavoriteProductId($newFavoriteProductId);
		$this->setFavoriteDate($newFavoriteDate);
	}
	//determine what exception type was thrown
	catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
		$exceptionType = get_class($exception);
		throw(new $exceptionType($exception->getMessage(), 0, $exception));
	}
}

/**		START FAVORITE PROFILE ID SECTION		**/

/*
 * Accessor method for favorite profile id
 * */
public function getFavoriteProfileId() : int {
	return($this->favoriteProfileId);
}
/*
 * Mutator method for the favorite profile id
 * */
public function setFavoriteProfileId(int $newFavoriteProfileId) : void {
	// verify the profile id is positive
	if($newFavoriteProfileId <= 0) {
		throw(new \RangeException("favorite profile id is not positive"));
	}
	//convert and store the profile id
	$this->favoriteProfileId = $newFavoriteProfileId;
}

/**			START FAVORITE PRODUCT ID SECTION		**/
 /*
 * Accessor method for favorite product id
 * */
public function getFavoriteProductId() : int {
	return($this->favoriteProductId);
}
/*
 * Mutator method for the favorite profile id
 * */
public function setFavoriteProductId(int $newFavoriteProductId) : void {
	//verify the profile id is positive
	if($newFavoriteProductId <= 0) {
		throw(new \RangeException("product profile id is not positive"));
	}
	//convert and store the profile id
	$this->favoriteProductId = $newFavoriteProductId;
}

/**		START FAVORITE DATE SECTION		**/

/*
 * Accessor method for favorite date
 * */
public function getFavoriteDate() : \DateTime {
	return($this->favoriteDate);
}

/*
 * Mutator method for the favorite profile id
 * */
public function setFavoriteDate($newFavoriteDate = null) : void {
	//base case: if the date is null, use the current date and time
	if($newFavoriteDate == null) {
		$this->favoriteDate = new \DateTime();
		return;
	}
	//store the like date using the ValidateDate trait
	try {
		$newFavoriteDate = self::validateDateTime($newFavoriteDate);
	}	catch(\InvalidArgumentException | \RangeException $exception) {
		$exceptionType = get_class($exception);
		throw(new $exceptionType($exception->getMessage(), 0, $exception));
	}
}




}