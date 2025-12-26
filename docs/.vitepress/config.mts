import { defineConfig } from 'vitepress';
import type { UserConfig } from 'vitepress';
import { withSidebar } from 'vitepress-sidebar';
import type { VitePressSidebarOptions } from 'vitepress-sidebar/types';
import { compileCode, addSandboxButton } from './plugins';
import { fileURLToPath } from 'node:url';
import tailwindcss from '@tailwindcss/vite';

const env = process?.env?.REPOSITORY;

// https://vitepress.dev/reference/site-config
const vitePressOptions: UserConfig = {
	title: 'Carbon',
	description: 'A simple PHP API extension for DateTime.',
	base: env === 'briannesbitt/Carbon' ? '/' : '/carbon/',
	head: [
		[
			'link', {
				rel: 'icon',
				href: '/favicon.ico',
			},
		],
		[
			'link', {
				rel: 'stylesheet',
				href: 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css',
			},
		],
	],
	themeConfig: {
		// https://vitepress.dev/reference/default-theme-config
		logo: '/logo.png',
		siteTitle: '',
		search: {
			provider: 'local',
		},
		nav: [
			{
				text: 'Guide',
				link: '/guide/getting-started/introduction',
			},
			{
				text: 'Reference',
				link: '/develop/reference',
			},
			{
				text: 'Translations',
				link: '/develop/translations/available-translations',
			},
			{
				text: 'Changelog',
				link: '/develop/changelog',
			},
		],
		socialLinks: [
			{
				icon: 'github',
				link: 'https://github.com/CarbonPHP/carbon',
			},
		],
		outline: {
			level: [2, 4],
		},
	},
	markdown: {
		preConfig(md) {
			md.use(addSandboxButton);
		},
		config(md) {
			md.use(compileCode);
		},
	},
	 vite: {
		resolve: {
			alias: {
				'@': fileURLToPath(new URL('../', import.meta.url)),
			},
		},
		plugins: [tailwindcss()],
	},
};

const vitePressSidebarOptions: VitePressSidebarOptions = {
	documentRootPath: '/docs',
	collapsed: false,
	capitalizeEachWords: true,
	useFolderLinkFromSameNameSubFile: true,
	useTitleFromFileHeading: true,
	useTitleFromFrontmatter: true,
	hyphenToSpace: true,
	underscoreToSpace: true,
	sortMenusByFrontmatterOrder: true,
};

const sidebars: VitePressSidebarOptions[] = [
	{
		...vitePressSidebarOptions,
		scanStartPath: 'guide',
		basePath: '/guide/',
		resolvePath: '/guide',
		manualSortFileNameByPriority: ['getting-started', 'core-api', 'date-time-manipulation', 'advanced-features'],
	},
	{
		...vitePressSidebarOptions,
		scanStartPath: 'develop',
		basePath: '/develop/',
		resolvePath: '/develop',
		manualSortFileNameByPriority: ['contribution', 'translations', 'reference.md', 'changelog.md'],
	},
];

export default defineConfig(withSidebar(vitePressOptions, sidebars));
