@php
	$user = Auth::user();
@endphp
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
	<div class="app-brand demo">
		<a href="{{route('executive.dashboard')}}" class="app-brand-link">
			<span class="app-brand-logo demo">
				{{--  Add Logo  --}}
			</span>
			<span class="app-brand-text demo menu-text fw-bold ms-2 text-capitalize fs-4">{{ $user->role }}</span>
		</a>

		<a href="javascript:void(0);"
			class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
			<i class="bx bx-chevron-left bx-sm align-middle"></i>
		</a>
	</div>

	<div class="menu-inner-shadow"></div>

	<ul class="menu-inner py-1">
		<li class="menu-item {{ request()->is('executive/dashboard') ? 'active' : ''}}">
			<a href="{{route('executive.dashboard')}}" class="menu-link">
				<i class="menu-icon tf-icons bx bx-home-circle"></i>
				<div data-i18n="Dashboard">Dashboard</div>
			</a>
		</li>

		@foreach([
			['route' => 'executive.customer.index', 'text' => 'Customer'],
			['route' => 'executive.order.index', 'text' => 'Order'],
		] as $mastermenu)
			<li class="menu-item {{ request()->routeIs($mastermenu['route']) ? 'active' : '' }}">
				<a href="{{ route($mastermenu['route']) }}" class="menu-link">
					<i class="menu-icon tf-icons bx bxs-user"></i>
					<div data-i18n="{{ $mastermenu['text'] }}">{{ $mastermenu['text'] }}</div>
				</a>
			</li>
		@endforeach
	</ul>
</aside>