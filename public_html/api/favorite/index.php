<?php
/**
 * Created by PhpStorm.
 * User: Tucker
 * Date: 4/30/2017
 * Time: 8:00 PM
 */

/**
 * inserts this Favorite into mySQL
 *
 * @param \PDO $pdo PDO connection object
 * @throws \PDOException when mySQL related errors occur
 * @throws \TypeError if $pdo is not a PDO connection object
 **/
public function insert(\PDO $pdo): void {
	// enforce the favoriteProductId is null (i.e., don't insert a favorite that already exists)
	if($this->favoriteProductId !== null) {
		throw(new \PDOException("not a new favorite"));
	}
	// create query template
	$query = "INSERT INTO favorite(favoriteProfileId, favoriteProductId, favoriteDate) VALUES(:tweetProfileId, :tweetContent, :tweetDate)";
	$statement = $pdo->prepare($query);
	// bind the member variables to the place holders in the template
	$formattedDate = $this->favoriteDate->format("Y-m-d H:i:s.u");
	$parameters = ["favoriteProfileId" => $this->favoriteProfileId, "favoriteProductId" => $this->favoriteProductId, "favoriteDate" => $formattedDate];
	$statement->execute($parameters);
	// update the null favoriteProductId with what mySQL just gave us
	$this->favoriteProductIdId = intval($pdo->lastInsertId());
}

/**
 * deletes this Favorite from mySQL
 *
 * @param \PDO $pdo PDO connection object
 * @throws \PDOException when mySQL related errors occur
 * @throws \TypeError if $pdo is not a PDO connection object
 **/
public function delete(\PDO $pdo): void {
	// enforce the favoriteProductId is not null (i.e., don't delete a tweet that hasn't been inserted)
	if($this->favoriteProductId === null) {
		throw(new \PDOException("unable to delete a tweet that does not exist"));
	}
	// create query template
	$query = "DELETE FROM favorite WHERE favoriteProductId = :favoriteProductId";
	$statement = $pdo->prepare($query);
	// bind the member variables to the place holder in the template
	$parameters = ["favoriteProductId" => $this->favoriteProductId];
	$statement->execute($parameters);
}

/**
 * updates this Favorite in mySQL
 *
 * @param \PDO $pdo PDO connection object
 * @throws \PDOException when mySQL related errors occur
 * @throws \TypeError if $pdo is not a PDO connection object
 **/
public function update(\PDO $pdo): void {
	// enforce the favoriteProductId is not null (i.e., don't update a favorite that hasn't been inserted)
	if($this->favoriteProductId === null) {
		throw(new \PDOException("unable to update a favorite that does not exist"));
	}
	// create query template
	$query = "UPDATE favorite SET favoriteProfileId = :favoriteProfileId, favoriteProductId = :favoriteProductId, favoriteDate = :favoriteDate WHERE favoriteProductId = :favoriteProductId";
	$statement = $pdo->prepare($query);
	// bind the member variables to the place holders in the template
	$formattedDate = $this->favoriteDate->format("Y-m-d H:i:s.u");
	$parameters = ["favoriteProfileId" => $this->favoriteProfileId, "favoriteProductId" => $this->favoriteProductId;
	$statement->execute($parameters);
}

/*
 * Gets a Favorite by favoriteProfileId
 */
public static function getFavoriteByFavoriteProfileId(\PDO $pdo, int $favoriteProfileId): ?Favorite {
	// sanitize the favoriteId before searching
	if($favoriteProfileId <= 0) {
		throw(new \PDOException("favorite profile id is not positive"));
	}
	// create query template
	$query = "SELECT favoriteProductId, favoriteProfileId, favoriteDate FROM favorite WHERE favoriteProfileId = :favoriteProfileId";
	$statement = $pdo->prepare($query);
	// bind the favorite id to the place holder in the template
	$parameters = ["favoriteProductId" => $favoriteProfileId];
	$statement->execute($parameters);
	// grab the favorite from mySQL
	try {
		$favorite = null;
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		$row = $statement->fetch();
		if($row !== false) {
			$favorite = new Favorite($row["favoriteProfileId"], $row["favoriteProfileId"], $row["favoriteProductId"], $row["favoriteDate"]);
		}
	} catch(\Exception $exception) {
		// if the row couldn't be converted, rethrow it
		throw(new \PDOException($exception->getMessage(), 0, $exception));
	}
	{
		return ($favorite);
	}