<template>
    <Head>
        <title>Blog − {{ setting.site_title }}</title>
    </Head>

    <LayoutUser :setting="setting" 
        navBgClass="bg-white">
        
        <div class="container d-flex flex-column flex-center pt-md-10 mt-20 text-center">
            <span style="font-weight: 800 !important; letter-spacing: 6%;" 
                class="text-uppercase fs-3 fw-bolder text-myprimary mb-6">
                Jejak Manfaat
            </span>
            <h1 style="font-weight: 800 !important;"
                class="text-dark lh-sm fw-bolder fs-3x mb-3">
                Semua Artikel Blog
            </h1>
            <p class="text-gray-600 lh-lg fs-3 mw-600px mx-auto mb-0">
                Temukan berbagai tulisan inspiratif, opini, dan cerita yang dibagikan untuk memberikan manfaat bagi akal dan jiwa.
            </p>
        </div>

        <div class="container d-flex flex-column flex-center pt-20">
            <div class="d-flex flex-column align-items-center mw-800px mx-auto w-100">
                
                <div v-if="!blogs || blogs.data.length === 0"
                    class="card flex-center w-100 mw-500px mw-lg-800px mx-auto text-center border border-gray-300 p-14 bg-light">
                    <img src="/assets/media/illustrations/empty.png"
                        alt="Tidak ada data" class="mw-225px img-fluid mb-10">
                    <h2 class="text-dark mb-3 fw-bolder">Blog Belum Tersedia</h2>
                    <p class="text-gray-600 fs-4 mb-0">Belum ada artikel blog yang dipublikasikan saat ini.</p>
                </div>

                <div v-else class="row g-6 justify-content-center w-100">
                    <a v-for="blog in blogs.data" :key="blog.id"
                        :href="`/blogs/${blog.slug}`" class="col-12 col-sm-6 text-decoration-none">
                        <div id="blog-card" 
                            class="card border border-gray-300 h-100 p-4 d-flex flex-column rounded-4 gap-4 justify-content-between align-items-start bg-light">
                            <div class="overflow-hidden position-relative rounded-3 ratio ratio-4x3">
                                <img
                                    class="img-blog img-fluid object-fit-cover"
                                    :src="`/storage/${blog.image}`"
                                    :alt="blog.title"
                                />
                            </div>
                            <div class="flex-fill p-4">
                                <h3
                                    class="text-dark lh-sm fs-2 fw-bolder text-truncate-2 mb-3"
                                >
                                    {{ blog.title }}    
                                </h3>
                                <p class="text-gray-600 fs-6 mb-0">
                                    {{ formatDate(blog.created_at) }}
                                </p>
                            </div>
                            <div class="p-4 fw-bolder d-flex align-items-center gap-2">
                                <span class="fs-4 text-myprimary">Baca Selengkapnya</span>
                                <i class="blog-icon ri-arrow-right-up-line fw-semibold fs-2 text-myprimary"></i>
                            </div>
                        </div>
                    </a>
                    <Pagination v-if="blogs.data.length !== 0"
                        :links="blogs.links" align="center" class="p-6" />
                </div>
            </div>
        </div>
    </LayoutUser>
</template>

<script>
    import { Head, Link } from '@inertiajs/vue3';
    import LayoutUser from '../../../Layouts/User.vue';
    import Pagination from '../../../Components/Pagination.vue';
    
    export default {
        components: {
            Head,
            Link,
            LayoutUser,
            Pagination
        },

        props: {
            setting: Object,
            blogs: Object,
        },

        setup(props) {
            const formatDate = (dateString) => {
                const date = new Date(dateString);
                return date.toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' });
            };

            const isRecent = (dateString) => {
                const date = new Date(dateString);
                const oneWeekAgo = new Date();
                oneWeekAgo.setDate(oneWeekAgo.getDate() - 7); 
                return date >= oneWeekAgo;
            };

            return { 
                formatDate, 
                isRecent,
            };
        }
    }
</script>

<style>
</style>