

```blade
<table class='locales-table'>
	<thead>
		<tr>
			<th>Locale</th>
			<th>Language</th>
			<th>Diff syntax</th>
			<th>1-day diff</th>
			<th>2-days diff</th>
			<th>Month names</th>
			<th>Week days</th>
			<th>Units</th>
			<th>Short units</th>
			<th>Period</th>
		</tr>
	</thead>
<tbody>
	@foreach(Carbon::getAvailableMacroLocales() as $locale)
		<tr>
			<td>{{$locale}}</td>
			<td>{{new Language($locale)->getIsoName()}}</td>
			<td>{{Carbon::localeHasDiffSyntax($locale) ? '✅' : '❌'}}</td>
			<td>{{Carbon::localeHasDiffOneDayWords($locale) ? '✅' : '❌'}}</td>
			<td>{{Carbon::localeHasDiffTwoDayWords($locale) ? '✅' : '❌'}}</td>
			<td>{{substr($locale, 0, 2) === 'en' || Carbon::parse('january')->monthName !== Carbon::parse('january')->locale($locale)->monthName || Carbon::parse('march')->monthName !== Carbon::parse('march')->locale($locale)->monthName ? '✅' : '❌' }}</td>
			<td>{{substr($locale, 0, 2) === 'en' || Carbon::parse('monday')->dayName !== Carbon::parse('monday')->locale($locale)->dayName || Carbon::parse('sunday')->dayName !== Carbon::parse('sunday')->locale($locale)->dayName ? '✅' : '❌'}}</td>
			<td>{{substr($locale, 0, 2) === 'en' || Carbon::now()->translate('month') !== Carbon::now()->locale($locale)->translate('month') || Carbon::now()->translate('day') !== Carbon::now()->locale($locale)->translate('day') ? '✅' : '❌' }}</td>
			<td>{{ substr($locale, 0, 2) === 'en' || Carbon::now()->translate('m') !== Carbon::now()->locale($locale)->translate('m') || Carbon::now()->translate('d') !== Carbon::now()->locale($locale)->translate('d') ? '✅' : '❌' }}</td>
			<td>{{ Carbon::localeHasPeriodSyntax($locale) ? '✅' : '❌' }}</td>
		</tr>
	@endforeach
	</tbody>
</table>
```

<style scoped>
.locales-table th {
  white-space: nowrap !important;
  text-align: center !important;
  writing-mode: vertical-rl;
}
</style>