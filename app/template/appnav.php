<div class="admin-left-nav">
    <div class="account-info">
            <h1>Maen Halah</h1>
            <div class="type"><?=$text_user_type?></div>
    </div>
    <ul class="nav-links">
        <li class="<?=$this->MatchController('index') ? ' active' : ''; ?>"><a href="/index"><?= $text_left_nav_dashboard?></a></li>
        <li class="<?=$this->MatchController('users') ? ' active' : ''; ?>"><a href="/users"><?= $text_left_nav_users?></a></li>
        <li><a href="/store"><?= $text_left_nav_store?></a></li>
        <li><a href="/expenses"><?= $text_left_nav_expenses?></a></li>
        <li><a href="/transactions"><?= $text_left_nav_transactions?></a></li>
        <li><a href="/clients"><?= $text_left_nav_clients?></a></li>
        <li><a href="/suppliers"><?= $text_left_nav_suppliers?></a></li>
        <li><a href="/notifications"><?= $text_left_nav_notifications?></a></li>
        <li><a href="/language/"><?=$text_left_nav_change_lang?></a></li>
        <li><a href="/log/"><?=$text_left_nav_log_out?></a></li>
    </ul>
</div>