@auth
<div class="dashboard__sidebar">
    <div class="sidebar__avatar mt-5">
        <i class="fas fa-user-circle fa-3x"></i>
    </div>
    <div class="sidebar__menu mt-5">
        <ul class="list-unstyled sidebar__menu">
            <li class="{{ request()->path() === 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}">
                    <i class="fas fa-chart-line fa-1x"></i>
                </a>
            </li>
            <li class="{{ strpos(request()->path(), 'invoices') !== false ? 'active' : '' }}">
                <a href="{{ route('invoices.index') }}">
                    <i class="fas fa-file-invoice fa-1x"></i>
                </a>
            </li>
            <li class="{{ strpos(request()->path(), 'customers') !== false ? 'active' : '' }}">
                <a href="{{ route('customers.index') }}">
                    <i class="fas fa-users-cog fa-1x"></i>
                </a>
            </li>
        </ul>
    </div>
</div>
@endauth