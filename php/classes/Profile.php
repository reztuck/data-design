<?php
/**
 * Created by PhpStorm.
 * User: Tucker
 * Date: 4/20/2017
 * Time: 8:10 AM
 */

namespace Edu\Cnm\DataDesign;
require_once("autoload.php");
class Profile implements \JsonSerializable {
	use ValidateDate;

//	id for profile
	private $profileId;

//	Activation token for account validation
	private $profileActivationToken;

//	This is the username for the profile
	private $profileAtHandle;

//	This is the email of the profile
	private $profileEmail;

//	This is the private profile phone number
	private $profilePhone;

//	This is the private profile salt used for validation
	private $profileSalt;

//	This is the private profile hash used for validation
	private $profileHash;


	/**
	 * constructor for this Tweet
	 *
	 * @param int|null $newTweetId id of this Tweet or null if a new Tweet
	 * @param int $newTweetProfileId id of the Profile that sent this Tweet
	 * @param string $newTweetContent string containing actual tweet data
	 * @param \DateTime|string|null $newTweetDate date and time Tweet was sent or null if set to current date and time
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 * @Documentation https://php.net/manual/en/language.oop5.decon.php
	 **/

	public function __construct(?int $newProfileId, int $newProfileActivationToken, string $newProfileAtHandle, string $newProfileEmail, int $newProfileSalt, int $newProfileHash, string $newProfilePhone) {
		try {
			$this->setProfileId($newProfileId);
			$this->setProfileActivationToken($newProfileActivationToken);
			$this->setProfileAtHandle($newProfileAtHandle);
			$this->setProfileEmail($newProfileEmail);
			$this->setProfileSalt($newProfileSalt);
			$this->setProfileHash($newProfileHash);
			$this->setProfilePhone($newProfilePhone);
		}

		catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}
	/*
	 * Accessor method for profileId
	 * */
	public function getProfileId() : ?int {
		return($this->profileId);
	}
	/*
	 * Mutator method for profileId
	 * */
	public function setProfileId(?int $newProfileId) : void {
		// If profile id is null immediately return it
		if($newProfileId == null) {
			$this->profileId = null;
			return;
		}
		// Verify the profile id is positive
		if($newProfileId <= 0) {
			throw(new \RangeException("profile id is not positive"));
		}
		// Convert and store the profile id
		$this->profileId = $newProfileId;
	}

	/*
	 * Accessor method for profileActivationToken
	 * */
	public function getProfileActivationToken() : ?int {
		return ($this->profileActivationToken);
	}
	/*
	 * Mutator method for profileActivationToken
	 * */
	public function setProfileActivationToken(?int $newProfileActivationToken) : void {
		// If profile activation token is null immediately return it
		if($newProfileActivationToken == null) {
			$this->profileActivationToken = null;
			return;
		}
		// Verify the profile activation token is positive
		if($newProfileActivationToken <= 0) {
			throw(new \RangeException("profile activation token is not positive"));
		}
		// Convert and store the profile activation token
		$this->profileActivationToken = $newProfileActivationToken;
	}

	/*
	 * Accessor method for profileAtHandle
	 * */
	public function getProfileAtHandle() : string {
		return ($this->profileAtHandle);
	}
	/*
	 * Mutator method for profileAtHandle
	 * */
	public function setProfileAtHandle(string $newProfileAtHandle) : void {
		// If profile at handle is null immediately return it
		if($newProfileAtHandle == null) {
			$this->profileAtHandle = null;
			return;
		}
		// Verify the profile at handle is at least four characters or more
		if(strlen($newProfileAtHandle) < 4) {
			throw(new \RangeException("at handle is too short in length. Please use four characters or more"));
		}
		/*
		 * Convert and store the profile at handle
		 * */
		$this->profileAtHandle = $newProfileAtHandle;
	}

	/*
	 * Accessor method for the profileEmail
	 * */
	public function getProfileEmail() : string {
		return ($this->profileEmail);
	}
	/*
	 * Mutator method for the profileEmail
	 * */
	public function setProfileEmail(string $newProfileEmail) : void {
		// Verify that profile email is no longer than 40 and no shorter than 4
		if(strlen($newProfileEmail) <=4) {
			throw(new \RangeException("email is too short!"));
		}
		elseif(strlen($newProfileEmail) >=40) {
			throw(new \RangeException("email is too long!"));
		}
		/*
		 * Convert and store the profile email
		 * */
		$this->profileEmail = $newProfileEmail;
	}

	/*
	 * Accessor method for the profilePhone
	 * */
	public function getProfilePhone() : ?string {
		return ($this->profilePhone);
	}
	/*
	 * Mutator method for profilePhone
	 * */
	public function setProfilePhone(?string $newProfilePhone) : void {
		// Verify that the profile phone is 10 characters exactly
		// USA phones only
		if(strlen($newProfilePhone) !== 10) {
			throw(new \RangeException("please enter a valid 10 digit phone number"));
		}
		/*
		 * Convert and store the profile phone
		 * */
		$this->profilePhone = $newProfilePhone;
	}

	/*
	 * inserts the profile into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 * */
	public function insert(\PDO $PDO) : void{
		// enforce the profile id is null (i.e., don't insert a profile that already exists)
		if($this->profileId !== null) {
			throw(new \PDOException("not a new profile"));
		}
		// Create query template
		$query = "INSERT INTO profile(favoriteProfileId, favoriteProductId, favoriteDate) VALUES(:favoriteProfileId, :favoriteProductId, :favoriteDate)";
		$statement = $PDO->prepare($query);
		// bind the member variables to the place holders in the template
		$formattedDate = $this->favoriteDate->format("Y-m-d H:i:s.u");
		$parameters = ["favoriteProfileId" => $this->favoriteProfileId, "favoriteProductId" => $this->favoriteProductId, "favoriteDate" => $formattedDate];
		$statement->execute($parameters);
		// update the null productId with what mySQL just gave us
		$this->tweetId = intval($PDO->lastInsertId());
	}
	/*
	 * deletes this Favorite from mySQL
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 */
	public function delete(\PDO $PDO) : void {
		// enforce the productId is not null (i.e., don't delete a favorite that hasn't been inserted)
		if($this->productId === null) {
			throw(new \PDOException("unable to delete a favorite that does not exist"));
		}
		// create query template
		$query = "DELETE FROM favorite WHERE productId = :productId";
		$statement = $PDO->prepare($query);
		// bind the member variables to the place holder in the template
		$parameters = ["productId" => $this->productId];
		$statement->execute($parameters);
	}
	/*
	 * gets a Favorite by productId
	 * @param \PDO $pdo PDO connection object
	 * @param int productId favorite id to search for
	 * @return Favorite|null Favorite found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 */
	public static function getFavoriteByFavoriteId(\PDO $PDO, int $productId) : ?Favorite {
		// sanitize the productId before searching
		if(favoriteId <= 0) {
			throw(new \PDOException("favorite id is not positive"));
		}
		// create query template
		$query = "SELECT productId, favoriteProfileId, favoriteProductId, favoriteDate FROM favorite WHERE productId = :productId";
		$statement = $PDO->prepare($query);
		// bind the favorite id to the place holder in the template
		$parameters = ["productId" => $productId];
		$statement->execute($parameters);
		// grab the favorite from mySQL
		try {
			$favorite = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$product = new Favorite($row["productId"], $row["favoriteProfileId"], $row["tweetContent"], $row["tweetDate"]);
			}
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($favorite);
	}
}