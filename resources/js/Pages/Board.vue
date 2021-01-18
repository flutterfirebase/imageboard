<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                /{{ board.url }}/ - {{ board.name }}
            </h2>

            <h4 class="text-md text-gray-400 leading-tight" v-if="board.tagline">{{ board.tagline }}</h4>
        </template>

        <div>
            <!-- New Thread -->
            <post-creator :board="board" />

            <!-- Thread listing -->
            <div class="grid grid-cols-8 gap-6">
                <div class="mx-auto my-5 bg-white border-b border-gray-100 rounded-md shadow flex flex-col items-center" v-for="thread in board.threads" :key="thread.id">
                    <inertia-link :href="route('thread', { board: board.url, thread: thread.post_id })">
                        <img class="h-32 rounded-t-md" src="/img/thread.jpg" />
                    </inertia-link>
                    <h5 class="text-center font-bold" v-if="thread.subject">{{ thread.subject }}</h5>
                    <p class="text-center max-w-xs max-h-44 overflow-ellipsis overflow-hidden" v-if="thread.content">{{ thread.content }}</p>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout"
import PostCreator from "@/Components/PostCreator"

export default {
    props: ['board'],

    components: {
        AppLayout,
        PostCreator,
    },
}
</script>