<?php
    require_once "../../common-files/databases/database.php";
    $file = $_FILES['brand-logo'];
    $logo = "";
    $location = "";
    if($file['name'] == "")
    {
        $logo = "";
        $location = "";
    }
    else{
        $location = $file['tmp_name'];
        $logo = addslashes(file_get_contents($location));
    }
    
    $brand_name = $_POST['brand-name'];
    //$brand_logo = $_POST['brand-logo'];
    $domain_name = $_POST['domain-name'];
    $brand_email = $_POST['brand-email'];
    $facebook = $_POST['facebook'];
    $instagram = $_POST['instagram'];
    $address = addslashes($_POST['address']);
    $phone = $_POST['phone'];
    $about_us = addslashes($_POST['about-us']);
    $privacy_policy = addslashes($_POST['privacy-policy']);
    $terms_conditions = addslashes($_POST['terms-conditions']);
    $cookies = addslashes($_POST['cookies']);

    $check_branding_table = "SELECT * FROM branding";
    $response = $db->query($check_branding_table);
    if($response)
    {
            if($logo == "")
            {
                $update_data = "UPDATE branding SET brand_name = '$brand_name',brand_email = '$brand_email',domain_name = '$domain_name',facebook = '$facebook',instagram = '$instagram',address = '$address',phone = '$phone',about_us = '$about_us',privacy_policy = '$privacy_policy',terms_conditions = '$terms_conditions', cookies = '$cookies'";
                $response = $db->query($update_data);
                if($response)
                {
                    echo "edit success";
                }
                else{
                    echo "edit failed";
                }
            }
            else{
                $update_data = "UPDATE branding SET brand_name = '$brand_name',email = '$brand_email',domain_name = '$domain_name',brand_logo = '$logo',facebook = '$facebook',instagram = '$instagram',address = '$address',phone = '$phone',about_us = '$about_us',privacy_policy = '$privacy_policy',terms_conditions = '$terms_conditions', cookies = '$cookies'";
                $response = $db->query($update_data);
                if($response)
                {
                    echo "edit success";
                }
                else{
                    echo "edit failed";
                }
            }
    }
    else{
        $create_table = "CREATE TABLE branding(
            id INT(10) NOT NULL AUTO_INCREMENT,
            brand_name VARCHAR(50),
            brand_logo MEDIUMBLOB,
            domain_name VARCHAR(100),
            brand_email VARCHAR(100),
            facebook VARCHAR(100),
            instagram VARCHAR(100),
            address VARCHAR(150),
            phone INT(10),
            about_us MEDIUMTEXT,
            privacy_policy MEDIUMTEXT,
            terms_conditions MEDIUMTEXT,
            cookies MEDIUMTEXT,
            PRIMARY KEY (id)
        )";

        $response = $db->query($create_table);
        if($response)
        {
            $store_data = "INSERT INTO branding(brand_name,brand_logo,email,domain_name,brand_email,facebook,instagram,address,phone,about_us,privacy_policy,terms_conditions,cookies)
             VALUES ('$brand_name','$logo','$domain_name','$brand_email','$facebook','$instagram','$address','$phone','$about_us','$privacy_policy','$terms_conditions','$cookies')";
             $response = $db->query($store_data);
             if($response)
             {
                 echo "success";
             }
             else{
                 echo "unable to store data in table";
             }

        }
        else{
            echo "table not created";
        }
    }

?>