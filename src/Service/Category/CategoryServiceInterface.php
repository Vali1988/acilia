<?php


namespace App\Service\Category;


use App\Entity\Category;

interface CategoryServiceInterface
{
	function create($entity);
	function update($entity);
	function delete($entity);
}