@props(['id', 'content', 'disabled', 'size', 'type', 'selectText', 'dataArray', 'multiple', 'search', 'title'])
{{-- <div class="col-md-{{ $size }}"> --}}
<div class="col-md-3">
	<div class="mb-3">
		<label for="{{ $content }}" class="form-label">{{ $content }}</label>
		<select @if (!empty($multiple)) multiple @endif class="form-select" id="{{ $id }}" name="task_id"
			required @if (!empty($disabled)) disabled @endif
			@if (!empty($search)) data-live-search="true" @endif
			@if (!empty($title)) title="{{ $title }}" @endif>
			<option selected value="">Select {{ $content }}</option>
			@foreach ($dataArray as $data)
				<option value="{{ $data->id }}">{{ $data->{$selectText} }}</option>
			@endforeach
		</select>
	</div>
</div>

{{-- <x-form-select id="status_select" content="Status" size="6" selectText="status"  :dataArray="$statusTask" ></x-form-select> --}}
