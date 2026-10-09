<h1><?= $customer ? 'Edit Customer' : 'New Customer' ?></h1>

<?php if (! empty($errors)): ?>
    <div class="error-box">
        <?php foreach ($errors as $error): ?>
            <p><?= esc($error) ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form method="post" action="<?= esc($action) ?>">
    <?= csrf_field() ?>

    <label for="full_name">Full Name</label>
    <input
        type="text"
        id="full_name"
        name="full_name"
        value="<?= old('full_name', $customer['full_name'] ?? '') ?>"
    >

    <label for="email">Email</label>
    <input
        type="email"
        id="email"
        name="email"
        value="<?= old('email', $customer['email'] ?? '') ?>"
    >

    <label for="phone">Phone</label>
    <input
        type="text"
        id="phone"
        name="phone"
        value="<?= old('phone', $customer['phone'] ?? '') ?>"
    >

    <label for="address">Address</label>
    <textarea id="address" name="address"><?= old('address', $customer['address'] ?? '') ?></textarea>

    <br><br>
    <button class="button" type="submit">Save Customer</button>
    <a class="button secondary" href="<?= site_url('/customers') ?>">Cancel</a>
</form>