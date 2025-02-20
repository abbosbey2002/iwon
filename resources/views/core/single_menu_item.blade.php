<div class="menu-item" data-menu-item-toggle="accordion" data-menu-item-trigger="click">
    <a href="{{ $route }}" class="menu-link flex items-center grow cursor-pointer border border-transparent gap-[10px] ps-[10px] pe-[10px] py-[6px]" tabindex="0">
     <span class="menu-icon items-start text-gray-500 dark:text-gray-400 w-[20px]">
      <i class="{{$icon}}">
      </i>
     </span>
     <span class="menu-title text-sm font-medium text-gray-800 menu-item-active:text-primary menu-link-hover:!text-primary">
      {{ $name }}
     </span>
    </a>
   </div>