<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                /{{ board.url }}/ - {{ thread.subject || board.name }}
            </h2>

            <h4 class="text-md text-gray-400 leading-tight" v-if="board.tagline">{{ board.tagline }}</h4>
        </template>

        <div>
            <!-- New Reply -->
            <post-creator :board="board" :parent="thread" />

            <!-- Replies -->
            <div class="mx-5">
                <post :post="thread" />
                <post v-for="reply in thread.replies" :key="reply.id" :post="reply" />
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout"
import PostCreator from "@/Components/PostCreator"
import Post from "@/Components/Post"

export default {
    props: ['board', 'thread'],

    components: {
        AppLayout,
        PostCreator,
        Post,
    },

    meta() {
        const threadTitle = this.thread.subject || this.thread.content.split(' ').slice(0, 5).join(' ');
        return {
            title: `/${this.board.url}/ - ${threadTitle} - ${this.board.name}`
        };
    },

    data() {
        return {
            showPostCreator: true,
        };
    }
}
</script>
