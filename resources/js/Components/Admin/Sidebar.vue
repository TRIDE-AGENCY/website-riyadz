<template>
    <div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
        data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px"
        data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
        <div class="app-sidebar-logo px-6 border-end border-gray-300" id="kt_app_sidebar_logo">
            <Link href="/admin/dashboard">
                <div class="d-flex align-items-center gap-3">
                    <img
                        :alt="`Logo ${$page.props.setting.site_title}`"
                        :src="`/storage/${$page.props.setting.site_logo}`"
                        class="h-35px h-md-40px"
                    />
                    <span style="font-weight: 800;" class="text-nowrap text-truncate-1 fs-1 text-myprimary">
                        {{ $page.props.setting.site_title }}
                    </span>
                </div>
            </Link>
        </div>
        <div class="app-sidebar-menu overflow-hidden flex-column-fluid border-end border-gray-300">
            <div id="kt_app_sidebar_menu_wrapper"
                class="app-sidebar-wrapper d-flex flex-column justify-content-between hover-scroll-overlay-y my-6"
                data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto"
                data-kt-scroll-dependencies="#kt_app_sidebar_logo"
                data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px"
                data-kt-scroll-save-state="true">
                <div class="menu menu-column menu-rounded menu-sub-indention px-4" id="#kt_app_sidebar_menu"
                    data-kt-menu="true" data-kt-menu-expand="false">
                    <div class="menu-item">
                        <Link class="menu-link menu-link-mysecondary rounded-3 py-3"
                            :class="{ 'active': $page.url.startsWith('/admin/dashboard') }" href="/admin/dashboard">
                        <span class="menu-icon">
                            <i
                                :class="[$page.url.startsWith('/admin/dashboard') ? 'ri-dashboard-fill' : 'ri-dashboard-line',
                                    'fs-2 fw-normal'
                                ]"></i>
                        </span>
                        <span
                            :class="[$page.url.startsWith('/admin/dashboard') ? 'fw-bolder' : 'fw-bold', 'menu-title fs-5']">Dashboard</span>
                        </Link>
                    </div>
                    <div class="menu-item pt-4">
                        <div class="menu-content py-1 mb-1">
                            <span class="text-gray-500 fw-semibold text-uppercase fs-7" style="letter-spacing: 0.06em;">Pengelolaan</span>
                        </div>
                    </div>
                    <div class="menu-item">
                        <Link class="menu-link menu-link-mysecondary rounded-3 py-3"
                            :class="{ 'active': $page.url.startsWith('/admin/blogs') }" href="/admin/blogs">
                        <span class="menu-icon">
                            <i
                                :class="[$page.url.startsWith('/admin/blogs') ? 'ri-blogger-fill' :
                                    'ri-blogger-line', 'fs-2 fw-normal'
                                ]"></i>
                        </span>
                        <span
                            :class="[$page.url.startsWith('/admin/blogs') ? 'fw-bolder' : 'fw-bold', 'menu-title fs-5']">Daftar Blog</span>
                        </Link>
                    </div>
                    <div class="menu-item">
                        <Link class="menu-link menu-link-mysecondary rounded-3 py-3"
                            :class="{ 'active': $page.url.startsWith('/admin/books') }" href="/admin/books">
                        <span class="menu-icon">
                            <i
                                :class="[$page.url.startsWith('/admin/books') ? 'ri-book-open-fill' :
                                    'ri-book-open-line', 'fs-2 fw-normal'
                                ]"></i>
                        </span>
                        <span
                            :class="[$page.url.startsWith('/admin/books') ? 'fw-bolder' : 'fw-bold', 'menu-title fs-5']">Daftar Buku</span>
                        </Link>
                    </div>
                    <div class="menu-item">
                        <Link class="menu-link menu-link-mysecondary rounded-3 py-3"
                            :class="{ 'active': $page.url.startsWith('/admin/messages') }" href="/admin/messages">
                        <span class="menu-icon">
                            <i
                                :class="[$page.url.startsWith('/admin/messages') ? 'ri-chat-history-fill' :
                                    'ri-chat-history-line', 'fs-2 fw-normal'
                                ]"></i>
                        </span>
                        <span
                            :class="[$page.url.startsWith('/admin/messages') ? 'fw-bolder' : 'fw-bold', 'menu-title fs-5']">Pesan Masuk</span>
                        </Link>
                    </div>
                    <div class="menu-item pt-4">
                        <div class="menu-content py-1 mb-1">
                            <span class="text-gray-500 fw-semibold text-uppercase fs-7" style="letter-spacing: 0.06em;">Lainnya</span>
                        </div>
                    </div>
                    <div class="menu-item">
                        <Link class="menu-link menu-link-mysecondary rounded-3 py-3"
                            :class="{ 'active': $page.url.startsWith('/admin/settings') }" href="/admin/settings">
                        <span class="menu-icon">
                            <i
                                :class="[$page.url.startsWith('/admin/settings') ? 'ri-settings-fill' :
                                    'ri-settings-line', 'fs-2 fw-normal'
                                ]"></i>
                        </span>
                        <span
                            :class="[$page.url.startsWith('/admin/settings') ? 'fw-bolder' : 'fw-bold', 'menu-title fs-5']">Pengaturan</span>
                        </Link>
                    </div>
                    <div class="menu-item">
                        <Link class="menu-link menu-link-mysecondary rounded-3 py-3"
                            :class="{ 'active': $page.url.startsWith('/admin/account') }" href="/admin/account">
                        <span class="menu-icon">
                            <i
                                :class="[$page.url.startsWith('/admin/account') ? 'ri-account-circle-fill' :
                                    'ri-account-circle-line', 'fs-2 fw-normal'
                                ]"></i>
                        </span>
                        <span
                            :class="[$page.url.startsWith('/admin/account') ? 'fw-bolder' : 'fw-bold', 'menu-title fs-5']">Akun</span>
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {
        Link
    } from '@inertiajs/vue3';

    export default {
        components: {
            Link,
        },

        setup() {
        }
    }
</script>

<style>
</style>
