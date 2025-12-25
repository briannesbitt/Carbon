```blade
@set($sampleLocales = ['en', 'fr', 'ja', 'hr'])
@set($keys = array_keys($isoFormats = ($date = Carbon::parse('2017-01-05 17:04:05.084512'))->getIsoFormats()))
<table class="macro-formats-table">
	<thead>
	<tr>
		<th>Code</th>
		@foreach($sampleLocales as $locale)
			<th>{{ $locale }}</th>
		@endforeach

	</tr>
	</thead>
	<tbody>
		@foreach($keys as $code)
		<tr>
			<td>
				<code>{{$code}}</code><br>
				{!! preg_match('/^L+$/', $code) ? '<br><code>'.strtolower($code).'</code>' : '' !!}
			</td>
			<td>
				<div class="doc-comment">{{$date->locale($sampleLocales[0])->getIsoFormats()[$code]}}</div>
				<div>{{$date->isoFormat($code)}}</div>
				<div>{{preg_match('/^L+$/', $code) ? $date->isoFormat(strtolower($code)) : ''}}</div>
			</td>
			<td>
				<div class="doc-comment">{{$date->locale($sampleLocales[1])->getIsoFormats()[$code]}}</div>
				<div>{{$date->isoFormat($code)}}</div>
				<div>{{preg_match('/^L+$/', $code) ? $date->isoFormat(strtolower($code)) : ''}}</div>
			</td>
			<td>
				<div class="doc-comment">{{$date->locale($sampleLocales[2])->getIsoFormats()[$code]}}</div>
				<div>{{$date->isoFormat($code)}}</div>
				<div>{{preg_match('/^L+$/', $code) ? $date->isoFormat(strtolower($code)) : ''}}</div>
			</td>
			<td>
				<div class="doc-comment">{{$date->locale($sampleLocales[3])->getIsoFormats()[$code]}}</div>
				<div>{{$date->isoFormat($code)}}</div>
				<div>{{preg_match('/^L+$/', $code) ? $date->isoFormat(strtolower($code)) : ''}}</div>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
```
<style scoped>
.macro-formats-table .doc-comment {
	color: #6c757d;
}

.macro-formats-table tbody td div {
	white-space: nowrap;
}
</style>