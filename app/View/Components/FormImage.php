<?php

namespace App\View\Components;

use Illuminate\{Http\Request, View\Component};

class FormImage extends Component
{
	public $name;

	public function __construct($name = null)
	{
		$this->name  = $name;
	}

	public static function upload(Request $request, $fileName = 'file', $location = null)
	{
		if ($request->hasFile($fileName)) {
			$file   = $request->file($fileName);
			$folder = ($location ?? '');
			$name   = time() . '.' .  $file->getClientOriginalExtension();
			return str_replace('/public', '/public/uploads', asset($file->storeAs($folder, $name, 'uploads')));
		} elseif ($request->has('prev_' . $fileName))
			return $request->input('prev_' . $fileName);
		return false;
	}

	/** Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\Contracts\View\View|\Closure|string */
	public function render()
	{
		return view('components.form-image');
	}
}
