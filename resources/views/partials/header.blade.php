<header
    class="header fixed top-0 z-10 start-0 end-0 flex items-stretch shrink-0 bg-[--tw-page-bg] dark:bg-[--tw-page-bg-dark]"
    data-sticky="true" data-sticky-class="shadow-sm" data-sticky-name="header" id="header">
    <!-- Container -->
    <div class="container-fixed flex justify-between items-stretch lg:gap-4" id="header_container">
        <!-- Mobile Logo -->
        <div class="flex gap-1 lg:hidden items-center -ms-1">
            <a class="shrink-0" href="{{ route('dashboard') }}">
                <img class="max-h-[25px] w-full" src="{{ asset('assets/media/app/mini-logo.svg') }}" />
            </a>
            <div class="flex items-center">
                <button class="btn btn-icon btn-light btn-clear btn-sm" data-drawer-toggle="#sidebar">
                    <i class="ki-filled ki-menu">
                    </i>
                </button>
            </div>
        </div>
        <!-- End of Mobile Logo -->
        <div class="flex items-stretch" id="mega_menu_container">
        </div>
        <!-- Topbar -->
        <div class="flex items-center gap-2 lg:gap-3.5">
            <div class="menu" data-menu="true">
                <div class="menu-item" data-menu-item-offset="20px, 10px" data-menu-item-offset-rtl="-20px, 10px"
                    data-menu-item-placement="bottom-end" data-menu-item-placement-rtl="bottom-start"
                    data-menu-item-toggle="dropdown" data-menu-item-trigger="click|lg:click">
                    <div class="menu-toggle  rounded-full">
                        <h4 class="">{{ Auth::user()->name }}</h4>
                        </img>
                    </div>
                    <div class="menu-dropdown menu-default light:border-gray-300 w-screen max-w-[250px]">
                        <div class="flex flex-col">
                            <div class="menu-item px-4 py-1.5">
                                <a class="btn btn-sm btn-light justify-center" href="{{ route('logout') }}">
                                    Log out
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Topbar -->
    </div>
    <!-- End of Container -->
</header>
