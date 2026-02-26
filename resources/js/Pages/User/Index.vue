<template>
    <Head>
        <title>{{ setting.site_title }}</title>
    </Head>

    <LayoutUser :setting="setting"
        navBgClass="bg-myprimary-light">
        
        <!-- HERO -->
        <div id="heros" aria-labelledby="hero-title"
            class="bg-myprimary-light">
            <div class="container pt-10 mt-20">
                <div class="row g-10 align-items-start mw-1000px mx-auto">
                    <div class="col-12 col-md-6">
                        <div
                            class="d-flex flex-column text-center text-md-start align-items-center align-items-md-start justify-content-center justify-content-md-start"
                        >
                            <h2
                                style="font-weight: 800 !important;"
                                class="text-dark mt-md-20 lh-sm fs-3x fw-bolder mb-1"
                            >
                                Halo 👋 Saya
                            </h2>
                            <h2
                                id="hero-title"
                                style="font-weight: 800 !important;"
                                class="text-myprimary lh-sm fs-4qx fw-bolder mb-6 mb-md-5 mb-lg-6"
                            >
                                {{ setting.site_title }}
                            </h2>
                            <p class="text-gray-600 lh-lg fs-3 mb-0 mw-500px mw-md-425px">
                                Seorang <span class="fw-bolder text-dark">Apoteker</span> 💊 yang percaya bahwa ilmu & profesi adalah amal jariah, seorang <span class="fw-bolder text-dark">Penulis</span> ✍️ yang menjadikan kata sebagai jalan ibadah dan inspirasi, serta seorang <span class="fw-bolder text-dark">Pengusaha</span> 🤝 yang meyakini bahwa kebermanfaatan adalah inti dari setiap usaha.
                            </p>
                        </div>
                    </div>
                    <div
                        class="col-12 col-md-6 d-flex justify-content-center justify-content-md-end"
                    >
                        <div class="position-relative w-80 mw-350px">
                            <img
                                src="/assets/media/illustrations/img-hero.png"
                                alt="Logogram Aksara.id"
                                class="w-100" 
                            />
                            <div class="position-absolute pb-20 top-50 start-0 translate-middle z-index-1">
                                <span class="p-4 p-md-6 bg-white border border-gray-300 rounded-pill d-inline-block floating-icon">
                                    <i class="ri-blogger-fill fs-5x fs-md-4x text-myprimary"></i>
                                </span>
                            </div>
                            <div class="position-absolute pt-20 top-50 start-100 translate-middle z-index-1">
                                <span class="p-4 p-md-5 bg-white border border-gray-300 rounded-pill d-inline-block floating-icon-delayed">
                                    <i class="ri-book-open-fill fs-3x fs-md-2x text-myprimary"></i>
                                </span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- BLOGS -->
        <div id="blogs"
            class="container d-flex flex-column flex-center pt-20 mt-20">
            <div class="d-flex flex-column align-items-center mw-800px mx-auto w-100">
                <span style="font-weight: 800 !important; letter-spacing: 6%;" 
                    class="text-uppercase fs-3 fw-bolder text-myprimary mb-6">
                    Jejak Manfaat
                </span>
                <h2 style="font-weight: 800 !important;"
                    class="text-center text-dark lh-sm fw-bolder fs-3x mb-12 mb-md-14">
                    Dosis Harian <br> Untuk Akal 🧠 & Jiwa ❤️
                </h2>
                <div v-if="!latestBlogs || latestBlogs.length === 0"
                    class="card flex-center w-100 mw-500px mw-lg-800px mx-auto text-center border border-gray-300 p-14 bg-light">
                    <img src="/assets/media/illustrations/empty.png"
                        alt="Tidak ada data" class="mw-225px img-fluid mb-10">
                    <h2 class="text-dark mb-3 fw-bolder">Blog Belum Tersedia</h2>
                    <p class="text-gray-600 fs-4 mb-0">Belum ada artikel blog yang dipublikasikan saat ini.</p>
                </div>
                <div v-else class="justify-content-center w-100">
                    <div class="swiper mySwiper mb-6 w-100 rounded-4 overflow-hidden" v-if="latestBlogs && latestBlogs.length > 0">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide" v-for="blog in latestBlogs" :key="blog.id">
                                <a :id="`blog-card-${blog.id}`" :href="`/blogs/${blog.slug}`" class="d-block w-100 card border border-gray-300 rounded-4 overflow-hidden position-relative ratio ratio-4x3">
                                    <img class="img-blog position-absolute w-100 h-100 object-fit-cover top-0 start-0"
                                        :src="`/storage/${blog.image}`"
                                        :alt="blog.title"
                                    />
                                    <div class="position-absolute w-100 h-100 top-0 start-0" style="background: linear-gradient(to top, rgba(0,0,0,0.85) 0%, transparent 60%); pointer-events: none;">
                                    </div>

                                    <div class="position-absolute bottom-0 w-100 p-8 pb-12 d-flex flex-column justify-content-end" style="z-index: 1;">
                                        <h3 class="text-white lh-sm fs-1 fs-md-2x fw-bolder text-truncate-2 mb-4 mb-md-5">
                                            {{ blog.title }}
                                        </h3>
                                        <div class="d-flex gap-4 align-items-center">
                                            <span v-if="isRecent(blog.created_at)" class="bg-myprimary px-5 py-2 rounded-pill fw-bolder fs-5 text-white">
                                                Terbaru
                                            </span>
                                            <p class="text-white opacity-75 fs-5 fs-md-5 mb-0">
                                                {{ formatDate(blog.created_at) }}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="swiper-pagination mb-2"></div>
                    </div>
                    
                    <!-- <a v-if="latestBlog" :href="`/blogs/${latestBlog.slug}`"
                        class="col-12 text-decoration-none">
                        <div id="blog-card"
                            class="card ribbon ribbon-start ribbon-clip border border-gray-300 h-100 p-4 rounded-4 bg-light">
                            <div v-if="isRecent(latestBlog.created_at)"
                                class="ribbon-label fs-5 px-4 py-2 fw-bolder mt-sm-3 mt-md-2">
                                Terbaru
                                <span class="ribbon-inner bg-myprimary"></span>
                            </div>
                            <div class="row g-4 h-100">
                                <div class="col-12 col-sm-6">
                                    <div class="overflow-hidden position-relative rounded-3 ratio ratio-4x3 h-100">
                                        <img
                                            class="img-blog img-fluid object-fit-cover"
                                            :src="`/storage/${latestBlog.image}`"
                                            :alt="latestBlog.title"
                                        />
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 d-flex flex-column justify-content-between">
                                    <div class="flex-fill p-4">
                                        <h3 class="text-dark lh-sm fs-2 fs-md-1 fs-lg-2x fw-bolder text-truncate-3 mb-3 mb-md-4">
                                            {{ latestBlog.title }}
                                        </h3>
                                        <p class="text-gray-600 fs-6 fs-md-5 mb-0">
                                            {{ formatDate(latestBlog.created_at) }}
                                        </p>
                                    </div>
                                    <div class="p-4 fw-bolder d-flex align-items-center gap-2">
                                        <span class="fs-4 text-myprimary">Baca Selengkapnya</span>
                                        <i class="blog-icon ri-arrow-right-up-line fw-semibold fs-2 text-myprimary"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a> -->
                    <div class="d-flex flex-column gap-6 flex-sm-row mw-800px mx-auto w-100">
                        <div class="w-100 d-flex flex-column gap-6 flex-fill">
                            <a v-for="blog in recentBlogs" :key="blog.id"
                                :href="`/blogs/${blog.slug}`" class="card border border-gray-300 p-4 rounded-4 bg-light">
                                <div id="blog-card">
                                    <div class="row g-4 h-100">
                                        <div class="col-12 col-sm-6 col-md-5">
                                            <div class="overflow-hidden position-relative rounded-3 ratio ratio-4x3 h-100">
                                                <img
                                                    class="img-blog img-fluid object-fit-cover"
                                                    :src="`/storage/${blog.image}`"
                                                    :alt="blog.title"
                                                />
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-7 d-flex flex-column justify-content-between">
                                            <div class="flex-fill p-4">
                                                <h3 class="text-dark lh-sm fs-2 fs-md-1 fs-lg-2x fw-bolder text-truncate-2 mb-3 mb-md-4">
                                                    {{ blog.title }}
                                                </h3>
                                                <p class="text-gray-600 fs-6 fs-md-5 mb-0">
                                                    {{ formatDate(blog.created_at) }}
                                                </p>
                                            </div>
                                            <div class="p-4 fw-bolder d-flex align-items-center gap-2">
                                                <span class="fs-4 text-myprimary text-truncate">Baca Selengkapnya</span>
                                                <i class="blog-icon ri-arrow-right-up-line fw-semibold fs-2 text-myprimary"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <img v-if="recentBlogs && recentBlogs.length > 2"
                            src="/assets/media/illustrations/img-book.jpeg" alt="Iklan" style="top: 90px;"
                            class="position-sticky d-none d-sm-flex w-120px h-600px rounded-4 img-fluid object-fit-cover">
                    </div>
                    <!-- <a v-for="blog in recentBlogs" :key="blog.id"
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
                    </a> -->
                </div>
                <a href="/blogs" v-if="latestBlogs && latestBlogs.length > 0"
                    class="btn mt-10 ps-6 pe-7 btn-sm btn-myprimary-tinted rounded-pill fs-4 me-2 me-lg-0 gap-1 align-items-center"
                >
                    <i class="fs-3 ri-blogger-fill"></i>
                    <span class="fw-bolder text-nowrap"
                        >Lihat Semua Blog</span
                    >
                </a>
            </div>
        </div>

        <!-- QUOTE -->
        <div
            id="quote"
            class="pt-20 mt-20"
        >
            <div class="bg-myprimary py-5">
                <div class="container py-20 px-6 px-lg-0 text-center mw-800px mx-auto">
                    <img src="/assets/media/elements/question-mark.png" alt="Question mark"
                        class="w-40px mb-10">
                    <h2 style="font-weight: 800 !important;"
                        class="text-center text-white lh-sm fw-bolder fs-3x mb-6">
                        Membangun Generasi Muda <br class="d-none d-md-block"> yang Cerdas, Berkarya, dan Berdaya
                    </h2>
                    <p class="text-white lh-lg fs-3 mb-0 opacity-75 mw-700px mx-auto">
                        Dari laboratorium hingga lembaran buku, dari seminar literasi hingga strategi bisnis, saya terus bergerak untuk satu tujuan. Inilah tempat di mana mimpi, karya, dan aksi nyata bertemu. Mari bertumbuh bersama! 🚀
                    </p>
                </div>
            </div>
        </div>

        <!-- BOOKS -->
        <div id="books"
            class="container d-flex flex-column flex-center pt-20 mt-20">
            <div class="d-flex flex-column align-items-center mw-800px mx-auto w-100">
                <span style="font-weight: 800 !important; letter-spacing: 6%;" 
                    class="text-uppercase fs-3 fw-bolder text-myprimary mb-6">
                    Pustaka Makna
                </span>
                <h2 style="font-weight: 800 !important;"
                    class="text-center text-dark lh-sm fw-bolder fs-3x mb-14 mb-md-16">
                    Nutrisi Utuh Untuk <br> Tumbuh 📚 & Tangguh 💪
                </h2>
                <div v-if="books == 0"
                    class="card flex-center w-100 mw-500px mw-lg-800px mx-auto text-center mt-n2 border border-gray-300 p-14 bg-light">
                    <img src="/assets/media/illustrations/empty.png"
                        alt="Tidak ada data" class="mw-225px img-fluid mb-10">
                    <h2 class="text-dark mb-3 fw-bolder">Buku Belum Tersedia</h2>
                    <p class="text-gray-600 fs-4 mb-0">Belum ada buku yang dipublikasikan saat ini.</p>
                </div>
                <a id="book-card" v-if="books[0]"
                    :href="`/books/${books[0].slug}`"
                    class="position-relative card border border-gray-300 p-10 pb-0 pb-lg-10 gap-10 w-100 mw-500px mw-lg-800px h-lg-300px mx-auto rounded-4 bg-light">
                    <div class="h-100 d-flex flex-column flex-center flex-lg-start me-lg-20 pe-lg-20 ">
                        <h3 class="flex-fill text-dark text-center me-lg-20 pe-lg-20 text-lg-start lh-sm fs-1 fs-lg-2x fw-bolder text-truncate-3 mb-6">
                            {{ books[0].title }}
                        </h3>
                        <div class="me-lg-20 pe-lg-20 d-flex flex-column align-items-lg-start">
                            <div class="fw-bolder d-flex align-items-center gap-2 mb-2 mb-lg-3">
                                <i class="blog-icon ri-user-fill fw-semibold fs-2 text-myprimary"></i>
                                <span class="fs-4 text-myprimary">{{ books[0].author }}</span>
                            </div>
                            <div class="fw-bolder d-flex align-items-center justify-content-center gap-2">
                                <i class="blog-icon ri-article-fill fw-semibold fs-2 text-myprimary"></i>
                                <span class="fs-4 text-myprimary">{{ books[0].total_pages }} Halaman • {{ getYear(books[0].launch_date) }}</span>
                            </div>
                        </div>
                    </div>
                    <img
                        class="position-lg-absolute rounded-3 rounded-bottom-0 bottom-0 end-0 img-fluid object-fit-cover mw-300px w-lg-auto me-lg-10 h-lg-325px mx-auto w-100"
                        :src="`/storage/${books[0].image}`"
                        :alt="books[0].title"
                    />
                </a>
                <a id="book-card" v-if="books[1]"
                    :href="`/books/${books[1].slug}`"
                    class="mt-6 mt-lg-14 position-relative card border border-gray-300 p-10 pb-0 pb-lg-10 gap-10 w-100 mw-500px mw-lg-800px h-lg-300px mx-auto rounded-4 bg-light">
                    <img
                        class="order-1 position-lg-absolute rounded-3 rounded-bottom-0 bottom-0 start-0 img-fluid object-fit-cover mw-300px w-lg-auto ms-lg-10 h-lg-325px mx-auto w-100"
                        :src="`/storage/${books[1].image}`"
                        :alt="books[1].title"
                    />
                    <div class="h-100 d-flex flex-column flex-center flex-lg-start ms-lg-20 ps-lg-20 ">
                        <h3 class="flex-fill text-dark text-center ms-lg-20 ps-lg-20 text-lg-start lh-sm fs-1 fs-lg-2x fw-bolder text-truncate-3 mb-6">
                            {{ books[1].title }}
                        </h3>
                        <div class="ms-lg-20 ps-lg-20 d-flex flex-column align-items-lg-start">
                            <div class="fw-bolder d-flex align-items-center gap-2 mb-2 mb-lg-3">
                                <i class="blog-icon ri-user-fill fw-semibold fs-2 text-myprimary"></i>
                                <span class="fs-4 text-myprimary">{{ books[1].author }}</span>
                            </div>
                            <div class="fw-bolder d-flex align-items-center justify-content-center gap-2">
                                <i class="blog-icon ri-article-fill fw-semibold fs-2 text-myprimary"></i>
                                <span class="fs-4 text-myprimary">{{ books[1].total_pages }} Halaman • {{ getYear(books[1].launch_date) }}</span>
                            </div>
                        </div>
                    </div>
                </a>
                <a id="book-card" v-if="books[2]"
                    :href="`/books/${books[2].slug}`"
                    class="mt-6 mt-lg-14 position-relative card border border-gray-300 p-10 pb-0 pb-lg-10 gap-10 w-100 mw-500px mw-lg-800px h-lg-300px mx-auto rounded-4 bg-light">
                    <div class="h-100 d-flex flex-column flex-center flex-lg-start me-lg-20 pe-lg-20 ">
                        <h3 class="flex-fill text-dark text-center me-lg-20 pe-lg-20 text-lg-start lh-sm fs-1 fs-lg-2x fw-bolder text-truncate-3 mb-6">
                            {{ books[2].title }}
                        </h3>
                        <div class="me-lg-20 pe-lg-20 d-flex flex-column align-items-lg-start">
                            <div class="fw-bolder d-flex align-items-center gap-2 mb-2 mb-lg-3">
                                <i class="blog-icon ri-user-fill fw-semibold fs-2 text-myprimary"></i>
                                <span class="fs-4 text-myprimary">{{ books[2].author }}</span>
                            </div>
                            <div class="fw-bolder d-flex align-items-center justify-content-center gap-2">
                                <i class="blog-icon ri-article-fill fw-semibold fs-2 text-myprimary"></i>
                                <span class="fs-4 text-myprimary">{{ books[2].total_pages }} Halaman • {{ getYear(books[2].launch_date) }}</span>
                            </div>
                        </div>
                    </div>
                    <img
                        class="position-lg-absolute rounded-3 rounded-bottom-0 bottom-0 end-0 img-fluid object-fit-cover mw-300px w-lg-auto me-lg-10 h-lg-325px mx-auto w-100"
                        :src="`/storage/${books[2].image}`"
                        :alt="books[2].title"
                    />
                </a>
                <a href="/books" v-if="books.length > 0"
                    class="btn mt-10 ps-6 pe-7 btn-sm btn-myprimary-tinted rounded-pill fs-4 me-2 me-lg-0 gap-1 align-items-center"
                >
                    <i class="fs-3 ri-book-open-fill"></i>
                    <span class="fw-bolder text-nowrap"
                        >Lihat Semua Buku</span
                    >
                </a>
            </div>
        </div>
    </LayoutUser>
