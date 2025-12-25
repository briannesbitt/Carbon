```blade
<table class="info-table" id="iso-format-available-replacements">
	<thead>
	<tr>
		<th>Code</th>
		<th>Example</th>
		<th>Description</th>
	</tr>
	</thead>
	<tbody>
	@set($date = Carbon::parse('2017-01-05 17:04:05.084512'))
	@set($keys = array_filter(array_keys(Carbon::getIsoUnits()), function ($code) {
		return !preg_match('/^hmm/i', $code);
	}))
	@foreach($keys as $code)
		<tr>
			<td>{{ $code}}</td>
			<td>{{ $date->isoFormat($code)}}</td>
			<td>{{ $date->describeIsoFormat($code)}}</td>
		</tr>
	@endforeach
	</tbody>
</table>
```