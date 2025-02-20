<div class="menu-item" data-menu-item-toggle="accordion" data-menu-item-trigger="click">
    <div class="menu-link flex items-center grow cursor-pointer border border-transparent gap-[10px] ps-[10px] pe-[10px] py-[6px]"
        tabindex="0">
        <span class="menu-icon items-start text-gray-500 dark:text-gray-400 w-[20px]">
            <i class="{{ $icon }}">
            </i>
        </span>
        <span
            class="menu-title text-sm font-medium text-gray-800 menu-item-active:text-primary menu-link-hover:!text-primary">
            {{ $group_name }}
        </span>
        <span class="menu-arrow text-gray-400 w-[20px] shrink-0 justify-end ms-1 me-[-10px]">
            <i class="ki-filled ki-plus text-2xs menu-item-show:hidden">
            </i>
            <i class="ki-filled ki-minus text-2xs hidden menu-item-show:inline-flex">
            </i>
        </span>
    </div>
    <div
        class="menu-accordion gap-0.5 ps-[10px] relative before:absolute before:start-[20px] before:top-0 before:bottom-0 before:border-s before:border-gray-200">
        @foreach ($menu_items as $menu)
            @include('core.menu_item', $menu)
        @endforeach
    </div>
</div>
