<div class="row mt-2">
    <div class="col">
        @if (is($prev ?? ''))
            <div class="mb-4">
                <img class="img-fluid shadow" style="border-radius: 24px" src={{ $prev ?? '' }} />
                <input type="hidden" name={{ 'prev_' . $name ?? 'prev_file' }} value={{ $prev ?? '' }}>
            </div>
        @endif
        <div class="mb-2">
            <label class="form-label" for={{ Str::slug($title) . $name ?? '' }}>
                Upload @if (is($prev ?? ''))to replace previous @endif {{ $title ?? 'image' }}
            </label>
            <input class="form-control form-control-lg" id={{ Str::slug($title) . $name ?? '' }} type="file"
                name={{ $name ?? 'file' }} accept="image/png, image/jpeg, image/jpg">
        </div>
    </div>
</div>