</template>

<script>
    import { Head, Link, router } from '@inertiajs/vue3';
    import LayoutUser from '../../Layouts/User.vue';
    import { onMounted } from 'vue';
    import Swiper from 'swiper';
    import { Pagination, Autoplay } from 'swiper/modules';
    import 'swiper/css';
    import 'swiper/css/pagination';
    
    export default {
        components: {
            Head,
            Link,
            LayoutUser,
        },

        props: {
            setting: Object,
            latestBlogs: Array,
            recentBlogs: Array, 
            books: Array,
        },

        setup(props) {
            onMounted(() => {
                if (props.latestBlogs && props.latestBlogs.length > 0) {
                    new Swiper('.mySwiper', {
                        modules: [Pagination, Autoplay],
                        loop: true,
                        spaceBetween: 20,
                        autoplay: {
                            delay: 4000, 
                            disableOnInteraction: false,
                        },
                        pagination: {
                            el: '.swiper-pagination',
                            clickable: true,
                        },
                    });
                }
            });

            const formatDate = (dateString) => {
                const date = new Date(dateString);
                return date.toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' });
            };

            const getYear = (dateString) => {
                return new Date(dateString).getFullYear();
            };

            const isRecent = (dateString) => {
                const date = new Date(dateString);
                const oneMonthAgo = new Date();
                oneMonthAgo.setMonth(oneMonthAgo.getMonth() - 1);
                return date >= oneMonthAgo;
            };

            return { 
                formatDate, 
                getYear,
                isRecent,
            };
        }
    }
</script>

<style>
    .w-80 {
        width: 80%;
    }

    .floating-icon {
        animation: float-left 3s ease-in-out infinite;
    }

    .floating-icon-delayed {
        animation: float-right 4s ease-in-out infinite;
    }

    @keyframes float-left {
        0% {
            transform: translateY(0px) rotate(-8deg);
        }
        50% {
            transform: translateY(-20px) rotate(-8deg);
        }
        100% {
            transform: translateY(0px) rotate(-8deg);
        }
    }

    @keyframes float-right {
        0% {
            transform: translateY(0px) rotate(8deg);
        }
        50% {
            transform: translateY(-20px) rotate(8deg);
        }
        100% {
            transform: translateY(0px) rotate(8deg);
        }
    }

    .w-120px {
        width: 120px !important;
    }

    .swiper-pagination-bullet {
        background: rgba(255, 255, 255, 0.33) !important;
        opacity: 1 !important;
    }
    .swiper-pagination-bullet-active {
        background: #ffffff !important;
    }
</style>