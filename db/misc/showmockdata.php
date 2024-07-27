<?php
require_once('../common.php');

$dbUser = new dbuser();
$dbEmail = new dbEmail();
$dbContactUs = new dbcontactus();

// Fetch users from the database
$users = $dbUser->lookup_all();

// Fetch emails from the database
$emails = $dbEmail->lookup_all();

// Fetch contact us entries from the database
$contactUsEntries = $dbContactUs->lookup_all();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mock Data Display</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>Users</h1>
    <table>
        <tr>
            <th>User ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Password Hash</th>
        </tr>
        <?php foreach ($users as $user) : ?>
            <tr>
                <td><?php echo htmlspecialchars($user['user']); ?></td>
                <td><?php echo htmlspecialchars($user['fname']); ?></td>
                <td><?php echo htmlspecialchars($user['lname']); ?></td>
                <td><?php echo htmlspecialchars($user['email']); ?></td>
                <td><?php echo htmlspecialchars($user['pass']); ?></td>
            </tr>
            </tr>
        <?php endforeach; ?>
    </table>

    <h1>Emails</h1>
    <table>
        <tr>
            <th>Email ID</th>
            <th>User</th>
            <th>To Email</th>
            <th>From Email</th>
            <th>Email Subject</th>
            <th>Email Body</th>
            <th>Date</th>
            <th>Time</th>
        </tr>
        <?php foreach ($emails as $email) : ?>
            <tr>
                <td><?php echo htmlspecialchars($email['_id']); ?></td>
                <td><?php echo htmlspecialchars($email['user']); ?></td>
                <td><?php echo htmlspecialchars($email['to_email']); ?></td>
                <td><?php echo htmlspecialchars($email['from_email']); ?></td>
                <td><?php echo htmlspecialchars($email['email_subject']); ?></td>
                <td><?php echo htmlspecialchars($email['email_body']); ?></td>
                <td><?php echo htmlspecialchars($email['date']); ?></td>
                <td><?php echo htmlspecialchars($email['time']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <h1>Contact Us Entries</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>From Email</th>
            <th>Email Body</th>
        </tr>
        <?php foreach ($contactUsEntries as $entry) : ?>
            <tr>
                <td><?php echo htmlspecialchars($entry['_id']); ?></td>
                <td><?php echo htmlspecialchars($entry['from_email']); ?></td>
                <td><?php echo htmlspecialchars($entry['email_body']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>