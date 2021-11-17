<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use App\View\Components\FormImage;
use Illuminate\{Http\Request, Support\Facades\Validator};

class SettingController extends Controller
{
	public function index()
	{
		return view('pages.setting.list', ['settings' => Settings::cursor()]);
	}

	public function edit(string $id = null)
	{
		return view('pages.setting.edit', ['setting' => Settings::where('option_key', $id)->first()]);
	}

	public function update(string $id = null, Request $request)
	{
		if (!$id) return back()->with('error', 'Invalid key');

		$fileOrString = $request->hasFile('option_value') ? 'image|mimes:jpg,png,jpeg' : 'string';
		$validator    = Validator::make($request->all(), [
			'prev_option_value' => 'url',
			'option_value'      => "required_if:prev_option_value,null|{$fileOrString}"
		]);

		if ($validator->fails()) return back()->with('error', 'Form is empty.');
		$value = $request->input('option_value');

		if ($request->hasFile('option_value') || $request->has('prev_option_value')) {
			$filePath = FormImage::upload($request, 'option_value', 'settings');

			if (!is($filePath ?? '')) return back()->with('error', 'File is not uploaded');
			$value = $filePath;
		}
		Settings::where('option_key', $id)->update(['option_value' => $value]);
		Settings::getOption($id, true);
		return redirect('list/settings')->with('success', ucwords(str_replace('_', ' ', $id)) . ' updated successfully');
	}
}
