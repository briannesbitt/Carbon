<template>
	<p>
		We found {{ getTranslationsForUserRegion.length }} translations
		for your region based on your browser language ({{ browserLanguage }})
	</p>
	<div class="grid sm:grid-cols-2 xl:grid-cols-3 gap-4 mt-4 translations">
		<TranslationItemData
			v-for="item in getTranslationsForUserRegion"
			:key="item.id"
			:item="item"
			@click="onItemClick(item)"
		/>
	</div>
	<h3 class="mt-8">
		Other available translations
	</h3>
	<div class="grid sm:grid-cols-2 xl:grid-cols-3 gap-4 mt-4 translations">
		<TranslationItemData
			v-for="item in getRestOfTranslations"
			:key="item.id"
			:item="item"
			@click="onItemClick(item)"
		/>
	</div>
</template>

<script setup lang="ts">
import data from '@/public/data/languages.json';
import TranslationItemData from './TranslationItemData.vue';
import type { Item } from './TranslationItemData.vue';
import { computed, onMounted, ref } from 'vue';
import { useRouter, withBase } from 'vitepress';

const router = useRouter();
const typedData: Item[] = data;
const browserLanguage = ref('');
const userRegion = ref('');

onMounted(() => {
	const language = (navigator.language || navigator.userLanguage).split(/[_-]/u);
	browserLanguage.value = language[0].toLowerCase();
	userRegion.value = (language[1] || 'unknown').toUpperCase();
});

const getTranslationsForUserRegion = computed(() => {
	return typedData.filter(
		(item) => {
			return item.code === browserLanguage.value;
		}
	);
});

const getRestOfTranslations = computed(() => {
	return typedData.filter(
		(item) => {
			return item.code !== browserLanguage.value;
		}
	);
});

const onItemClick = (item: Item) => {
	router.go(withBase(`/develop/translations/create/?lang=${item.id}`), {
		initialLoad: false,
	});
};
</script>