<form method="post" action="/settings/signature" class="ui form">
	{{ csrf_field() }}
	{{ method_field('PATCH') }}

	<h4 class="ui dividing header">Signature</h4>
	<div class="field {{ $errors->has('signature') ? ' error' : '' }}">
		<label for="signature">Signature</label>
		<textarea name="signature" id="editor1" cols="30" rows="10">{{ old('signature') ?? $user->signature }}</textarea>
	</div>

	<div class="field">
		<button class="ui primary button">Update</button>
	</div>
</form>

@push('script')
<script src="/ckeditor/ckeditor.js"></script>
<script>
	CKEDITOR.replace('editor1')
</script>
@endpush

