<?php

namespace App\Virtual\Models;

use DateTime;

/**
* @OA\Schema(
*     title="Users",
*     description="User model",
*     @OA\Xml(
*         name="User"
*     )
* )
*/
class User
{

/**
* @OA\Property(
*     title="ID",
*     description="ID",
*     format="int64",
*     example=1
* )
*
* @var integer
*/
private $id;

/**
* @OA\Property(
*      title="Name",
*      description="Name of the new user",
*      example="Matheus S. Jose"
* )
*
* @var string
*/
public $name;

/**
* @OA\Property(
*      title="Email",
*      description="E-mail of the new user",
*      example="This is new email user"
* )
*
* @var string
*/
public $email;

/**
* @OA\Property(
*     title="Created at",
*     description="Created at",
*     example="2020-01-27 17:50:45",
*     format="datetime",
*     type="string"
* )
*
* @var DateTime
*/
private $created_at;

/**
* @OA\Property(
*     title="Updated at",
*     description="Updated at",
*     example="2020-01-27 17:50:45",
*     format="datetime",
*     type="string"
* )
*
* @var DateTime
*/
private $updated_at;

/**
* @OA\Property(
*     title="Deleted at",
*     description="Deleted at",
*     example="2020-01-27 17:50:45",
*     format="datetime",
*     type="string"
* )
*
* @var DateTime
*/
private $deleted_at;
}
