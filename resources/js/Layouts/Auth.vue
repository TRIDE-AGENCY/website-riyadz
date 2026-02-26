<template>
    <div class="d-flex flex-column flex-root min-vh-100" id="kt_app_root">
        <div class="d-flex flex-column flex-center py-10">
            <a href="/">
                <img alt="Logo" 
                    :src="`/storage/${setting.site_logo}`" 
                    class="h-60px" />
            </a>
        </div>
        <div class="d-flex flex-column flex-column-fluid flex-center p-10">
            <slot />
        </div>
        <div class="d-flex flex-center flex-column-auto py-10">
            <p class="text-gray-500 fs-5 mb-0">2026 © {{ setting.site_title }}</p>
        </div>
    </div>
</template>

<script>
    import { onMounted, onUpdated } from "vue";
    import { router, Link } from "@inertiajs/vue3";

    export default {
        components: {
            Link
        },
        
        props: {
            setting: Object
        },
        
        setup() {
            onMounted(() => {
                window.KTMenu?.init(); 
            });

            onUpdated(() => {
                window.KTMenu?.init();
            });

            router.on('navigate', () => {
                window.KTMenu?.init();
            });
        }
    }
</script>

<style>

</style>
