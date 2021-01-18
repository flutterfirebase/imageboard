<template>
    <div>
        <banner />

        <div class="min-h-screen bg-gray-100">
            <nav class="bg-white border-b border-gray-100">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="flex-shrink-0 flex items-center">
                                <inertia-link :href="route('index')">
                                    <application-mark class="block h-9 w-auto" />
                                </inertia-link>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-4 sm:-my-px sm:ml-10 sm:flex">
                                <nav-link v-for="board in $page.props.boards" :key="board.id" :href="route('board', { board: board.url })" :active="route().current('board', { board: board.url })">
                                    /{{ board.url }}/
                                </nav-link>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header"></slot>
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot></slot>
            </main>

            <!-- Modal Portal -->
            <portal-target name="modal" multiple>
            </portal-target>
        </div>
    </div>
</template>

<script>
    import ApplicationMark from '@/Components/Layout/ApplicationMark'
    import Banner from '@/Components/Layout/Banner'
    import NavLink from '@/Components/Layout/NavLink'
    import ResponsiveNavLink from '@/Components/Layout/ResponsiveNavLink'

    export default {
        components: {
            ApplicationMark,
            Banner,
            NavLink,
            ResponsiveNavLink,
        },

        data() {
            return {}
        },
    }
</script>