<aside class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="/">
            <img src="<?= base_url(); ?>/img/mdi-nobg.png" alt="MDI Logo" style="max-height: 50px; width: auto;">
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">Dashboard</li>

            <li class="sidebar-item <?= $isActive('/') ? 'active' : '' ?>">
                <a class="sidebar-link" href="<?= base_url('/'); ?>">
                    <i class="align-middle" data-feather="sliders"></i>
                    <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-header">Technical Operation</li>

            <li class="sidebar-item <?= $isActive('sop') ? 'active' : '' ?>">
                <a class="sidebar-link" href="<?= base_url('sop'); ?>">
                    <i class="align-middle" data-feather="file-text"></i>
                    <span class="align-middle">Operational Procedures</span>
                </a>
            </li>

            <li class="sidebar-header">Project Documents</li>

            <li class="sidebar-item <?= $isActive('orders') ? 'active' : '' ?>">
                <a class="sidebar-link" href="<?= base_url('orders'); ?>">
                    <i class="align-middle" data-feather="file-text"></i>
                    <span class="align-middle">Order Management</span>
                </a>
            </li>

        </ul>
    </div>
</aside>