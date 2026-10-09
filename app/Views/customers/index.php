<div class="topbar">
    <div>
        <h1>Customers</h1>
        <p>Manage customer accounts.</p>
    </div>
    <a class="button" href="<?= site_url('/customers/new') ?>">New Customer</a>
</div>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($customers as $customer): ?>
            <tr>
                <td><?= esc($customer['id']) ?></td>
                <td><?= esc($customer['full_name']) ?></td>
                <td><?= esc($customer['email']) ?></td>
                <td><?= esc($customer['phone']) ?></td>
                <td><?= esc($customer['address']) ?></td>
                <td>
                    <a class="button secondary" href="<?= site_url('/customers/edit/' . $customer['id']) ?>">Edit</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>