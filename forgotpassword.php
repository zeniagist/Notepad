<!--Start session-->
<!--Connect to the database-->

<!--Check user inputs-->
    <!--Define error messages-->
    <!--Get email-->
    <!--Store errors in errors variable-->
    <!--If there are any errors-->
        <!--print error message-->
    <!--else: No errors-->
        <!--Prepare variables for the query-->
        <!--Run query: Check if email exists in the user table-->
        <!--If email does not exist-->
        <!--print error message-->
        <!--else-->
            <!--Create a unique activation code-->
            <!--Insert user details and activation code in the forgotpassword table-->
            <!--Send email with link to resetpassword.php with user id and activiaton code-->
            <!--If email sent successfully-->
                <!--print success message-->