<h1><?= $user ? 'Edit User' : 'New User' ?></h1>

<?php if (! empty($errors)): ?>
    <div class="error-box">
        <?php foreach ($errors as $error): ?>
            <p><?= esc($error) ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form method="post" action="<?= esc($action) ?>" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <label for="username">Username</label>
    <input
        type="text"
        id="username"
        name="username"
        value="<?= old('username', $user['username'] ?? '') ?>"
    >

    <label for="full_name">Full Name</label>
    <input
        type="text"
        id="full_name"
        name="full_name"
        value="<?= old('full_name', $user['full_name'] ?? '') ?>"
    >

    <label for="email">Email</label>
    <input
        type="email"
        id="email"
        name="email"
        value="<?= old('email', $user['email'] ?? '') ?>"
    >

    <?php if ($user): ?>
        <label for="avatar">Profile Picture</label>
        <input type="file" id="avatar" name="avatar" accept="image/jpeg,image/png">

        <?php if (! empty($user['avatar'])): ?>
            <p>Current Avatar:</p>
            <img class="avatar" src="<?= base_url('uploads/avatars/' . $user['avatar']) ?>" alt="Current avatar">
        <?php endif; ?>
    <?php endif; ?>

    <br><br>
    <button class="button" type="submit">Save User</button>
    <a class="button secondary" href="<?= site_url('/users') ?>">Cancel</a>
</form>