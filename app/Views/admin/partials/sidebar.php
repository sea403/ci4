<?php $current = service('uri')->getPath(); ?>

<nav id="sidebarMenu" class="sidebar d-lg-block bg-gray-800 text-white collapse" data-simplebar="init">
    <div class="simplebar-wrapper" style="margin: 0px;">
        <div class="simplebar-height-auto-observer-wrapper">
            <div class="simplebar-height-auto-observer"></div>
        </div>
        <div class="simplebar-mask">
            <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                <div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content"
                    style="height: auto; overflow: hidden;">
                    <div class="simplebar-content" style="padding: 0px;">
                        <div class="sidebar-inner px-4 pt-3">
                            <div
                                class="user-card d-flex d-md-none align-items-center justify-content-between justify-content-md-center pb-4">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-lg me-4">
                                        <img src="<?= base_url('images/logo.svg') ?>"
                                            class="card-img-top rounded-circle border-white" alt="Bonnie Green">
                                    </div>
                                    <div class="d-block">
                                        <h2 class="h5 mb-3">Hi, Jane</h2>
                                        <a href="../../pages/examples/sign-in.html"
                                            class="btn btn-secondary btn-sm d-inline-flex align-items-center"><svg
                                                class="icon icon-xxs me-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                                </path>
                                            </svg>
                                            Sign Out</a>
                                    </div>
                                </div>
                                <div class="collapse-close d-md-none">
                                    <a href="#sidebarMenu" data-bs-toggle="collapse" data-bs-target="#sidebarMenu"
                                        aria-controls="sidebarMenu" aria-expanded="true"
                                        aria-label="Toggle navigation"><svg class="icon icon-xs" fill="currentColor"
                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg></a>
                                </div>
                            </div>
                            <ul class="nav flex-column pt-3 pt-md-0">
                                <li class="nav-item">
                                    <a href="/admin" class="nav-link d-flex align-items-center"><span
                                            class="sidebar-icon">
                                            <img src="<?= base_url('images/logo.svg') ?>" height="auto" width="100%"
                                                alt="Volt Logo"> </span><span class="mt-1 ms-1 sidebar-text"></span></a>
                                </li>
                                <li class="nav-item <?= $current == '/admin' ? 'active' : '' ?>">
                                    <a href="/admin" class="nav-link">
                                        <span class="sidebar-icon"><i class="fa fa-dashboard"></i></span>
                                        <span class="sidebar-text"><?= lang('Labels.dashboard') ?></span>
                                    </a>
                                </li>

                                <li class="nav-item <?= $current == '/admin/user/index' ? 'active' : '' ?>">
                                    <a href="/admin/user/index" class="nav-link">
                                        <span class="sidebar-icon">
                                            <i class="fa fa-users"></i>
                                        </span>
                                        <span class="sidebar-text"><?= lang('Labels.users') ?></span></a>
                                </li>

                                <li class="nav-item <?= $current == '/admin/language/index' ? 'active' : '' ?>">
                                    <a href="/admin/language/index" class="nav-link">
                                        <span class="sidebar-icon"><i class="fa fa-flag"></i></span><span class="sidebar-text"><?= lang('Labels.languages') ?></span></a>
                                </li>

                                <li class="nav-item">
                                    <a href="" class="nav-link"><span class="sidebar-icon"><i class="fa fa-cog"></i></span><span class="sidebar-text">
                                        <?= lang('Labels.settings') ?>
                                    </span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="simplebar-placeholder" style="width: auto; height: 621px;"></div>
    </div>
    <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
        <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
    </div>
    <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
        <div class="simplebar-scrollbar" style="height: 0px; display: none;"></div>
    </div>
</nav>