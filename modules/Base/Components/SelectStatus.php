<?php

namespace Modules\Base\Components;

use Illuminate\View\Component;
use Modules\Base\Models\Status;

class SelectStatus extends Component
{

	public $id;

	public $name;

	public $status;

	public function __construct($id, $name, $status)
	{
		$this->id     = $id;
		$this->name   = $name;
		$this->status = $status;
	}

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */
	public function render()
	{
		$statuses = Status::getStatuses();

		return view('Base::components.form.select_status', compact('statuses'));
	}
}
