<?php

namespace Modules\Base\Components;

use Illuminate\Support\Str;
use Illuminate\View\Component;

class TextareaContentTab extends Component
{
	public $content;

	public function __construct($content)
	{
		$content       = str_replace('&quot;', '"', $content);
		$this->content = json_decode($content ?? '[]');
		$this->content = !empty($this->content) ? $this->content : [];
	}

	/**
	 * @param $content
	 *
	 * @return array
	 */
	public static function setContent($content)
	{
		$data = [];
		if(!empty($content['sort'])) {
			foreach($content['sort'] as $item) {
				$item       = $content[$item];
				$data[] = [
					'label'        => !empty($item['label']) ? $item['label'] : $item['label_hidden'],
					'label_hidden' => $item['label_hidden'],
					'url'          => Str::slug($item['label_hidden']),
					'content'      => $item['content'],
				];
			}
		}else {
			foreach(($content ?? []) as $item) {
				$data[] = [
					'label'        => !empty($item['label']) ? $item['label'] : $item['label_hidden'],
					'label_hidden' => $item['label_hidden'],
					'url'          => Str::slug($item['label_hidden']),
					'content'      => $item['content'],
				];
			}
		}

		return $data;
	}

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */
	public function render()
	{
		return view('Base::components.form.textarea_content_tab');
	}
}
