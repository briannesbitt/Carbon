// https://vitepress.dev/guide/custom-theme
import { h } from 'vue';
import type { Theme } from 'vitepress';
import DefaultTheme from 'vitepress/theme';
import './style.css';
import Sponsors from './components/Sponsors.vue';
import AllAvailableTranslations from './components/AllAvailableTranslations.vue';
import UpsertLanguage from './components/UpsertLanguage.vue';
export default {
	extends: DefaultTheme,
	Layout: () => {
		return h(DefaultTheme.Layout, null, {
			// https://vitepress.dev/guide/extending-default-theme#layout-slots
			'layout-bottom': '<div data-ea-publisher="carbon" data-ea-type="text"></div>',
		});
	},
	enhanceApp({ app, router, siteData }) {
		app.component('Sponsors', Sponsors);
		app.component('AllAvailableTranslations', AllAvailableTranslations);
		app.component('UpsertLanguage', UpsertLanguage);
	},
} satisfies Theme;
