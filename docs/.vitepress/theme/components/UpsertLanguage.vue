<template>
	<div v-if="error" class="text-red-600">
		<h5>An error occurred:</h5>
		{{ error }}
	</div>
	<Spinner v-if="isLoading" size="large" class="my-16" />
	<template v-else-if="!isLoading && !error">
		<input
			v-if="!otherLanguageKey"
			v-model="formData.newTranslationCode"
			class="border!
				border-(--vp-c-border)!
				focus:border-(--vp-c-brand-3)!
				my-4
				px-2!
				py-1!
				rounded
				w-full"
			placeholder="New translation code"
		>
		<div class="grid grid-cols-[1fr_1fr_2fr] mt-4 text-sm">
			<div
				class="border-(--vp-c-gray-1)
					border-b
					font-semibold
					mb-4
					pb-4
					px-2"
			>
				English
			</div>
			<div
				class="border-(--vp-c-gray-1)
					border-b
					font-semibold
					mb-4
					pb-4
					px-2"
			>
				{{ formData.newTranslationCode || 'Other Language' }}
			</div>
			<div
				class="border-(--vp-c-gray-1)
					border-b
					font-semibold
					mb-4
					pb-4
					px-2"
			>
				Fix and comments
			</div>
			<template v-for="(item, index) in englishData" :key="item.code">
				<div
					v-if="showMessage(item)"
					class="bg-(--vp-c-warning-soft)
						col-span-3
						leading-relaxed!
						my-4
						p-4
						rounded
						text-sm"
				>
					<div class="font-semibold">
						Warning
					</div>
					Do not uppercase the first letter if it's not required, days/months
					are always uppercase in English, so "Monday" is written this way even in
					a sentence like "See you Monday", please translate the following as if
					it could be in the middle of such sentences.
					Short versions are used in short date formats and minimalist days
					are used calendar headings and such custom usages.
				</div>
				<div
					class="flex items-center p-2"
					:class="index % 2 === 0 ? 'bg-zinc-50 dark:bg-zinc-800' : ''"
				>
					{{ item.result }}
				</div>
				<div
					class="flex items-center p-2"
					:class="index % 2 === 0 ? 'bg-zinc-50 dark:bg-zinc-800' : ''"
				>
					{{ getOtherLanguageResult(item.code) }}
				</div>
				<div
					class="flex items-center p-2"
					:class="index % 2 === 0 ? 'bg-zinc-50 dark:bg-zinc-800' : ''"
				>
					<textarea
						v-model="formData.translationCorrections[item.code]"
						class="border!
							border-(--vp-c-border)!
							focus:border-(--vp-c-brand-3)!
							px-2!
							py-1!
							rounded
							w-full"
						placeholder="This should rather be ... because ..."
						rows="1"
					/>
				</div>
			</template>
		</div>
		<div>
			<h3>Additional fixes</h3>
			<p class="my-0! text-sm">
				If what you wish to fix does not appear in the table, please add it below.
			</p>
			<textarea
				v-model="formData.fixes"
				class="border!
					border-(--vp-c-border)!
					focus:border-(--vp-c-brand-3)!
					px-2!
					py-1!
					rounded
					w-full"
				rows="5"
			/>
		</div>
		<div>
			<h3>Extra Information</h3>
			<p class="my-0! text-sm">
				Add here anything else we may need to know
			</p>
			<textarea
				v-model="formData.extraInformation"
				class="border!
					border-(--vp-c-border)!
					focus:border-(--vp-c-brand-3)!
					px-2!
					py-1!
					rounded
					w-full"
				rows="5"
			/>
		</div>
		<div class="flex justify-center items-center flex-col gap-8 mt-8">
			<div class="text-sm">
				By clicking on Submit, you will be redirected to GitHub where you will
				be required to be logged in (it allows us to keep a trace of your
				authorship and centralize requests).
			</div>
			<div
				class="bg-(--vp-button-brand-bg)
					px-4
					py-2
					rounded
					text-(--vp-button-brand-text)
					transition-colors"
				:class="canSubmit ? 'cursor-pointer hover:bg-(--vp-button-brand-hover-bg)' : 'opacity-50'"
				@click="onSubmitClick"
			>
				Submit
			</div>
		</div>
	</template>
</template>

