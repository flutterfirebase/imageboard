<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                /{{ board.url }}/ - {{ board.name }}
            </h2>

            <h4 class="text-md text-gray-400 leading-tight" v-if="board.tagline">{{ board.tagline }}</h4>
        </template>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout"

export default {
    props: ['board'],

    components: {
        AppLayout,
    }
}
</script>