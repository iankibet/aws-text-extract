# aws-text-extract
Edit index.php

replace text enclosed in curly braces with aws credentials

Assuming you’ve got an AWS account, next, you need to create an IAM (Identity and Access Management) user. If you are signed in to your AWS console, just search for “Identity and Access Management”, and it takes you to the right place to create an IAM user. There’s an area called “Create individual IAM users”. Go there, click the “Manage Users” button, click the “Add User” button, choose a name like TextractUser, and give this user programmatic access only. Once you’ve created the name, go to the next step, where you can add the user to a specific group. Create a group which has the AmazonTextractFullAccess policy name. Name it something like TextractFullAccessGroup, and save that. Add the user you just created to this group. The next step lets you add tags to the user, but you can leave that blank.

In the Review (last) step, you are given the user’s access key ID and secret key (which is hidden – you will have to reveal it to copy it). Save these in a secure place! As the documentation says, “This is the last time these credentials will be available to download. However, you can create new credentials at any time.” (So if you lose them somehow, you can always generate a new set.)
