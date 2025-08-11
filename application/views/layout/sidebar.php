<div class="sidebar">
    <ul>
        <li><a href="<?= site_url('dashboard') ?>">Dashboard</a></li>
        <?php if ($this->session->userdata('role') == 'admin'): ?>
            <li><a href="<?= site_url('manage_users') ?>">Manage Users</a></li>
        <?php endif; ?>
        <li><a href="<?= site_url('auth/logout') ?>">Logout</a></li>
    </ul>
</div>
