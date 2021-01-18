<template>
    <div class="max-w-md mx-auto py-5 my-5 sm:px-6 lg:px-8 bg-white border-b border-gray-100 rounded-md shadow">
        <form @submit.prevent="submit">
            <div class="grid gap-0" :class="{ 'grid-cols-2': creatingThread, 'grid-cols-1': ! creatingThread }">
                <div>
                    <ib-input type="text" placeholder="name.." v-model="form.name" />
                    <ib-input-error :message="$page.props.errors.name" />
                </div>

                <div v-if="! parent">
                    <ib-input type="text" placeholder="subject.." v-model="form.subject" />
                    <ib-input-error :message="$page.props.errors.subject" />
                </div>
            </div>

            <div class="grid grid-cols-1 mt-2">
                <ib-textarea rows="3" placeholder="content.." v-model="form.content" />
                <ib-input-error :message="$page.props.errors.content" />
            </div>

            <div class="grid grid-cols-1 mt-2 inline-block">
                <ib-button class="text-center">Submit</ib-button>
            </div>
        </form>
    </div>
</template>

<script>
    import IbInput from "@/Components/Input"
    import IbInputError from "@/Components/InputError"
    import IbTextarea from "@/Components/Textarea"
    import IbButton from "@/Components/Button"

    export default {
        props: ['board', 'parent'],

        components: {
            IbInput,
            IbInputError,
            IbTextarea,
            IbButton,
        },

        data() {
            return {
                form: this.$inertia.form({
                    name: null,
                    subject: null,
                    content: null,
                    board_id: this.board.id,
                }),
            }
        },

        computed: {
            creatingThread() {
                return ! this.parent;
            },
        },

        methods: {
            submit() {
                const endpoint = this.creatingThread
                    ? route('new-thread', { board: this.board.url })
                    : route('new-reply', { board: this.board.url, thread: this.parent.post_id });

                if (this.creatingThread) {
                    this.$inertia.post(endpoint, this.form);
                } else {
                    axios.post(endpoint, this.form)
                        .then(response => {
                            console.log(response.data);
                            this.parent.replies.push(response.data);
                        });
                }
            },
        }
    }
</script>