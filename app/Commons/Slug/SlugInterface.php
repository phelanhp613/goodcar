<?php

namespace App\Commons\Slug;

interface SlugInterface
{
	public function setSlug($slug);

	public function setId($id);

	public function init();
}