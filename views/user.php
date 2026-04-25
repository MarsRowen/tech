<?php include __DIR__ . '/../includes/header.php'; ?>

<?php if ($message): ?>
    <div class="message"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>

<div class="card-panel">
    <h2>Add User</h2>
    <form method="post" style="display:grid; gap:12px; max-width:480px;">
        <div class="field">
            <label for="name">Name</label>
            <input id="name" name="name" type="text" placeholder="Admin name" required />
        </div>
        <div class="field">
            <label for="email">Email</label>
            <input id="email" name="email" type="email" placeholder="admin@poultry.local" required />
        </div>
        <div class="field">
            <label for="password">Password</label>
            <input id="password" name="password" type="password" placeholder="Password" required />
        </div>
        <div class="field">
            <label for="role">Role</label>
            <select id="role" name="role">
                <option value="manager">Manager</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        <button class="button" type="submit">Create User</button>
    </form>
</div>

<div class="card-panel">
    <h2>Existing Users</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Created</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['name']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= htmlspecialchars(ucfirst($user['role'])) ?></td>
                    <td><?= htmlspecialchars($user['created_at']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>