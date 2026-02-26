<template>
    <div id="kt_app_header" class="app-header bg-white">
        <div class="container-fluid d-flex align-items-stretch justify-content-between">
            <div class="d-flex align-items-center d-lg-none ms-n3 me-2" title="Show sidebar menu">
                <div class="btn btn-icon btn-myicon w-35px h-35px" id="kt_app_sidebar_mobile_toggle">
                    <i class="ri-menu-line fs-2"></i>
                </div>
            </div>
            <div class="d-flex align-items-center justify-content-center flex-grow-1 flex-lg-grow-0">
                <Link href="/admin/dashboard" class="d-lg-none d-flex">
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
            <div class="d-flex align-items-center justify-content-between flex-lg-grow-1" id="kt_app_header_wrapper">
                <div></div>
                <div class="app-navbar-item ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
                    <div class="dropdown">
                        <div class="symbol symbol-35px symbol-md-40px symbol-circle cursor-pointer" 
                                data-bs-toggle="dropdown" 
                                aria-expanded="false"
                                title="Profil Akun">
                            <div class="symbol-label bg-myprimary text-white fw-bolder fs-5 border border-myprimary border-dashed">
                                {{ getInitials($page.props.auth.user.name) }}
                            </div>
                        </div>
                        
                        <ul class="dropdown-menu dropdown-menu-end shadow-none border border-gray-300 rounded-4 mt-7 p-4 w-225px">
                            <li>
                                <div class="d-flex align-items-center mb-3 ms-1 py-2">
                                    <div class="symbol symbol-35px symbol-md-40px symbol-circle flex-shrink-0 me-3">
                                        <div class="symbol-label bg-myprimary text-white fw-bolder fs-5">
                                            {{ getInitials($page.props.auth.user.name) }}
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column" style="min-width: 0;">
                                        <span class="fw-bolder text-dark fs-6 text-truncate w-100">{{ $page.props.auth.user.name }}</span>
                                        <span class="text-gray-500 fs-7 text-truncate w-100">{{ $page.props.auth.user.email }}</span>
                                    </div>
                                </div>
                            </li>
                            <li><hr class="dropdown-divider border-gray-200 my-3"></li>
                            <li>
                                <Link href="/" class="dropdown-item fs-5 px-4 py-3 btn btn-sm btn-mytertiary-ghost d-flex align-items-center fw-bold rounded-3">
                                    <i class="ri-home-4-line fs-3 me-2 fw-semibold"></i> Beranda
                                </Link>
                            </li>
                            <li>
                                <Link href="/admin/settings" 
                                    class="dropdown-item fs-5 px-4 py-3 btn btn-sm btn-mytertiary-ghost d-flex align-items-center fw-bold rounded-3">
                                    <i class="ri-settings-line fs-3 me-2 fw-semibold"></i>Pengaturan
                                </Link>
                            </li>
                            <li>
                                <Link href="/admin/account" 
                                    class="dropdown-item fs-5 px-4 py-3 btn btn-sm btn-mytertiary-ghost d-flex align-items-center fw-bold rounded-3">
                                    <i class="ri-account-circle-line fs-3 me-2 fw-semibold"></i>Akun
                                </Link>
                            </li>
                            <li><hr class="dropdown-divider border-gray-200 my-3"></li>
                            <li>
                                <Link href="/admin/logout" method="POST" as="button" class="dropdown-item fs-5 px-4 py-3 btn btn-sm btn-mydanger-ghost d-flex align-items-center fw-bold text-danger rounded-3 w-100 text-start">
                                    <i class="ri-logout-box-line fs-3 text-danger me-2 fw-semibold"></i>Keluar
                                </Link>
                            </li>
                        </ul>
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

        methods: {
            getInitials(name) {
                if (!name) return '';
                return name
                    .split(' ')
                    .map(n => n[0].toUpperCase())
                    .join('')
                    .slice(0, 2);
            }
        }
    }
</script>

<style>

</style>
