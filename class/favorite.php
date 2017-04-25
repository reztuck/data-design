<?php
/**
 * Created by PhpStorm.
 * User: Tucker
 * Date: 4/24/2017
 * Time: 10:53 PM
 */

namespace Edu\Cnm\DataDesign;
require_once ("autoload.php");
class Favorite implements  \JsonSerializable (
	use Edu\Cnm\DataDesign\ValidateDate;
	/*
	 * id for this Profile; this is the primary key
	 * @var int $profileId
	 */
	private
	/*
	 * id of the Profile that sent this
	 */
)