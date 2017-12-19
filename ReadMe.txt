Regarding CopyLeaks API: 

I implemented the function that checks for free text, however there's a problem with the API when using this function to return the process created.

- The callback url had to be an online website, so i used https://requestb.in/1jrvnp41 for testing.

- If you run the file "TextPlagiarism.php" and uncomment the function 
FreeTextCheck(), you can find the results on the callback url not on the php page.

However, i also implemented the FileCheck which checks for file plagiarism and the results appear normally on the php page.

I think the problem might be from the api or there's a certain usage i wasn't able to find to get the process for the "createbytext" function.

When i tried "createbyURL" or "createbyFile", both of them are working perfectly. 

Regarding The Second Requirement: 
1)Run the file "untap.sql" on phpmyadmin which creates the tables and inserts the records.
2)Run the query "required-query.sql" and you will find the resulted rows.

Regarding the Third Requirement:
You can find the plugin inside the "untap-products-plugin" folder.

If you have any questions please do not hesitate to contact me.