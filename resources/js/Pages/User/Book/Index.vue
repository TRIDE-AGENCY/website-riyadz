<template>
    <Head>
        <title>Buku − {{ setting.site_title }}</title>
    </Head>

    <LayoutUser :setting="setting" navBgClass="bg-white">
        
        <div class="container d-flex flex-column flex-center pt-md-10 mt-20 text-center">
            <span style="font-weight: 800 !important; letter-spacing: 6%;" 
                class="text-uppercase fs-3 fw-bolder text-myprimary mb-6">
                Pustaka Makna
            </span>
            <h1 style="font-weight: 800 !important;" 
                class="text-dark lh-sm fw-bolder fs-3x mb-3">
                Semua Koleksi Buku
            </h1>
            <p class="text-gray-600 lh-lg fs-3 mw-600px mx-auto mb-0">
                Jelajahi berbagai karya tulis yang dirangkum menjadi nutrisi utuh untuk tumbuh dan tangguh.
            </p>
        </div>

        <div class="container d-flex flex-column flex-center pt-20">
            <div class="d-flex flex-column align-items-center mw-1000px mx-auto w-100">
                
                <div v-if="!books || books.data.length === 0"
                    class="card flex-center w-100 mw-500px mw-lg-800px mx-auto text-center border border-gray-300 p-14 bg-light">
                    <img src="/assets/media/illustrations/empty.png" alt="Tidak ada data" class="mw-225px img-fluid mb-10">
                    <h2 class="text-dark mb-3 fw-bolder">Buku Belum Tersedia</h2>
                    <p class="text-gray-600 fs-4 mb-0">Belum ada buku yang dipublikasikan saat ini.</p>
                </div>

                <div v-else class="w-100 d-flex flex-column align-items-center">
                    
                    <a v-for="(book, index) in books.data" :key="book.id"
                        :href="`/books/${book.slug}`"
                        class="position-relative card border border-gray-300 p-10 pb-0 pb-lg-10 gap-10 w-100 mw-500px mw-lg-800px h-lg-300px mx-auto rounded-4 bg-light text-decoration-none"
                        :class="{'mt-6 mt-lg-14': index > 0}"
                    >
                        <template v-if="index % 2 === 0">
                            <div class="h-100 d-flex flex-column flex-center flex-lg-start me-lg-20 pe-lg-20">
                                <h3 class="flex-fill text-dark text-center me-lg-20 pe-lg-20 text-lg-start lh-sm fs-1 fs-lg-2x fw-bolder text-truncate-3 mb-6">
                                    {{ book.title }}
                                </h3>
                                <div class="me-lg-20 pe-lg-20 d-flex flex-column align-items-lg-start">
                                    <div class="fw-bolder d-flex align-items-center gap-2 mb-2 mb-lg-3">
                                        <i class="blog-icon ri-user-fill fw-semibold fs-2 text-myprimary"></i>
                                        <span class="fs-4 text-myprimary">{{ book.author }}</span>
                                    </div>
                                    <div class="fw-bolder d-flex align-items-center justify-content-center gap-2">
                                        <i class="blog-icon ri-article-fill fw-semibold fs-2 text-myprimary"></i>
                                        <span class="fs-4 text-myprimary">{{ book.total_pages }} Halaman • {{ getYear(book.launch_date) }}</span>
                                    </div>
                                </div>
                            </div>
                            <img
                                class="position-lg-absolute rounded-3 rounded-bottom-0 bottom-0 end-0 img-fluid object-fit-cover mw-300px w-lg-auto me-lg-10 h-lg-325px mx-auto w-100"
                                :src="`/storage/${book.image}`"
                                :alt="book.title"
                            />
                        </template>

                        <template v-else>
                            <img
                                class="order-1 position-lg-absolute rounded-3 rounded-bottom-0 bottom-0 start-0 img-fluid object-fit-cover mw-300px w-lg-auto ms-lg-10 h-lg-325px mx-auto w-100"
                                :src="`/storage/${book.image}`"
                                :alt="book.title"
                            />
                            <div class="h-100 d-flex flex-column flex-center flex-lg-start ms-lg-20 ps-lg-20">
                                <h3 class="flex-fill text-dark text-center ms-lg-20 ps-lg-20 text-lg-start lh-sm fs-1 fs-lg-2x fw-bolder text-truncate-3 mb-6">
                                    {{ book.title }}
                                </h3>
                                <div class="ms-lg-20 ps-lg-20 d-flex flex-column align-items-lg-start">
                                    <div class="fw-bolder d-flex align-items-center gap-2 mb-2 mb-lg-3">
                                        <i class="blog-icon ri-user-fill fw-semibold fs-2 text-myprimary"></i>
                                        <span class="fs-4 text-myprimary">{{ book.author }}</span>
                                    </div>
                                    <div class="fw-bolder d-flex align-items-center justify-content-center gap-2">
                                        <i class="blog-icon ri-article-fill fw-semibold fs-2 text-myprimary"></i>
                                        <span class="fs-4 text-myprimary">{{ book.total_pages }} Halaman • {{ getYear(book.launch_date) }}</span>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </a>
                    <Pagination v-if="books.data.length !== 0" 
                        :links="books.links" align="center" class="p-6" />
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
            books: Object,
        },

        setup() {
            const getYear = (dateString) => {
                return new Date(dateString).getFullYear();
            };

            return { getYear };
        }
    }
</script>

<style>
</style>