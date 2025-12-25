<template>
	<div
		class="border
			border-zinc-300
			cursor-pointer
			flex
			gap-2
			group
			overflow-hidden
			rounded
			dark:hover:bg-zinc-800
			hover:bg-zinc-100"
	>
		<div
			class="bg-zinc-200
				dark:bg-zinc-700
				font-semibold
				group-hover:bg-zinc-300
				dark:group-hover:bg-zinc-600
				p-2
				shrink-0
				truncate
				w-1/4"
			:title="`${item.id} - ${item.regionName ?? ''}`"
		>
			{{ item.id }}
		</div>
		<div
			:item="item"
			class="italic p-2 truncate"
			:title="getItemTitle(item)"
		>
			<span class="group-hover:hidden">
				{{ item.nativeName }}
			</span>
			<span class="group-hover:inline hidden">
				{{ getItemIsoRegionName(item) }}
			</span>
		</div>
	</div>
</template>

<script setup lang="ts">
import type { PropType } from 'vue';

type Item = {
	isoName: string;
	nativeName: string;
	id: string;
	code: string;
	region: string | null;
	regionName: string | null;
	variant: string | null;
};

defineProps({
	/**
	 * The array of translation items to display.
	 */
	item: {
		type: Object as PropType<Item>,
		required: true,
	},
});

const getItemIsoRegionName = (item: Item): string => {
	return item.regionName ? `${item.isoName} (${item.regionName})` : item.isoName;
};

const getItemTitle = (item: Item): string => {
	const text = [item.nativeName];
	if (item.regionName) {
		text.push(getItemIsoRegionName(item));
	}

	return text.join(' - ');
};

export type { Item };
</script>
