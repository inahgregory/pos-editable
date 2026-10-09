<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title ?? 'POS Editable') ?></title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f7fb;
            color: #222;
        }

        header {
            background: #1f4e79;
            color: white;
            padding: 18px 30px;
        }

        nav a {
            color: white;
            margin-right: 16px;
            text-decoration: none;
            font-weight: bold;
        }

        main {
            max-width: 1050px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .button {
            display: inline-block;
            background: #1f4e79;
            color: white;
            padding: 9px 13px;
            border-radius: 5px;
            text-decoration: none;
            border: 0;
            cursor: pointer;
        }

        .button.secondary {
            background: #666;
        }

        .card {
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 18px;
            margin-bottom: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
            vertical-align: middle;
        }

        th {
            background: #e8eef5;
        }

        label {
            display: block;
            font-weight: bold;
            margin-top: 12px;
        }

        input, textarea {
            width: 100%;
            padding: 9px;
            margin-top: 5px;
            box-sizing: border-box;
        }

        .error-box {
            background: #ffe5e5;
            border: 1px solid #d33;
            color: #900;
            padding: 12px;
            margin-bottom: 15px;
        }

        .avatar {
            width: 58px;
            height: 58px;
            border-radius: 50%;
            object-fit: cover;
            background: #ddd;
        }

        footer {
            text-align: center;
            color: #666;
            padding: 20px;
        }
    </style>
</head>
<body>
<header>
    <h2>POS Account Management</h2>
    <nav>
        <a href="<?= site_url('/customers') ?>">Customers</a>
        <a href="<?= site_url('/users') ?>">Users</a>
    </nav>
</header>
<main>