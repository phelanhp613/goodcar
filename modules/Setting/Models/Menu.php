<?php

namespace Modules\Setting\Models;

use Modules\Base\Models\BaseModel;

class Menu extends BaseModel {

	protected $table = "menus";

	protected $primaryKey = "id";

	protected $guarded = [];

	public $timestamps = false;
}