<script setup lang="ts">
import { computed, onMounted, ref } from 'vue';
import { withBase } from 'vitepress';
import Spinner from './Spinner.vue';

type TranslationItem = {
	code: string;
	result: string;
};

const isLoading = ref(true);
const error = ref('');
const englishData = ref<TranslationItem[]>([]);
const otherLanguageData = ref<TranslationItem[]>([]);
const otherLanguageKey = ref('');

const formData = ref({
	fixes: '',
	extraInformation: '',
	translationCorrections: {} as Record<string, string>,
	newTranslationCode: '',
});

const fetchJson = async (path: string) => {
	const response = await fetch(path);
	return response.json();
};

onMounted(async () => {
	const url = new URLSearchParams(window.location.search);
	otherLanguageKey.value = url.get('lang') || '';

	try {
		englishData.value = await fetchJson(withBase('/data/translations/en.json'));
		if (otherLanguageKey.value) {
			otherLanguageData.value = await fetchJson(withBase(`/data/translations/${otherLanguageKey.value}.json`));
			formData.value.newTranslationCode = otherLanguageKey.value;
		}
	} catch (error_) {
		error.value = `Failed to load translation data: ${error_}`;
		console.error(error.value);
	}
	isLoading.value = false;
});

const getOtherLanguageResult = (key: string) => {
	const item = otherLanguageData.value.find((index) => {
		 return index.code === key;
	});

	// if item is missing get it from english data
	if (!item) {
		const englishItem = englishData.value.find((index) => {
			 return index.code === key;
		});
		return englishItem ? englishItem.result : 'N/A';
	}

	return item.result;
};

const showMessage = (item: TranslationItem) => {
	return item.code === 'Carbon::parse("monday")->dayName';
};

const hasTranslationCorrections = computed(() => {
	for (const key in formData.value.translationCorrections) {
		if (formData.value.translationCorrections[key].trim() !== '') {
			return true;
		}
	}
	return false;
});

const canSubmit = computed(() => {
	const { fixes, newTranslationCode } = formData.value;
	if (newTranslationCode.trim() === '') {
		return false;
	}

	if (fixes.trim() !== '') {
		return true;
	}

	return hasTranslationCorrections.value;
});

const uriParameter = function(name: string, value: string) {
	return `${name}=${encodeURIComponent(value)}`;
};

const getTranslationCorrectionRows = computed(() => {
	const rows = [];
	const { translationCorrections } = formData.value;

	for (const key in translationCorrections) {
		if (translationCorrections[key].trim() !== '') {
			const englishItem = englishData.value.find((item) => {
				return item.code === key;
			});
			const otherLanguageItem = otherLanguageData.value.find((item) => {
				 return item.code === key;
			});

			if (englishItem && otherLanguageItem) {
				rows.push(`|${englishItem.result}|${otherLanguageItem.result}|${translationCorrections[key].trim()}|`);
			}
		}
	}

	return rows;
});

const getIssueContent = computed(() => {
	const { fixes, extraInformation } = formData.value;
	let content = '';
	if (hasTranslationCorrections.value && getTranslationCorrectionRows.value.length > 0) {
		content += `|English|${otherLanguageKey.value}|Comments|\n`;
		content += '|---|---|---|\n';
		content += `${getTranslationCorrectionRows.value.join('\n')}\n`;
	}

	if (fixes.trim() !== '') {
		content += `\n## Additional Fixes\n\n${fixes.trim()}\n`;
	}

	if (extraInformation.trim() !== '') {
		content += `\n## Extra Information\n\n${extraInformation.trim()}\n`;
	}

	return content;
});

const getGithubIssueUrl = computed(() => {
	const url = 'https://github.com/briannesbitt/Carbon/issues/new?';
	const paramters = [];
	const title = otherLanguageKey.value
		? `[Editing Translation] ${formData.value.newTranslationCode}`
		: `[New Translation] ${formData.value.newTranslationCode}`;

	paramters.push(
		uriParameter('title', title),
		uriParameter('body', getIssueContent.value)
	);
	const baseUrl = `${url}${paramters.join('&')}`;
	return baseUrl;
});

const onSubmitClick = () => {
	if (!canSubmit.value) {
		return;
	}

	window.open(getGithubIssueUrl.value, '_blank');
};
</script>
