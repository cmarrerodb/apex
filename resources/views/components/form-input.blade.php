@props(['id', 'content', 'disabled', 'size', 'type', 'class', 'list', 'multiple', 'autocomplete'])
<div class='col-md-{{ $size }}'>
	<div class='mb-3'>
		<label for="{{ $id }}" class='form-label'>{{ $content }}</label>
		<input id="{{ $id }}" @if (!empty($hidden)) hidden @endif
			@if (!empty($disabled)) disabled @endif class='form-control'
			@if (!empty($type)) type="{{ $type }}" @endif name="{{ $id }}"
			placeholder="{{ $content }}" @if (!empty($list)) list="{{ $list }}" @endif
			@if (!empty($multiple)) multiple @endif
			@if (!empty($autocomplete)) autocomplete="{{ $autocomplete }}" @endif />
	</div>
</div>
