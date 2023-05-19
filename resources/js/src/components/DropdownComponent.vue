<template>
    <div @mouseleave="open = false" class="relative">
        <div class="flex flex-col items-center">
            <div class="w-full">
                <h4 class="text-white font-light text-sm">Selecione um ativo para ver detalhes.</h4>
                <div class="my-1 p-1 bg-white flex border border-gray-200 rounded">
                    <input v-model="searchAction" placeholder="Buscar ação" @click="open = true" :disabled="loading"
                        class="p-1 px-2 appearance-none outline-none w-full text-gray-800">
                    <div class="text-gray-300 w-8 py-1 pl-2 pr-1 border-l flex items-center border-gray-200">
                        <button v-if="searchAction == ''" @click="open = !open" :disabled="loading"
                            class="cursor-pointer w-6 h-6 text-gray-600 outline-none focus:outline-none">
                            <svg v-if="loading" class="rotate-loading" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24">
                                <title>loading</title>
                                <path d="M12,4V2A10,10 0 0,0 2,12H4A8,8 0 0,1 12,4Z" />
                            </svg>
                            <svg v-else :class="open ? 'rotate-0' : 'rotate-180'" xmlns="http://www.w3.org/2000/svg"
                                width="100%" height="100%" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-chevron-up w-4 h-4">
                                <polyline points="18 15 12 9 6 15"></polyline>
                            </svg>
                        </button>
                        <button v-else @click="searchAction = ''"
                            class="cursor-pointer w-6 h-6 text-gray-600 outline-none focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%"
                                class="feather feather-chevron-up w-4 h-4" viewBox="0 0 24 24">
                                <path
                                    d="M19,6.41L17.59,5L12,10.59L6.41,5L5,6.41L10.59,12L5,17.59L6.41,19L12,13.41L17.59,19L19,17.59L13.41,12L19,6.41Z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div v-show="open"
            class="absolute shadow bg-white top-15 z-40 w-full lef-0 rounded max-h-select overflow-y-auto max-h-56">
            <div class="flex flex-col w-full">
                <button v-for="(action, i) in returnResultActions" :key="i" @click="selectAction(action)"
                    class="cursor-pointer w-full border-gray-100 rounded-t border-b hover:bg-teal-100">
                    <div
                        class="flex w-full items-center p-2 pl-2 border-transparent border-l-2 relative hover:border-teal-100">
                        <div class="w-full items-center flex">
                            <div class="mx-2">
                                {{ action.name }}
                            </div>
                        </div>
                    </div>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, computed, onMounted } from 'vue'
import { store } from '../store'

export default {
    name: 'DropdownComponent',
    setup() {
        // Variables
        const open = ref(false);
        const searchAction = ref("");
        const loading = ref(true)

        // Mutations
        const actions = computed(() => store.getters['actions/getActions']);
        let returnResultActions = computed(() => {
            if (searchAction.value == '') return actions.value;

            open.value = true;

            const searchActionUpper = searchAction.value.toUpperCase();
            const results = [];

            actions.value.forEach((el) => {
                if (el.name.includes(searchActionUpper)) results.push(el)
            });

            return results;
        })

        // Functions
        function selectAction(action = Object) {
            searchAction.value = action.name
            open.value = false

            loading.value = true

            store.dispatch('historyActions/findByActionId', action.id).catch(() => {
                alert('Houve um erro ao buscar pelos dadso da ação.');
            }).finally(() => {
                loading.value = false;
            })
        }

        //Lifecycle
        onMounted(() => {
            store.dispatch('actions/initialize').catch(() => alert('Houve erro ao buscar pelas ações.')).finally(() => {
                loading.value = false
            })
        });

        return {
            // Variables
            open,
            searchAction,
            loading,

            // Mutations
            actions,
            returnResultActions,

            // Functions
            selectAction
        }
    }
}
</script>

<style scoped>
.rotate-loading {
    animation: rotation 0.5s infinite linear;
}

@keyframes rotation {
    from {
        transform: rotate(0deg);
    }

    to {
        transform: rotate(359deg);
    }
}
</style>
