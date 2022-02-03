<?php
//include db_conn.php
include_once("db_conn.php"); // security nisa, awashyathawa iwara unama iwarai

function Auth($userName,$pwd) //authentication, username and password harida kiyla blnwa
{
    $conn=connection();//include_once("db_conn.php") nisa wada krnne. function name
    $sql_auth="SELECT* FROM user_tbl WHERE user_email='$userName';"; //dynamic
    $sql_result= mysqli_query($conn,$sql_auth); //sql eka connection eka matha run krnwa

    //check number of rows(nor)
    $nor=mysqli_num_rows($sql_result); //sql resualt eke output rows gana blnwa. resault eka number ekak enna one. email eka unique nisa result 1 row ekai enna one.
    if($nor>=1)
    { //enter krpu password ekai database password ekai match wenwada blnwa
        $new_pwd= MD5("$pwd");//user dena password eka md5 krgnnwa. encrypt, md5(hash) nisa password reverse krnna ba,32 numbers and letters mixed
        //fetch all the values
        $rec=mysqli_fetch_assoc($sql_result); //whole row eka gnnwa rec kiyna ekta. mysqli=database keyword, fetch=genna gnnwa, assoc= associative array-length eka fixed na. database eken genna gena associative array ekta danwa

        if($new_pwd==$rec['user_pwd']) //checks your hashed checkbox password with your respective password in the database
        //== is logical operator, samanada blnwa, true false output. // [] array elements
        {
            if($rec['user_status']==1) //active user knkda kiyla blnwa
            {
                if($rec['user_role']=="manager") //validation
                {
                    //create a session_cache_expire
                    $_SESSION['login_name']=$rec['user_name'];
                    $_SESSION['login_id']=$rec['user_id'];

                    //redirect pages
                    header("location:lib/views/admin.php");
                }
            }
                else
                {
                    echo("Your account has been removed");
                }
            }
                else
                {
                    echo("Check your password");
                }
            }
    else //no records/rows
    {
        echo("no records found");
    }
}
?>