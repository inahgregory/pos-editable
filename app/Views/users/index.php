<div class="topbar">
    <div>
        <h1>User Accounts</h1>
        <p>Manage user accounts and profile avatars.</p>
    </div>
    <a class="button" href="<?= site_url('/users/new') ?>">New User</a>
</div>

<table>
    <thead>
        <tr>
            <th>Avatar</th>
            <th>ID</th>
            <th>Username</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <?php
                $avatar = ! empty($user['avatar'])
                    ? base_url('uploads/avatars/' . $user['avatar'])
                    : 'https://via.placeholder.com/80?text=User';
            ?>
            <tr>
                <td><img class="avatar" src="<?= esc($avatar) ?>" alt="Avatar"></td>
                <td><?= esc($user['id']) ?></td>
                <td><?= esc($user['username']) ?></td>
                <td><?= esc($user['full_name']) ?></td>
                <td><?= esc($user['email']) ?></td>
                <td>
                    <a class="button secondary" href="<?= site_url('/users/edit/' . $user['id']) ?>">Edit</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>