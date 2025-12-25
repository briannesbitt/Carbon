<template>
	<div class="flex justify-center items-center w-full">
		<div
			class="aspect-square bg-(--vp-c-brand-1) loader rounded-full"
			:class="getSizeClasses"
		/>
	</div>
</template>

<script lang="ts" setup>
import { computed, type PropType } from 'vue';

const { size } = defineProps({
	/**
	 * Size of the spinner
	 */
	size: {
		type: String as PropType<'small' | 'medium' | 'large'>,
		default: 'medium',
	},
});

const getSizeClasses = computed(() => {
	switch (size) {
		case 'small': {
			return 'size-6 p-1';
		}
		case 'large': {
			return 'size-18 p-2.5';
		}
		default: {
			return 'size-12 p-2';
		}
	}
});
</script>

<style scoped>
.loader {
  mask: conic-gradient(#0000 10%,#000),   linear-gradient(#000 0 0) content-box;
  mask-composite: subtract;
  animation: rotate 1s infinite linear;
}

@keyframes rotate {
	to {
		transform: rotate(1turn)
	}
}
</style>