<?php
/**
 * Created by PhpStorm.
 * User: Tucker
 * Date: 4/20/2017
 * Time: 8:10 AM
 */

namespace Edu\Cnm\DataDesign;
require_once ("autoload.php");
class Product implements  \JsonSerializable (
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