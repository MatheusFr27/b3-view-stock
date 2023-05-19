<template>
    <div v-if="historyActions.length < 1" class="bg-orange-600 rounded px-6 py-4 flex flex-row items-center">
        <svg xmlns="http://www.w3.org/2000/svg" height="40px" fill="white" class="mr-3" viewBox="0 0 24 24">
            <title>information-slab-circle-outline</title>
            <path
                d="M11 7V9H13V7H11M14 17V15H13V11H10V13H11V15H10V17H14M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12M20 12C20 7.58 16.42 4 12 4C7.58 4 4 7.58 4 12C4 16.42 7.58 20 12 20C16.42 20 20 16.42 20 12Z" />
        </svg>
        <h3 class="text-white text-1xl">Selecione um Ativo para ver seus detalhes.</h3>
    </div>
</template>

<script>
import { computed } from 'vue';
import { store } from '../store'

export default {
    name: 'WarningComponent',
    setup() {
        const historyActions = computed(() => store.getters['historyActions/getHistoryActions']);

        return {
            historyActions
        }

    }
}
</script>

<style></style>
