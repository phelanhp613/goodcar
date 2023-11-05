<?php

namespace Modules\Base\Components;

use Illuminate\View\Component;

class AutocompleteField extends Component
{
	public $id;

	public $name;

	public $options;

	public $selectedOptions;

	public $action;

	public $multiple;

	/**
	 * @param $id
	 * @param $name
	 * @param $options
	 * @param $selectedOptions
	 * @param $multiple
	 * @param $action
	 */
	public function __construct($id, $name, $options, $selectedOptions, $multiple, $action)
	{
		$this->id              = $id;
		$this->name            = !empty($name) ? $name : '';
		$this->options         = !empty($options) ? $options : [];
		$this->selectedOptions = !empty($selectedOptions) ? $selectedOptions : [];
		$this->multiple        = $multiple ?? false;
		$this->action          = $action ?? '#';
	}

	/**
	 * @return \Closure|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Support\Htmlable|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|string
	 */
	public function render()
	{
		return view('Base::components.form.autocomplete');
	}
}
