<x-app-layout>
    <div class="main-content container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last"></div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class='breadcrumb-header'>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href={{ route('dashboard') }}>Dashboard</a></li>
                            <li class="breadcrumb-item"><a href={{ route('categories') }}>Categories</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-xl-8 col-lg-8 col-sm-8 offset-2">
                <div class="card">
                    <div class="card-header">
                        <h2>Category</h2>
                    </div>
                    <div class="card-body">
                        <form class="p-3" method="POST" enctype="multipart/form-data"
                            action={{ route('category.edit.post', $category->slug) }}>
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-4">
                                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                                            id="title" name="title" placeholder="Category Title *" autofocus
                                            value="{{ $category->title }}">
                                        <small class="form-text text-muted">
                                            <span class="text-danger mr-1">*</span>Required Fields
                                        </small>
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <select
                                            class="selectpicker form-control withoutTagging @error('post_type') is-invalid @enderror"
                                            name="post_type" title=" Select Category Type " autofocus>
                                            <option value="" hidden>Select Category Type</option>
                                            <option value="vehicle" @if (strtolower($category->post_type) === 'vehicle') selected @endif>Vehicle</option>
                                        </select>
                                        @error('post_type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <input type="number"
                                            class="form-control @error('extra_field') is-invalid @enderror"
                                            id="extra_field" name="extra_field" placeholder="Price"
                                            value="{{ $category->extra_field }}">
                                        @error('extra_field')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <x-form-image name="file">
                                <x-slot name="title">Image</x-slot>
                                <x-slot name="prev">{{ $category->image }}</x-slot>
                            </x-form-image>

                            <button type="submit" name="addCategory" value="sfddsfs" class="btn btn-primary mt-4">
                                Update Category
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
