<template>
    <div class="flex flex-col max-w-screen-md content-start my-5 bg-white border-gray-100 rounded-md shadow">
        <div class="grid grid-rows-4 grid-flow-col">
            <div class="col-span-3 row-span-1 gap-2 pl-2 flex flex-row">
                <div class="font-semibold">{{ post.name || "Anonymous" }}</div>
                <div>{{ post.created_at }}</div>
                <div>#{{ post.post_id }}</div>
            </div>

            <div class="col-span-1 row-span-3">
                <img class="max-h-32 m-0" src="/img/thread.jpg" />
            </div>

            <div class="col-span-2 row-span-3">
                {{ post.content }}
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['post'],
    };
</script>