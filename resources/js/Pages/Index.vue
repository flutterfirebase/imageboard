<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Index
            </h2>
        </template>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout"

export default {
    components: {
        AppLayout,
    },

    meta() {
        return {
            title: this.$page.props.appName,
            titleTemplate: null,
        };
    }
}
</script>
