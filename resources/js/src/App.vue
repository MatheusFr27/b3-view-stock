<template>
    <div class="bg-slate-900">
        <div>
            <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex items-baseline justify-between border-b border-gray-200 pb-6 pt-24">
                    <h1 class="text-4xl font-bold tracking-tight text-white">
                        Posições em Aberto de Empréstimo de Ativos
                    </h1>
                </div>

                <section aria-labelledby="products-heading" class="pb-24 pt-6">
                    <h2 id="products-heading" class="sr-only">Products</h2>

                    <div class="grid grid-cols-12">
                        <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-3">
                            <div class="mb-6">
                                <DropdownComponent />
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-12">
                        <div class="col-span-12">
                            <GraphComponent />
                        </div>
                    </div>
                </section>
            </main>
        </div>
    </div>
</template>

<script>
import GraphComponent from './components/GraphComponent.vue'
import DropdownComponent from './components/DropdownComponent.vue'

export default {
    name: 'App',
    components: { GraphComponent, DropdownComponent },
    setup() {

        return {
        }
    }
}
</script>

<style></style>
