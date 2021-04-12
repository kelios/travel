<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">{{ trans('brackets/admin-ui::admin.sidebar.content') }}</li>
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/users') }}"><i class="nav-icon icon-magnet"></i> {{ trans('admin.user.title') }}</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/transports') }}"><i class="nav-icon icon-umbrella"></i> {{ trans('admin.transport.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/complexities') }}"><i class="nav-icon icon-energy"></i> {{ trans('admin.complexity.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/cities') }}"><i class="nav-icon icon-flag"></i> {{ trans('admin.city.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/countries') }}"><i class="nav-icon icon-magnet"></i> {{ trans('admin.country.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/months') }}"><i class="nav-icon icon-magnet"></i> {{ trans('admin.month.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/over-night-stays') }}"><i class="nav-icon icon-diamond"></i> {{ trans('admin.over-night-stay.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/travels') }}"><i class="nav-icon icon-graduation"></i> {{ trans('admin.travel.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/categories') }}"><i class="nav-icon icon-star"></i> {{ trans('admin.category.title') }}</a></li>

           <li class="nav-item"><a class="nav-link" href="{{ url('admin/companions') }}"><i class="nav-icon icon-energy"></i> {{ trans('admin.companion.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/comments') }}"><i class="nav-icon icon-diamond"></i> {{ trans('admin.comment.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/messages') }}"><i class="nav-icon icon-ghost"></i> {{ trans('admin.message.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/articles') }}"><i class="nav-icon icon-drop"></i> {{ trans('admin.article.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/article-types') }}"><i class="nav-icon icon-graduation"></i> {{ trans('admin.article-type.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/travel-likes') }}"><i class="nav-icon icon-star"></i> {{ trans('admin.travel-like.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/category-travel-addresses') }}"><i class="nav-icon icon-ghost"></i> {{ trans('admin.category-travel-address.title') }}</a></li>
           {{-- Do not delete me :) I'm used for auto-generation menu items --}}

            <li class="nav-title">{{ trans('brackets/admin-ui::admin.sidebar.settings') }}</li>
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/admin-users') }}"><i class="nav-icon icon-user"></i> {{ __('Manage access') }}</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/translations') }}"><i class="nav-icon icon-location-pin"></i> {{ __('Translations') }}</a></li>
            {{-- Do not delete me :) I'm also used for auto-generation menu items --}}
            {{--<li class="nav-item"><a class="nav-link" href="{{ url('admin/configuration') }}"><i class="nav-icon icon-settings"></i> {{ __('Configuration') }}</a></li>--}}
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
