<template>
	<div
		class="bg-zinc-100
			dark:bg-zinc-600
			flex
			flex-wrap
			gap-4
			mt-4
			p-4
			sponsors"
	>
		<div v-for="sponsor in sortedData" :key="sponsor.name" :class="getClasses(status)">
			<span
				v-if="sponsor.star"
				class="-translate-y-1/2
					absolute
					top-0
					right-0
					text-2xl
					text-shadow-lg
					text-yellow-500
					translate-x-1/2"
			>
				★
			</span>
			<a
				:href="getLink(sponsor)"
				target="_blank"
				rel="noopener"
				class="flex justify-center items-center size-full"
				:class="status !== 'sponsor' && 'rounded-full overflow-hidden'"
			>
				<img
					:src="getImage(sponsor)"
					width="100"
					class="h-full object-contain"
				>
			</a>
		</div>
	</div>
</template>

<script lang="ts" setup>
import data from '@/public/data/backers.json';
import type { PropType } from 'vue';
import { onMounted, ref } from 'vue';
const { status } = defineProps({
	/**
	 * Status to filter sponsors by
	 */
	status: {
		type: String as PropType<'sponsor' | 'backer' | 'backerPlus'>,
		required: true,
	},
});

const sortedData = ref();
onMounted(() => {
	sortedData.value = data
		.filter((sponsor: any) => sponsor.status === status)

		// sort by star, rank, monthlyContribution then totalAmountDonated
		.sort((a: any, b: any) => (b.star - a.star)
        || (b.rank - a.rank)
        || (b.monthlyContribution - a.monthlyContribution)
        || (b.totalAmountDonated - a.totalAmountDonated));
});

const getLink = (sponsor: any) => {
  let href = sponsor.website || sponsor.profile;

  if ([
    'onlinekasyno-polis.pl',
    'zonaminecraft.net',
    'slotozilla.com',
  ].indexOf((new URL(href)).host.replace(/^www\./, '')) === -1) {
    href += (href.indexOf('?') === -1 ? '?' : '&amp;') + 'utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon';
  }

  return href;
}

const getImage = (sponsor: any) => {
	return sponsor.image || `${sponsor.profile.replace(
		'https://opencollective.com/',
		'https://images.opencollective.com/'
	)}/avatar/256.png`;
};

const getClasses = (status: string) => {
	const classes: string[] = ['relative'];
	if (status === 'sponsor') {
		classes.push('size-16', 'border-2', 'border-(--vp-c-divider)', 'rounded');
		return classes;
	}

	if (status === 'backerPlus') {
		classes.push('size-12');
		return classes;
	}

	classes.push('size-8');

	return classes;
};
</script>
