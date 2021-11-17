<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\View\Components\FormImage;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
	public function index()
	{
		return view('pages.category.list', [
			'categories' =>
			Categories::select(
				'categories.id',
				'categories.slug',
				'categories.title',
				'categories.post_type',
				'categories.image',
				'categories.status',
				'categories.created_date',
				'users.first_name as created_by',
				'users.profile_pic',
			)
				->where('categories.status', '1')
				->leftJoin('users', 'users.id', '=', 'categories.created_by')
				->orderByDesc('categories.id')
				->get()
		]);
	}

	public function add()
	{
		return view('pages.category.add');
	}

	public function create(Request $request)
	{
		$request->validate([
			"extra_field" => "required|numeric",
			"post_type"   => "required|in:vehicle",
			"title"       => "required|string|min:3",
			"file"        => "required|mimes:png,jpg,jpeg|max:2048",
		]);

		if ($request->hasFile('file')) {
			$filePath = FormImage::upload($request, 'file', 'categories');
			if (!is($filePath ?? '')) return back()->with('error', 'File is not uploaded');
			Categories::create([
				'status'      => '1',
				'image'       => $filePath,
				'created_by'  => $request->user()->id,
				'modified_by' => $request->user()->id,
				'title'       => $request->input('title'),
				'post_type'   => $request->input('post_type'),
				'extra_field' => $request->input('extra_field'),
			]);
			return redirect('list/categories')->with('success', $request->input('title') . ' successfully added');
		}
	}

	public function edit($slug)
	{
		$category = Categories::where('slug', $slug)->first();
		if (!is($category ?? '', 'object')) return back()->with('error', 'Category not found');

		return view('pages.category.edit', ['category' => $category]);
	}

	public function update($slug, Request $request)
	{
		$category = Categories::where('slug', $slug)->first();
		if (!is($category ?? '', 'object')) return back()->with('error', 'Category not found');

		$request->validate([
			"extra_field" => "required|numeric",
			"post_type"   => "required|in:vehicle",
			"title"       => "required|string|min:3",
			"file"        => "required|mimes:png,jpg,jpeg|max:2048",
		]);

		if ($request->hasFile('file') || $request->has('prev_file')) {
			$filePath = FormImage::upload($request, 'file', 'categories');

			if (!is($filePath ?? '')) return back()->with('error', 'File is not uploaded');
			Categories::where('slug', $slug)->update([
				'status'      => '1',
				'image'       => $filePath,
				'modified_by' => $request->user()->id,
				'title'       => $request->input('title'),
				'post_type'   => $request->input('post_type'),
				'extra_field' => $request->input('extra_field'),
			]);
			return redirect('list/categories')->with('success', $request->input('title') . ' successfully updated');
		}
		return back()->with('error', 'File not found.');
	}

	public function delete($slug)
	{
		$category = Categories::where('slug', $slug)->first();
		if (!is($category ?? '', 'object')) return back()->with('error', 'Category not found');

		Categories::where('slug', $slug)->update(['status' => '3']);
		return redirect('/list/categories')->with('success', 'Category deleted successfully');
	}
}
