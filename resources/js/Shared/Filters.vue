<script>
import Icon from './Icon.vue';
import { ref } from 'vue';

export default {
    components: {
        Icon
    },

    setup() {
        const showFilters = ref(false);
       
        return { showFilters }
    }
}
</script>
<template>
    <div class="py-3 px-3 bg-white shadow-sm rounded-md max-w-4xl">
        <div class="mb-2">
            <button class="w-full group flex justify-between items-center" @click="showFilters = !showFilters">
                <div>
                    <Icon name="filter" class="inline w-8 h-8 fill-indigo-400 group-hover:fill-softIndigo" />
                    <span class="capitalize text-sm font-bold text-indigo-400 group-hover:text-softIndigo">filtrar</span>
                </div>
                <Icon :name="showFilters ? 'up' : 'down'"
                    class="w-5 h-5 inline fill-indigo-400 group-hover:fill-softIndigo" />
            </button>
        </div>
        <transition name="slide">
            <div class="pt-2 overflow-hidden" v-if="showFilters">
                <slot />
            </div>
        </transition>
    </div>
</template>
<style scoped>
.slide-enter-from {
    max-height: 0px;
}

.slide-enter-to {
    max-height: 2000px;
}

.slide-enter-active,
.slide-leave-active {
    transition: all 450ms ease;
}

.slide-leave-from {
    max-height: 2000px;
}

.slide-leave-to {
    max-height: 0px;
}
</style>